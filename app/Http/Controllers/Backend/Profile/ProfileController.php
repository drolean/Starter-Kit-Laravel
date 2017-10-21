<?php

namespace App\Http\Controllers\Backend\Profile;

use Auth;
use Crypt;
use Image;
use Funcoes;
use Storage;
use App\User;
use Response;
use Google2FA;
use Carbon\Carbon;
use App\Models\Companie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\DashboardNotification;

class ProfileController extends Controller
{
    /**
     * [showProfile description].
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        return view('backend.profile.index');
    }

    /**
     * [updateProfile description].
     *
     * @param Request $request [description]
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $Usuario = User::findOrFail($request->user()->id);
        $Usuario->update($request->except('_token', 'endereco', 'cidade', 'telefone', 'aniversario'));
        $Usuario->profile()->update([
            'endereco' => $request->endereco,
            'cidade' => $request->cidade,
            'telefone' => $request->telefone,
            'aniversario' => (Funcoes::validateDate($request->aniversario, 'd/m/Y')) ? Carbon::createFromFormat('d/m/Y', $request->aniversario)->format('Y-m-d') : null,
        ]);

        if ($uploaded = $request->file('avatar')) {
            // Verifica tipo de arquivo
            if (! in_array($uploaded->getMimeType(), ['image/gif', 'image/jpeg', 'image/png'])) {
                return response()->back()->with('error', 'Tipo de arquivo inválido!');
            }

            // Faz Upload
            $name = sha1(time().uniqid().md5('leandro')).'.'.$uploaded->getClientOriginalExtension();
            $img = Image::make($uploaded)->fit(80, 80)->orientate();
            Storage::disk('local')->put('avatar/'.$name, $img->stream());

            // Atualiza na Base
            $Usuario->update(['avatar' => 'avatar/'.$name]);
        }

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }

    /**
     * [getPassword description].
     *
     * @return \Illuminate\Http\Response
     */
    public function getPassword()
    {
        return view('backend.profile.password');
    }

    /**
     * [postPassword description].
     *
     * @param Request $request [description]
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postPassword(Request $request)
    {
        $credentials = [
            'email' => $request->user()->email,
            'password' => $request->get('old_password'),
        ];

        if (Auth::validate($credentials)) {
            $Usuario = User::findOrFail($request->user()->id);
            $Usuario->update(['password' => bcrypt($request->get('password')), 'password_change_at' => Carbon::now()]);

            return redirect()->back()->with('success', 'Senha atualizada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Senha não confere');
        }
    }

    /**
     * [getNotificacoes description].
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotificacoes()
    {
        return view('backend.profile.notificacoes');
    }

    /**
     * [getAtividade description].
     *
     * @return \Illuminate\Http\Response
     */
    public function getAtividade()
    {
        return view('backend.profile.atividades');
    }

    /**
     * [postNotification description].
     *
     * @param Request $request [description]
     */
    public function postNotification(Request $request)
    {
        User::find($request->user)->notify(new DashboardNotification([
            'title' => $request->titulo,
            'body' => $request->mensagem,
        ]));
    }

