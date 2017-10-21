<?php

namespace App\Mail;

use App\User;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketNovo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User Model.
     *
     * @var App\Models\User
     */
    protected $user;

    /**
     * Ticket Model.
     *
     * @var App\Models\Ticket
     */
    protected $ticket;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Ticket $ticket)
    {
        $this->user = $user;
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('starter.MAIL_REPLY'), config('app.name'))
            ->subject('['.config('app.name').'] Ticket ('.$this->ticket->titulo.').')
            ->view('emails.tickets.new')
            ->with([
                'ticket' => $this->ticket,
                'user'   => $this->user,
                'email'  => config('starter.MAIL_DEV'),
            ]);
    }
}
