<?php

namespace App\Http\Middleware;

use Cache;
use Closure;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param \Illuminate\Contracts\Auth\Factory $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string[]                 ...$guards
     *
     * @throws \Illuminate\Auth\AuthenticationException
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($guards);

        /*! Verifica se usuario foi ativado */
        if (! $this->auth->User()->Companie) {
            // Desloga usuario
            $this->auth->logout();

            return redirect()->guest('/auth/login')->with('error', 'Sua conta não esta vinculado a nenhuma empresa. Entre em contato com o Suporte!');
        }

        /*! Verifica se usuario foi ativado */
        if ($this->auth->User()->activation == false) {
            // Desloga usuario
            $this->auth->logout();

            return redirect()->guest('/auth/login')->with('error', 'Conta não ativada.');
        }

        // regra para passar o avatar
        if (str_is('admin.profile.image.avatar', $request->route()->getName())) {
            return $next($request);
        }

        /*! Verifica se o usuario precisa mudar a senha */
        if (($this->auth->User()->password_change_at == null || Carbon::parse($this->auth->User()->password_change_at)->diffInDays(Carbon::now()) >= 90) &&
        ($request->route()->getName() !== 'admin.profile.password')) {
            return redirect()->route('admin.profile.password')->with('info', 'Altere sua senha!');
        }

        /*! Coloca status de online ao usuario */
        Cache::put('user-is-online-'.$this->auth->User()->id, true, Carbon::now()->addMinutes(2));

        /*! Se for super libera tudo */
        if ($this->auth->User()->is_super) {
            return $next($request);
        }

        /*! Nega acesso a usuario suspenso */
        if ($this->auth->User()->blocked_on) {
            $this->auth->logout();

            return redirect()->guest('/auth/login')->with('error', 'Conta suspensa.');
        }

        /*! Se for admin libera tudo */
        if ($this->auth->User()->is_admin && $this->auth->User()->id == $this->auth->User()->Companie->user_id) {
            return $next($request);
        }

        /*! Libera admin somente para quem tem regra */
        if ($this->auth->User()->roles->count() === 0) {
            $this->auth->logout();

            return redirect()->guest('/auth/login')->with('error', 'Acesso não permitido.');
        }

        /*! Se for profile libera */
        if (str_is('admin.profile*', $request->route()->getName()) || str_is('admin.notification*', $request->route()->getName())) {
            return $next($request);
        }

        /*! Se for dashboard libera */
        if ($request->route()->getName() == 'admin.dashboard') {
            return $next($request);
        }

        /*! Verifica se tem permissão */
        if (! $request->user()->can($request->route()->getName())) {
            abort(404);
        }

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param array $guards
     *
     * @throws \Illuminate\Auth\AuthenticationException
     *
     * @return void
     */
    protected function authenticate(array $guards)
    {
        if (empty($guards)) {
            return $this->auth->authenticate();
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        throw new AuthenticationException();
    }
}
