<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Avatar;
use Storage;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    //
    public function index()
    {
        return view('welcome');
    }

    public function getManifest()
    {
        return [
            'name'          => config('app.name'),
            'short_name'    => config('app.name'),
            'display'       => 'standalone',
            'gcm_sender_id' => config('starter.GCM_SENDER_ID'),
            'start_url'     => url('/'),
            'background_color' => '#0178BC',
            'theme_color'   => '#0178BC',
            'icons'         => [
                ['src' => 'launcher-icon-1x.png', 'type' => 'image/png', 'sizes' => '48x48'],
                ['src' => 'launcher-icon-2x.png', 'type' => 'image/png', 'sizes' => '96x96'],
                ['src' => 'launcher-icon-3x.png', 'type' => 'image/png', 'sizes' => '144x144'],
                ['src' => 'launcher-icon-4x.png', 'type' => 'image/png', 'sizes' => '192x192'],
                ['src' => 'launcher-icon-5x.png', 'type' => 'image/png', 'sizes' => '512x512'],
            ],
        ];
    }

    /**
     * Retorna Avatar do usuario.
     *
     * @param Request $request [description]
     *
     * @return \Illuminate\Http\Response
     */
    public function getAvatar(Request $request)
    {
        if (! Storage::disk('local')->has($request->folder.'/'.$request->filename)) {
            if (isset($request->name)) {
                $username = $request->name;
            } elseif (auth()->user()) {
                $username = auth()->user()->name;
            } else {
                $username = 'Painel';
            }

            $imageStr = Avatar::create($username)->toBase64();

            $image = base64_decode(str_replace('data:image/png;base64,', '', $imageStr));

            return response($image, 200)->header('Content-Type', 'image/png');
        }

        $Imagem = Storage::disk('local')->get($request->folder.'/'.$request->filename);

        // Set Headers
        $headers = [
            'Content-Type'        => Storage::disk('local')->mimeType($request->folder.'/'.$request->filename),
            'Content-Disposition' => 'inline',
            'Cache-Control'       => 'max-age=86400',
            'Pragma'              => 'public',
            'Etag'                => md5($Imagem),
        ];

        // return the image
        return Response::make($Imagem, 200, $headers)->setTtl((60 * 60));
    }
}
