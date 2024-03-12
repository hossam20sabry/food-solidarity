<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMatchingNotificationDonor extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $details1;
    public function __construct($details1)
    {
        $this->details1 = $details1;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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


    public function toDatabase($notifiable)
    {
        return [
            'greeting' => $this->details1['greeting'],
            'head' => $this->details1['head'],
            'body' => $this->details1['body'],
            'url' => $this->details1['url'],
            'id' => $this->details1['id'],
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'greeting' => $this->details1['greeting'],
            'head' => $this->details1['head'],
            'body' => $this->details1['body'],
            'url' => $this->details1['url'],
            'id' => $this->details1['id'],
            'icon' => 'accept.png',
            'created_at' => now()->diffForHumans(),
        ];
    }
}
