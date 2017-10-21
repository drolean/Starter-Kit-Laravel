<?php

namespace App\Notifications;

use App\Models\Companie;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CompanieNewNotification extends Notification
{
    use Queueable;

    /**
     * The companie model.
     *
     * @var App\Models\Companie
     */
    public $companie;

    /**
     * Create a new notification instance.
     */
    public function __construct(Companie $companie)
    {
        $this->companie = $companie;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return string[]
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject('Sua empresa '.$this->companie->empresa.' agora faz parte do '.config('app.name'))
            ->line('Bem-vindo ao '.config('app.name').'! Esperamos que nossa parceria seja longa e de sucesso.')
            ->action('Começar', url('/'))
            ->line('Obrigado por usar o nosso aplicativo!');
    }
}
