<?php

namespace App\Http\Controllers\Dist;

use App\Http\Controllers\Controller;
use App\Models\CookedMeal;
use App\Models\Donation;
use App\Models\DonationType;
use App\Models\DryFood;
use App\Models\DryFoodType;
use App\Models\Protein;
use App\Models\ProteinType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->guard('dist')->user();
        $donations = $user->donations->reverse();

        return view('dist.donation.index', compact('donations'));
    }

    public function store(Request $request)
    {
        $dist = auth()->guard('dist')->user();
        
        $donation = new Donation();
        $donation->dist_id = $dist->id;
        $donation->quantity = 0;
        $donation->save();

        return redirect()->route('dist.donations.choose', $donation->id);
    }

    public function choose($id)
    {
        $donation = Donation::find($id);
        $dryFoods = DryFoodType::all();
        return view('dist.donation.choose', compact( 'dryFoods', 'donation'));
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
            $dryFoods = DryFoodType::all();
            return view('dist.donation.create1', compact( 'dryFoods', 'donation'));
        }
        elseif($donation->donation_type == 2){
            $cookedMeals = CookedMeal::all();
            return view('dist.donation.create2', compact('cookedMeals', 'donation'));
        }elseif($donation->donation_type == 3){
            $proteins = ProteinType::all();
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
        
                $dryFoodType = DryFoodType::find($dryFoodId);
        
                if ($dryFoodType) {
                    $newDryFood = new DryFood();
                    $newDryFood->name = $dryFoodType->name;
                    $newDryFood->donation_id = $donation->id;
                    $newDryFood->save();

                    $newDryFood->dryFoodTypes()->attach($dryFoodId, ['quantity' => $quantity, 'epiration_date' => $expDate]);
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
        return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. Now you have increased your chances to be among Top Donors...');
                
    }

    public function cooked(Request $request){
        $request->validate([
            'quantity' => 'required',
            'cooked_time' => 'required',
        ]);

        $donation = Donation::find($request->donation_id);

        $cookedMeal = new CookedMeal();
        $cookedMeal->donation_id = $donation->id;
        $cookedMeal->quantity = $request->quantity;
        $cookedMeal->cooked_time = $request->cooked_time;
        $cookedMeal->save();

        $donation->quantity = $request->quantity;
        $donation->status = 'confirmed';
        $donation->save();
        
        return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. Now you have increased your chances to be among Top Donors...');

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

                $proteinType = ProteinType::find($proteinsId);
        
                if ($proteinType) {
                    $newProtein = new Protein();
                    $newProtein->name = $proteinType->name;
                    $newProtein->donation_id = $donation->id;
                    $newProtein->save();

                    $newProtein->proteinTypes()->attach($proteinsId, ['qty' => $quantity, 'exp' => $expDate]);
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

        return redirect()->route('dist.donations.index')->with('status', 'Thank you for Donation. Now you have increased your chances to be among Top Donors...');

    }

    public function show($id)
    {
        $donation = Donation::find($id);
        return view('dist.donation.show', compact('donation'));
    }
}
