<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRequest extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable){
        return [
            'greeting' => $this->details['greeting'],
            'head' => $this->details['head'],
            'body' => $this->details['body'],
            'url' => $this->details['url'],
            'id' => $this->details['id'],
            'icon' => 'help.png',
            'created_at' => now()->diffForHumans(),
        ];
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

    public function toBroadcast($notifiable){
        return [
            'greeting' => $this->details['greeting'],
            'head' => $this->details['head'],
            'body' => $this->details['body'],
            'url' => $this->details['url'],
            'id' => $this->details['id'],
            'icon' => 'help.png',
            'created_at' => now()->diffForHumans(),
        ];
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
