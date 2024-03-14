<?php

namespace App\Http\Controllers\Ben;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Need;
use App\Notifications\NewMatchingNotification;
use App\Notifications\NewMatchingNotificationDonor;
use App\Notifications\NewRequest;
use Illuminate\Http\Request;
use Illuminate\Notifications\Events\BroadcastNotificationCreated;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $needs = $user->needs->reverse();

        return view('ben.index', compact('needs'));
    }

    public function notifications(){
        
        $notifications = auth()->user()->Notifications()
                                    ->latest() 
                                    ->take(15)
                                    ->get();

        return view('notifications', compact('notifications'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        //start validation
        if($request->qty == null){
            return redirect()->back()->with('error', 'Quantity is required');
        }
        if($request->type == null){
            return redirect()->back()->with('error', 'Type is required');
        }
        //end validation


        
        $need = Need::create([
            'user_id' => $user->id,
            'donation_type_id' => $request->type,
            'quantity' => $request->qty,
            'city_id' => $user->city_id,
            'status' => 'confirmed',
        ]);

        $details = [
            'head' => 'New Request',
            'greeting' => 'Hello '.$user->name,
            'body' => 'You have successfully created new Request',
            'url' => route('needs.show', $need->id),
            'id' => $need->id,
        ];

        Notification::send($user, new NewRequest($details));

        $donations = Donation::where('city_id', $user->city_id)->get();


        //Farm
        if($user->authType->name == 'Farms'){
            $ch1 =0;
            foreach($donations as $donation){
                $donationPlus10 = $donation->quantity + ($donation->quantity * 10/100);
                $donationMinus10 =  $donation->quantity - ($donation->quantity * 10/100);
                if($donation->status == 'confirmed' && 
                $donationMinus10 <= $request->qty && 
                $donationPlus10 >= $request->qty &&
                $donation->donation_type == $request->type &&
                $donation->target == "farm")
                {
                    $need->donation_id = $donation->id;
                    $need->status = 'matched';
                    $need->matched_at = now();
                    $need->save();

                    $donation->status = 'matched';
                    $donation->matched_at = now();
                    $donation->save();

                    $ch1 = 1;
                    
                    
                    break;
                }
            }
            
            
            if($ch1 == 0){
                return redirect()->back()->with('status', 'Your Needs created successfully. you will receive notification when your Need is matched');
            }
            else{
                $details1 = [
                    'head' => 'New Mathced Donation',
                    'greeting' => 'Hello '.$donation->dist->name,
                    'body' => 'Your Donation is matched with '.$need->user->name,
                    'url' => route('dist.donations.show', $donation->id),
                    'id' => $donation->id,
                ];
                Notification::send($need->user, new NewMatchingNotification ($details));
                Notification::send($donation->dist, new NewMatchingNotificationDonor ($details1));
                return redirect()->back()->with('status', 'congrats. your Request is matched with '.$need->donation->dist->name. ' check your notifications for more details');
            }
        }


        // Charity
        $ch =0;
        foreach($donations as $donation){
            $donationPlus10 = $donation->quantity + ($donation->quantity * 10/100);
            $donationMinus10 =  $donation->quantity - ($donation->quantity * 10/100);
            if($donation->status == 'confirmed' && 
            $donationMinus10 <= $request->qty && 
            $donationPlus10 >= $request->qty && 
            $donation->donation_type == $request->type){
                $need->donation_id = $donation->id;
                $need->status = 'matched';
                $need->matched_at = now();
                $need->save();

                $donation->status = 'matched';
                $donation->matched_at = now();
                $donation->save();

                $ch = 1;
                
                $details = [
                    'head' => 'New Donation',
                    'greeting' => 'Hello '.$need->user->name,
                    'body' => 'You have successfully matched with new donation check your notification',
                    'url' => route('needs.show', $need->id),
                    'id' => $need->id,
                ];

                
                break;
            }
        }
        
        
        if($ch == 0){
            return redirect()->back()->with('status', 'Your Needs created successfully. you will receive notification when your Need is matched');
        }
        else{
            $details1 = [
                'head' => 'New Mathced Donation',
                'greeting' => 'Hello '.$donation->dist->name,
                'body' => 'Your Donation is matched with '.$need->user->name,
                'url' => route('dist.donations.show', $donation->id),
                'id' => $donation->id,
            ];
            Notification::send($need->user, new NewMatchingNotification ($details));
            Notification::send($donation->dist, new NewMatchingNotificationDonor ($details1));
            return redirect()->back()->with('status', 'congrats. your Request is matched with '.$need->donation->dist->name. ' check your notifications for more details');
        }


    }

    public function show(Need $need)
    {
        $ben = auth()->user();

        foreach ($ben->unreadNotifications as $notification) {
            if ($notification->data['id'] == $need->id) {
                $notification->markAsRead();
                break;
            }
        }

        return view('ben.show', compact('need', 'ben'));
    }

    public function read(){
        $counter = auth()->user()->unreadNotifications->count();
        return response()->json([
            'success' => 200,
            'counter' => $counter
        ]);
    }
}
