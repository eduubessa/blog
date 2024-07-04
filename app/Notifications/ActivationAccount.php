<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActivationAccount extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function subject(object $notifiable): string
    {
        return 'Bem-vindo ' . decrypt_data($notifiable->firstname) . '!';
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->subject($notifiable))
            ->line('Olá ' . decrypt_data($notifiable->firstname) . '!')
            ->line('Nós recebemos um pedido de registo na nossa aplicação, e para confirmar o seu registo, e ativar a sua conta, por favor clique no botão abaixo.')
            ->action('Confirmar o meu registo, e ativar a minha conta', url('/auth/activation/' . $notifiable->ActivationAccount->token . '/'))
            ->line('Caso não tenha feito este pedido, por favor ignore este email.')
            ->line('Agradecemos a sua confiança!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
