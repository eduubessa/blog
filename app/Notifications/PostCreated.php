<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class PostCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private Post $post)
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
//        return $notifiable->prefers_sms ? ['sms'] : ['mail', 'database'];
        return ['vonage'];
    }

    public function routeNotificationForVonage(): string
    {
        return $this->phone_number;
    }


    /**
     * Get the mail representation of the notification.
     */
    public function toVonage(object $notifiable): VonageMessage
    {

        dd("hello world");

        return (new VonageMessage())
            ->content("Hello, Created a new post with title: {$this->post->title}");
    }
}
