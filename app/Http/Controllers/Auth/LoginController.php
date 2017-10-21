<?php

namespace App\Http\Controllers\Auth;

use Cache;
use App\User;
use Socialite;
use App\Models\Social;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidateSecretRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $loginPath = '/auth/login';

    /**
     * Create a new controller instance.
     *
     * @var string
     */
    protected $redirectAfterLogout = '/';

    /**
     * Rota de redirecionamento apos login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->redirectTo = route('admin.dashboard');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     *
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->google2fa_secret) {
            $request->session()->put('2fa:user:id', $user->id);

            Auth::logout();

            return redirect()->route('auth.valida2fa');
        }

        return redirect()->intended($this->redirectTo);
    }

    /**
     * [activation description].
     *
     * @param  [type] $token [description]
     * @return [type]        [description]
     */
    protected function activation($token)
    {
        $User = User::where('activation_code', $token)->first();

        if ($User === null) {
            return redirect()->route('auth.login')->with('error', 'Token de ativação invalido!');
        }

        $User->activation = true;
        $User->activation_code = null;
        $User->save();

        return redirect()->route('auth.login')->with('success', 'Sua conta foi ativada com sucesso.');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        try {
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            Socialite::driver($provider);
        } catch (\Exception $e) {
            abort(404);
        }

        // checa se negou o acesso ao profile
        if ($request->error == 'access_denied' && $request->denied) {
            return redirect()->route('auth.login')->withInput()->with('error', 'Você não autorizou a verificação de perfil!');
        }

        // Dados do usuario Provider
        try {
            $UserProvider = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('auth.login')->withInput()->with('error', 'Você não autorizou a verificação de perfil!');
        }

        // Checa usuario
        $UserCheck = User::where('email', '=', $UserProvider->email)->first();

        if (! $UserCheck) {
            return redirect()->route('auth.login')->withInput()->with('error', 'Não encontramos nenhuma conta vinculada a sua rede social.');
        }

        // Verifica se já existe na base o social liberado
        Social::firstOrCreate([
            'provider' => $provider,
            'user_id' => $UserCheck->id,
        ]);

        // Autentica
        auth()->login($UserCheck, true);

        // Redireciona
        return redirect($this->redirectTo)->with('success', 'Login efetuado com sucesso!');
    }

    /**
     * [valida2Fa description].
     *
     * @return [type] [description]
     */
    public function valida2Fa()
    {
        if (session('2fa:user:id')) {
            $user = User::findOrFail(session('2fa:user:id'));

            if (! $user->google2fa_secret) {
                return redirect()->route('auth.login');
            }

            return view('auth.2fa');
        }

        return redirect()->route('auth.login');
    }

    /**
     * [postvalida2Fa description].
     *
     * @param  ValidateSecretRequest $request [description]
     * @return [type]                         [description]
     */
    public function postvalida2Fa(ValidateSecretRequest $request)
    {
        // get user id and create cache key
        $userId = $request->session()->pull('2fa:user:id');
        $key = $userId.':'.$request->totp;

        //use cache to store token to blacklist
        Cache::add($key, true, 4);

        //login and redirect user
        Auth::loginUsingId($userId);

        return redirect()->intended($this->redirectTo);
    }
}
