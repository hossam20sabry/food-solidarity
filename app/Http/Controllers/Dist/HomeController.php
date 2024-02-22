<?php

namespace App\Http\Controllers\Dist;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationType;
use App\Models\DryFood;
use App\Models\DryFoodType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->guard('dist')->user();
        $donations = $user->donations;
        return view('dist.donation.index', compact('donations'));
    }

    public function create()
    {
        $donationType = DonationType::all();
        $dryFoods = DryFoodType::all();
        return view('dist.donation.create', compact('donationType', 'dryFoods'));
    }

    public function store(Request $request)
    {
        $dist = auth()->guard('dist')->user();
        
        $donation = new Donation();
        $donation->dist_id = $dist->id;
        $donation->quantity = 0;
        $donation->save();

        return redirect()->route('dist.donations.create', compact('donation'));
    }

    public function donationType(Request $request)
    {
        $donationType = DonationType::find($request->type_id);
        $donation = Donation::find($request->donation_id);
        $donation->donation_type_id = $donationType->id;
        $donation->save();
        
        if($donation)
        {
            if($donation->donation_type_id == 7){
                return response()->json([
                    'status' => 200,
                    'type' => 7
                ]);
            }else{
                return response()->json([
                    'status' => 200,
                    'type' => 8
                ]);
                
            }
        }else{
            return response()->json([
                'status' => 400,
            ]);
        }
    }

    public function dryFood(Request $request){
        $request->validate([
            'dryFoods' => 'required|array',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);
    
        // Get the selected dry food types and their quantities from the request
        $dryFoods = $request->input('dryFoods');
        $quantities = $request->input('quantities');
    
        // Get the authenticated distributor
        $dist = auth()->guard('dist')->user();
    
        // Attach the selected dry food types to the distributor with quantities
        $dist->dryFoods->attach($dryFoods, function ($pivotData) use ($quantities) {
            $pivotData->quantity = $quantities[$pivotData->dry_food_type_id];
        });
    }
}
