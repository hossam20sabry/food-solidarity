<?php

namespace App\Listeners;

use App\Events\DonationCreated;
use App\Events\NewMatchingCreated;
use App\Models\Donation;
use App\Models\Need;
use App\Models\User;
use App\Notifications\NewDonation;
use App\Notifications\NewMatchingNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NewMatching
{
    /**
     * Create the event listener.
     */

    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(DonationCreated $event): void
    {
        $donation = $event->donation;
        $dist = $donation->dist;

        $needs = Need::where('city_id', $dist->city_id)->get();

        foreach($needs as $need) {
            if($need->status == 'confirmed') {
                $need->donation_id = $donation->id;
                $need->status = 'matched';
                $need->save();
                
                $donation->status = 'matched';
                $donation->save();
                
                event(new NewMatchingCreated($need));
                $recipientUserId = $need->user->id;
                
                break;
            }
        }

    }
}
