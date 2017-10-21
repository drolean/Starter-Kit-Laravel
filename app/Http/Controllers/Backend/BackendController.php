<?php

namespace App\Http\Controllers\Backend;

use LogView;
use ServerInfo;
use App\Models\Activity;
use App\Models\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class BackendController extends Controller
{
    public function getAtividades()
    {
        $Atividades = Activity::with('User')->orderBy('id', 'DESC')->paginate(50);

        return view('backend.internas.atividades', compact('Atividades'));
    }

    public function getNotificacoes()
    {
        $Notificacoes = Notification::with('User')->orderBy('id', 'DESC')->paginate(50);

        return view('backend.internas.notificacoes', compact('Notificacoes'));
    }

    public function getLogs()
    {
        $Logs = LogView::all();

        return view('backend.internas.logs', compact('Logs'));
    }

    public function getServer()
    {
        $ServerInfo = ServerInfo::getOSInformation();
        $Ping = Cache::remember('system.ping', 15, function () {
            return [
                'facebook.com' => ServerInfo::ping('www.facebook.com'),
                'google.com'   => ServerInfo::ping('www.google.com'),
                'uol.com.br'   => ServerInfo::ping('www.uol.com.br'),
            ];
        });

        return view('backend.internas.server', compact('ServerInfo', 'Ping'));
    }
}
