<?php

namespace App\Mail;

use App\User;
use App\Models\Ticket;
use App\Models\TicketComment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketRespondido extends Mailable
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
     * TicketComment Model.
     *
     * @var App\Models\TicketComment
     */
    protected $comentario;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Ticket $ticket, TicketComment $comentario)
    {
        $this->user = $user;
        $this->ticket = $ticket;
        $this->comentario = $comentario;
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
            ->view('emails.tickets.reply')
            ->with([
                'ticket'     => $this->ticket,
                'comentario' => $this->comentario,
                'user'       => $this->user,
                'email'      => config('starter.MAIL_DEV'),
            ]);
    }
}
