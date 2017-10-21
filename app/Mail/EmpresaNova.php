<?php

namespace App\Mail;

use App\User;
use App\Models\Companie;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmpresaNova extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User Model.
     *
     * @var App\Models\User
     */
    protected $user;

    /**
     * Companie Model.
     *
     * @var App\Models\Ticket
     */
    protected $companie;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Companie $companie)
    {
        $this->user = $user;
        $this->companie = $companie;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('starter.MAIL_REPLY'), config('app.name'))
            ->subject('['.config('app.name').'] Nova Empresa ('.$this->companie->empresa.').')
            ->view('emails.companie.new')
            ->with([
                'companie' => $this->companie,
                'user'     => $this->user,
                'email'    => config('starter.MAIL_DEV'),
            ]);
    }
}
