<?php

namespace App\Listeners;

use App\Events\NewMatchingCreated;
use App\Notifications\NewMatchingNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NewMatchingNotificationCreated
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewMatchingCreated $event): void
    {
        $need = $event->need;

        $details = [
            'head' => 'New Donation for you',
            'greeting' => 'Hello '.$need->ben->name,
            'body' => 'You have successfully matched with new donation check it out here',
            'url' => route('needs.show', $need->id),
            'id' => $need->id,
        ];
        Notification::send($need->user, new NewMatchingNotification ($need));
    }
}
