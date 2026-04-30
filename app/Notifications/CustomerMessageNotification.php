<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly string $messageText
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Neue Nachricht')
            ->greeting('Hallo '.$notifiable->name.',')
            ->line($this->messageText)
            ->line('Viele Gruesse');
    }
}
