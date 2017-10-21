<?php

namespace App\Mail;

use App\User;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketFechado extends Mailable
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
     *
     * @param User   $user   [description]
     * @param Ticket $ticket [description]
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
            ->subject('['.config('app.name').'] Ticket Fechado ('.$this->ticket->titulo.').')
            ->view('emails.tickets.closed')
            ->with([
                'ticket'      => $this->ticket,
                'comentarios' => $this->ticket->Comment,
                'user'        => $this->user,
                'email'       => config('starter.MAIL_DEV'),
            ]);
    }
}
