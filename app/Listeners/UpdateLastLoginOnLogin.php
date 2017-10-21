<?php

namespace App\Listeners;

use Auth;
use Request;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;

class UpdateLastLoginOnLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Login $event
     */
    public function handle(Login $event)
    {
        /*
        $user                = auth()->user();
        $user->last_login    = Carbon::now();
        $user->last_login_ip = Request::ip();
        $user->save();
        */
    }
}
