<?php

namespace App\Http\Middleware;

use Closure;
use Hashids;
use Illuminate\Contracts\Auth\Factory as Auth;

class CheckHashSass
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
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach ($request->route()->parameters as $key => $string) {
            $request->route()->setParameter($key, $this->getHashId($string));
        }

        return $next($request);
    }

    /**
     * [getHashId description].
     *
     * @param string $value
     *
     * @return int
     */
    protected function getHashId($value)
    {
        if (! config('starter.MULTISAS')) {
            return $value;
        }

        $id = Hashids::decode($value);

        if (isset($id[0]) && is_numeric($id[0])) {
            return $id['0'];
        }

        if ($this->auth->user() && $this->auth->user()->is_super) {
            return $value;
        }

        if (! is_numeric($value)) {
            return $value;
        }

        return -1;
    }
}
