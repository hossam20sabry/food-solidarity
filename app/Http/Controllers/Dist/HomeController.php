<?php

namespace App\Http\Controllers\Dist;

use App\Events\DonationCreated;
use App\Http\Controllers\Controller;
use App\Models\Canned;
use App\Models\CookedMeal;
use App\Models\Donation;
use App\Models\DonationType;
use App\Models\DryFood;
use App\Models\DryFoodType;
use App\Models\FoodType;
use App\Models\Need;
use App\Models\Protein;
use App\Models\ProteinType;
use App\Notifications\NewDonation;
use App\Notifications\NewMatchingNotification;
use App\Notifications\NewMatchingNotificationDonor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->guard('dist')->user();
        $donations = $user->donations->where('status', '!=', 'pending')->reverse();
        return view('dist.donation.index', compact('donations'));
    }

    public function  notifications(){
        $notifications = auth()->guard('dist')->user()->Notifications()
                                            ->latest() 
                                            ->take(15)
                                            ->get();

        return view('notifications', compact('notifications'));
    }

    public function store(Request $request)
    {
        $dist = auth()->guard('dist')->user();
        
        $donation = new Donation();
        $donation->dist_id = $dist->id;
        $donation->quantity = 0;
        $donation->city_id = $dist->city_id;
        $donation->save();

        return redirect()->route('dist.donations.choose', $donation->id);
    }

    public function choose($id)
    {
        $donation = Donation::find($id);
        return view('dist.donation.choose', compact('donation'));
    }

    public function donationType(Request $request){   
        $donation = Donation::find($request->donation_id);

        $donation->donation_type = $request->type_id;
        $donation->save();

        return redirect()->route('dist.donations.create1', $donation->id);
    }

    public function create1($id){

        $donation = Donation::find($id);

        if($donation->donation_type == 1){
            $dryFoods = FoodType::where('flag', "0")->get();
            return view('dist.donation.create1', compact( 'dryFoods', 'donation'));
        }
        elseif($donation->donation_type == 2){
            $cookedMeals = CookedMeal::all();
            return view('dist.donation.create2', compact('cookedMeals', 'donation'));
        }elseif($donation->donation_type == 3){
            $proteins = FoodType::where('flag', "1")->get();
            return view('dist.donation.create3', compact('proteins', 'donation'));
        }

        return redirect()->route('dist.donations.index')->with('error', 'Invalid donation type');

    }

    public function dry(Request $request){
        $request->validate([
            'dry_food_id' => 'required|array',
            'quantity' => 'required|array',
            'expDate' => 'required|array',
            'dry_food_id.*' => 'required',
            'quantity.*' => 'required|numeric|min:1',
            'expDate.*' => 'required|date',
        ]);
        
        $donation = Donation::find($request->donation_id);

        $dryFoods = $request->input('dry_food_id');
        $quantities = $request->input('quantity');
        $expDates = $request->input('expDate');

        if ($dryFoods !== null && $quantities !== null && $expDates !== null && count($dryFoods) === count($quantities) && count($dryFoods) === count($expDates)) {
            $count = count($dryFoods);
            for ($i = 0; $i < $count; $i++) {
                $dryFoodId = $dryFoods[$i];
                $quantity = $quantities[$i];
                $expDate = $expDates[$i];

                //start check if the expiration date is too old
                $currentMonth = date('Y-m');
                $expMonth1 = date('Y-m', strtotime($expDate));
                if($expMonth1 < $currentMonth){
                    return redirect()->back()->with('error', 'You Entered an Item that has an expiraton date that is too old.');
                }
                //end check if the expiration date is too old
                //start check if the target is farm
                if($expDate < date('Y-m-d')){
                    $donation->target = 'farm';
                    $donation->save();
                }
                //end check if the target is farm

        
                $dryFoodType = FoodType::find($dryFoodId);
        
                if ($dryFoodType) {
                    $newDryFood = new Canned();
                    $newDryFood->name = $dryFoodType->name;
                    $newDryFood->donation_id = $donation->id;
                    $newDryFood->food_type_id = $dryFoodId;
                    $newDryFood->quantity = $quantity;
                    $newDryFood->Exp_date = $expDate;
                    $newDryFood->save();
                }
                else{
                    return redirect()->route('dist.donations.index')->with('error', 'Something went wrong.');
                }

            }
        
        } else {
            return redirect()->route('dist.donations.index')->with('error', 'Something went wrong.');
        }

        $qty = 0;
        foreach ($quantities as $key => $quantitie) {
            $qty = $qty + $quantitie;
        }

        $donation->quantity = $qty;
        $donation->status = 'confirmed';
        $donation->save();

        $dist = auth()->guard('dist')->user();

        $details = [
            'head' => 'New Donation',
            'greeting' => 'Hello '.$dist->name,
            'body' => 'You have successfully created new Donation',
            'url' => route('dist.donations.show', $donation->id),
            'id' => $donation->id,
        ];

        Notification::send($dist, new NewDonation($details));

        $needs = Need::where('city_id', $dist->city_id)->get();
        

        //Farm
        if($donation->target == "farm"){
            $ch1 = 0;
            foreach($needs as $need) {
                $needPlus10 = $need->quantity + ($need->quantity * 10/100);
                $needMinus10 =  $need->quantity - ($need->quantity * 10/100);
                if($need->status == 'confirmed' &&
                $qty>=$needMinus10 && $qty<=$needPlus10 &&
                $need->donation_type_id == $donation->donation_type &&
                $need->user->authType->name == "Farms")
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
                return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. you will receive notification when your Donation is matched');
            }
            else{
                $details = [
                    'head' => 'New Donation',
                    'greeting' => 'Hello '.$need->user->name,
                    'body' => 'You have successfully matched with new donation check your notifications',
                    'url' => route('needs.show', $need->id),
                    'id' => $need->id,
                ];
                $details1 = [
                    'head' => 'New Mathced Donation',
                    'greeting' => 'Hello '.$donation->dist->name,
                    'body' => 'Your Donation is matched with '.$need->user->name,
                    'url' => route('dist.donations.show', $donation->id),
                    'id' => $donation->id,
                ];
                Notification::send($need->user, new NewMatchingNotification ($details));
                Notification::send($donation->dist, new NewMatchingNotificationDonor ($details1));
                return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. your donation is matched with '.$need->user->name. ' check your notifications for more details');
            }
        }
        
        //charity
        $ch2 = 0;
        foreach($needs as $need) {
            $needPlus10 = $need->quantity + ($need->quantity * 10/100);
            $needMinus10 =  $need->quantity - ($need->quantity * 10/100);
            if($need->status == 'confirmed' &&
                $qty>=$needMinus10 && $qty<=$needPlus10 &&
                $need->donation_type_id == $donation->donation_type &&
                $need->user->authType->name == "Charity")
            {
                $need->donation_id = $donation->id;
                $need->status = 'matched';
                $need->matched_at = now();
                $need->save();
                
                $donation->status = 'matched';
                $donation->matched_at = now();
                $donation->save();
                
                $ch2++;
                
                break;
            }
        }

        if($ch2 == 0){
            return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. you will receive notification when your Donation is matched');
        }
        else{
            $details = [
                'head' => 'New Donation',
                'greeting' => 'Hello '.$need->user->name,
                'body' => 'You have successfully matched with new donation check your notifications',
                'url' => route('needs.show', $need->id),
                'id' => $need->id,
            ];
            $details1 = [
                'head' => 'New Mathced Donation',
                'greeting' => 'Hello '.$donation->dist->name,
                'body' => 'Your Donation is matched with '.$need->user->name,
                'url' => route('dist.donations.show', $donation->id),
                'id' => $donation->id,
            ];
            Notification::send($need->user, new NewMatchingNotification ($details));
            Notification::send($donation->dist, new NewMatchingNotificationDonor ($details1));
            return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. your donation is matched with '.$need->user->name. ' check your notifications for more details');
        }

    }

    public function cooked(Request $request){
        $request->validate([
            'quantity' => 'required',
            'cooked_time' => 'required',
        ]);

        $donation = Donation::find($request->donation_id);

        //start check if the expiration date is too old
        $currentWeek = date('W');
        $expWeek = date('W', strtotime($request->cooked_time));
        if($expWeek < $currentWeek){
            return redirect()->back()->with('error', 'You cooked an item that has an expiraton date that is too old.');
        }
        //end check if the expiration date is too old

        //start check if the target is farm
        if($request->cooked_time < date('Y-m-d')){
            $donation->target = 'farm';
            $donation->save();
        }
        //end check if the target is farm

        $cookedMeal = new CookedMeal();
        $cookedMeal->donation_id = $donation->id;
        $cookedMeal->quantity = $request->quantity;
        $cookedMeal->cooked_time = $request->cooked_time;
        $cookedMeal->save();

        $donation->quantity = $request->quantity;
        $donation->status = 'confirmed';
        $donation->save();
        
        $dist = auth()->guard('dist')->user();

        $details = [
            'head' => 'New Donation',
            'greeting' => 'Hello '.$dist->name,
            'body' => 'You have successfully created new Donation',
            'url' => route('dist.donations.show', $donation->id),
            'id' => $donation->id,
        ];

        Notification::send($dist, new NewDonation($details));

        $needs = Need::where('city_id', $dist->city_id)->get();

        if( $donation->target == 'farm'){
            $ch1 = 0;
            foreach($needs as $need) {
                $needPlus10 = $need->quantity + ($need->quantity * 10/100);
                $needMinus10 =  $need->quantity - ($need->quantity * 10/100);
                if($need->status == 'confirmed' &&
                $cookedMeal->quantity>=$needMinus10 && $cookedMeal->quantity<=$needPlus10 &&
                $need->donation_type_id == $donation->donation_type &&
                $need->user->authType->name == "Farms")
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
                return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. you will receive notification when your Donation is matched');
            }
            else{
                $details = [
                    'head' => 'New Donation',
                    'greeting' => 'Hello '.$need->user->name,
                    'body' => 'You have successfully matched with new donation check your notifications',
                    'url' => route('needs.show', $need->id),
                    'id' => $need->id,
                ];
                $details1 = [
                    'head' => 'New Mathced Donation',
                    'greeting' => 'Hello '.$donation->dist->name,
                    'body' => 'Your Donation is matched with '.$need->user->name,
                    'url' => route('dist.donations.show', $donation->id),
                    'id' => $donation->id,
                ];
                Notification::send($need->user, new NewMatchingNotification ($details));
                Notification::send($donation->dist, new NewMatchingNotificationDonor ($details1));
                return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. your donation is matched with '.$need->user->name. ' check your notifications for more details');
            }
        }



        $ch = 0;
        foreach($needs as $need) {
            $needPlus10 = $need->quantity + ($need->quantity * 10/100);
            $needMinus10 =  $need->quantity - ($need->quantity * 10/100);
            if($need->status == 'confirmed' && $cookedMeal->quantity>=$needMinus10 && $cookedMeal->quantity<=$needPlus10 && $need->donation_type_id == $donation->donation_type){
                $need->donation_id = $donation->id;
                $need->status = 'matched';
                $need->matched_at = now();
                $need->save();
                
                $donation->status = 'matched';
                $donation->matched_at = now();
                $donation->save();
                
                $ch = 1;
                
                break;
            }
        }

        
        if($ch == 0){
            return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. you will receive notification when your Donation is matched');
        }
        else{
            $details = [
                'head' => 'New Donation',
                'greeting' => 'Hello '.$need->user->name,
                'body' => 'You have successfully matched with new donation check your notifications',
                'url' => route('needs.show', $need->id),
                'id' => $need->id,
            ];
            $details1 = [
                'head' => 'New Mathced Donation',
                'greeting' => 'Hello '.$donation->dist->name,
                'body' => 'Your Donation is matched with '.$need->user->name,
                'url' => route('dist.donations.show', $donation->id),
                'id' => $donation->id,
            ];
            Notification::send($need->user, new NewMatchingNotification ($details));
            Notification::send($donation->dist, new NewMatchingNotificationDonor ($details1));
            return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. your donation is matched with '.$need->user->name. ' check your notifications for more details');
        }
    }

    public function proteins(Request $request){
        $request->validate([
            'protein_id' => 'required|array',
            'quantity' => 'required|array',
            'expDate' => 'required|array',
            'protein_id.*' => 'required',
            'quantity.*' => 'required|numeric|min:1',
            'expDate.*' => 'required|date',
        ]);

        $donation = Donation::find($request->donation_id);

        $proteins = $request->input('protein_id');
        $quantities = $request->input('quantity');
        $expDates = $request->input('expDate');

        if ($proteins !== null && $quantities !== null && $expDates !== null && count($proteins) === count($quantities) && count($proteins) === count($expDates)) {
            $count = count($proteins);
            for ($i = 0; $i < $count; $i++) {
                $proteinsId = $proteins[$i];
                $quantity = $quantities[$i];
                $expDate = $expDates[$i];

                $proteinType = FoodType::find($proteinsId);

                //start check if the expiration date is too old
                $currentMonth = date('Y-m');
                $expMonth = date('Y-m', strtotime($expDate));
                if($expMonth < $currentMonth){
                    return redirect()->back()->with('error', 'You Entered an Item that has an expiraton date that is too old.');
                }
                //end check if the expiration date is too old

                //start check if the target is farm
                if($expDate < date('Y-m-d')){
                    $donation->target = 'farm';
                    $donation->save();
                }
                //end check if the target is farm
        
                if ($proteinType) {
                    $newDryFood = new Canned();
                    $newDryFood->name = $proteinType->name;
                    $newDryFood->donation_id = $donation->id;
                    $newDryFood->food_type_id = $proteinType->id;
                    $newDryFood->quantity = $quantity;
                    $newDryFood->Exp_date = $expDate;
                    $newDryFood->save();
                }
                else{
                    return redirect()->route('dist.donations.index')->with('error', 'Something went wrong.');
                }
            }
        } else {
            return redirect()->route('dist.donations.index')->with('error', 'Something went wrong.');
        }

        $qty = 0;
        foreach ($quantities as $key => $quantitie) {
            $qty = $qty + $quantitie;
        }

        $donation->quantity = $qty;
        $donation->status = 'confirmed';
        $donation->save();

        $dist = auth()->guard('dist')->user();

        $details = [
            'head' => 'New Donation',
            'greeting' => 'Hello '.$dist->name,
            'body' => 'You have successfully created new Donation',
            'url' => route('dist.donations.show', $donation->id),
            'id' => $donation->id,
        ];

        Notification::send($dist, new NewDonation($details));

        $needs = Need::where('city_id', $dist->city_id)->get();

        //Farm
        if($donation->target == "farm"){
            $ch1 = 0;
            foreach($needs as $need) {
                $needPlus10 = $need->quantity + ($need->quantity * 10/100);
                $needMinus10 =  $need->quantity - ($need->quantity * 10/100);
                if($need->status == 'confirmed' &&
                $need->quantity <= $needPlus10 &&
                $need->quantity >= $needMinus10 &&
                $need->donation_type_id == $donation->donation_type &&
                $need->user->authType->name == "Farms")
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
                return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. you will receive notification when your Donation is matched');
            }
            else{
                $details = [
                    'head' => 'New Donation',
                    'greeting' => 'Hello '.$need->user->name,
                    'body' => 'You have successfully matched with new donation check your notifications',
                    'url' => route('needs.show', $need->id),
                    'id' => $need->id,
                ];
                $details1 = [
                    'head' => 'New Mathced Donation',
                    'greeting' => 'Hello '.$donation->dist->name,
                    'body' => 'Your Donation is matched with '.$need->user->name,
                    'url' => route('dist.donations.show', $donation->id),
                    'id' => $donation->id,
                ];
                Notification::send($need->user, new NewMatchingNotification ($details));
                Notification::send($donation->dist, new NewMatchingNotificationDonor ($details1));
                return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. your donation is matched with '.$need->user->name. ' check your notifications for more details');
            }
        }
        
        //charity
        $ch = 0;
        foreach($needs as $need) {
            $needPlus10 = $need->quantity + ($need->quantity * 10/100);
            $needMinus10 =  $need->quantity - ($need->quantity * 10/100);
            if($need->status == 'confirmed' && $need->quantity <= $needPlus10 && $need->quantity >= $needMinus10 && $need->donation_type_id == $donation->donation_type){
                $need->donation_id = $donation->id;
                $need->status = 'matched';
                $need->matched_at = now();
                $need->save();
                
                $donation->status = 'matched';
                $donation->matched_at = now();
                $donation->save();
                
                $ch = 1;
                
                
                break;
            }
        }

        if($ch == 0){
            return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. you will receive notification when your Donation is matched');
        }
        else{
            $details = [
                'head' => 'New Donation',
                'greeting' => 'Hello '.$need->user->name,
                'body' => 'You have successfully matched with new donation check your notifications',
                'url' => route('needs.show', $need->id),
                'id' => $need->id,
            ];
            $details1 = [
                'head' => 'New Mathced Donation',
                'greeting' => 'Hello '.$donation->dist->name,
                'body' => 'Your Donation is matched with '.$need->user->name,
                'url' => route('dist.donations.show', $donation->id),
                'id' => $donation->id,
            ];
            Notification::send($need->user, new NewMatchingNotification ($details));
            Notification::send($donation->dist, new NewMatchingNotificationDonor ($details1));
            return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. your donation is matched with '.$need->user->name. ' check your notifications for more details');
        }
    }

    public function show($id)
    {
        $dist = auth()->guard('dist')->user();
        $donation = Donation::find($id);
        foreach ($dist->unreadNotifications as $notification) {
            if ($notification->data['id'] == $donation->id) {
                $notification->markAsRead();
                break;
            }
        }
        return view('dist.donation.show', compact('donation'));
    }
}
