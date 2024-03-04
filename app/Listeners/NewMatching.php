<?php

namespace App\Listeners;

use App\Events\DonationCreated;
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
                break;
            }
        }

        // if($need && $need->status == 'confirmed') {
        //     $need->donation_id = $donation->id;
        //     $need->status = 'matched';
        //     $need->save();
            
        //     // $details = [
        //     //     'head' => 'New Donation for you',
        //     //     'greeting' => 'Hello '.$ben->name,
        //     //     'body' => 'You have successfully matched with new donation check it out here',
        //     //     'url' => route('needs.show', $need->id),
        //     //     'id' => $need->id,
        //     // ];
    
        //     // Notification::send($dist, new NewMatchingNotification($details));

        // }

    }
}
