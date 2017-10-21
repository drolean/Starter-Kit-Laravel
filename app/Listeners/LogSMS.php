<?php

namespace App\Listeners;

use App\Models\Activity;

class LogSMS
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
     * @param  LakshmajiPlivoEventsLogBeforeSend  $event
     * @return void
     */
    public function handle($event)
    {
        // Log data
        $logAuditing = [
            'content_type' => 'SMS',
            'acao'         => 'envio',
            'detalhes'     => $event,
        ];

        Activity::log($logAuditing);
    }
}