    /**
     * Alterna entre usuarios no sistema.
     *
     * @param int id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getAlternar($id)
    {
        if (auth()->user()->is_super) {
            session(['admin_user_id' => auth()->user()->id]);
            session(['admin_user_name' => auth()->user()->name]);

            Auth::loginUsingId($id);

            return redirect()->route('admin.dashboard')->with('success', 'Usuário alterado com sucesso!');
        }

        return redirect()->back()->with('error', 'Sem acesso ao usuário!');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getVoltar()
    {
        if (session()->has('admin_user_id')) {
            // admin id
            $admin_id = session()->get('admin_user_id');

            Auth::loginUsingId((int) $admin_id);

            session()->forget('admin_user_id');
            session()->forget('admin_user_name');

            return redirect()->route('admin.dashboard')->with('success', 'Usuário alterado com sucesso!');
        }

        return redirect()->back()->with('error', 'Sem acesso ao usuário!');
    }

    /**
     * Retorna tela de confirmacao de deletar conta.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDelete()
    {
        return view('backend.profile.delete');
    }

    /**
     * Deleta conta do usuario.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete()
    {
        User::find(auth()->user()->id)->delete();

        return redirect()->back()->with('success', 'Usuário deletado do sistema.');
    }

    /**
     * Mostra pagina para alterar logo da empresa.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogo()
    {
        return view('backend.profile.logo');
    }

    /**
     * Atualiza logo da empresa.
     *
     * @param Request $request [description]
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogo(Request $request)
    {
        $Imagem = $request->file('logo');

        // Valida Imagem
        if (! in_array($Imagem->getMimeType(), ['image/gif', 'image/jpeg', 'image/png'])) {
            return redirect()->back()->with('error', 'Imagem inválida!');
        }

        // Recupera informações da Empresa
        $Empresa = Companie::where('id', $request->user()->company_id)->first();

        // Apaga logo se existir?
        if ($Empresa->logo != 'default.jpg') {
            Storage::disk('local')->delete('logos/'.$Empresa->logo);
        }

        // Gera nome Randomico
        $name = substr(sha1(md5(time().uniqid())), 0, 10);

        // Convertendo Logo
        $Logo = Image::make($request->file('logo'))->resize(245, 56, function ($constraint) {
            $constraint->aspectRatio();
        })->interlace();

        // Criando Canvas
        $Final = Image::canvas(245, 56, '#FFFFFF')->insert($Logo, 'center');
        $imageStr = (string) $Final->encode('png');

        // Salva no Disco
        Storage::disk('local')->put('logos/'.$name.'.png', $imageStr, 'public');

        // Salva na Base
        $Empresa->logo = 'logos/'.$name.'.png';
        $Empresa->save();

        // Retorno
        return redirect()->back()->with('success', 'Logo alterado com sucesso.');
    }

    /**
     * [postCompanie description].
     *
     * @param  Request $request [description]
     *
     * @return \Illuminate\Http\Response
     */
    public function postCompanie(Request $request)
    {
        // Super Admin poder Especial
        if ($request->user()->is_super) {
            $request->user()->update(['company_id' => $request->companie]);
        }

        // Aqui para usuario normal
        $request->user()->Empresas->each(function ($item) use ($request) {
            if ($item->id == $request->companie) {
                $request->user()->update(['company_id' => $item->id]);
            }
        });

        return response()->json(['success' => 'true']);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getTwoFactor(Request $request)
    {
        //generate new secret
        $secret = Google2FA::generateSecretKey();

        $user = $request->user();

        $image = Google2FA::getQRCodeGoogleUrl(
            camel_case(config('app.name')),
            $user->email,
            $secret
        );

        return view('backend.profile.2fa', compact('secret', 'image'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postTwoFactor(Request $request)
    {
        $this->validate($request, [
            'secret' => 'required',
            'hash' => 'required',
        ]);

        // Validando primeiro
        $validar = Google2FA::verifyKey($request->hash, $request->secret);

        if ($validar === false) {
            return redirect()->back()->with('error', 'Desculpe, não conseguimos processar a ativação da dupla autenticação. Tente novamente!');
        }

        //encrypt and then save secret
        $user = $request->user();
        $user->google2fa_secret = Crypt::encrypt($request->hash);
        $user->save();

        return redirect()->back()->with('success', 'Obrigado, dupla autenticação ativada com sucesso!');
    }

    /**
     * [deleteTwoFactor description].
     *
     * @param  Request $request [description]
     * @return \Illuminate\Http\Response
     */
    public function deleteTwoFactor(Request $request)
    {
        $user = $request->user();
        $user->google2fa_secret = null;
        $user->save();

        return response()->json(['success' => 'true']);
    }
}
