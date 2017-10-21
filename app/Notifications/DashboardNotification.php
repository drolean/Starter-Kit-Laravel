<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;
use Illuminate\Notifications\Messages\MailMessage;

class DashboardNotification extends Notification
{
    use Queueable;

    private $dados;

    /**
     * Create a new notification instance.
     */
    public function __construct($dados)
    {
        $this->dados = $dados;
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
        return ['mail', 'database', 'broadcast', WebPushChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title'      => $this->dados['title'],
            'body'       => $this->dados['body'],
            'action_url' => (isset($this->dados['action_url'])) ? $this->dados['action_url'] : null,
            'created'    => Carbon::now()->toIso8601String(),
        ];
    }

    /**
     * Get the web push representation of the notification.
     *
     * @param mixed $notifiable
     * @param mixed $notification
     *
     * @return WebPushMessage
     */
    public function toWebPush($notifiable, $notification)
    {
        return WebPushMessage::create()
            ->id($notification->id)
            ->title($this->dados['title'])
            ->icon('/notification-icon.png')
            ->body($this->dados['body'])
            ->action('Visualizar', (isset($this->dados['action_url'])) ? $this->dados['action_url'] : null);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('['.config('app.name').'] Nova notificação (' . Carbon::now() . ')')
                    ->greeting($this->dados['title'])
                    ->line($this->dados['body'])
                    ->action('Visualizar', (isset($this->dados['action_url'])) ? $this->dados['action_url'] : null)
                    ->line('Este E-mail Foi Gerado Automaticamente');
    }    
}
