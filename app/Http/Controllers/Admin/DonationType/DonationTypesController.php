<?php

namespace App\Http\Controllers\Admin\DonationType;

use App\Http\Controllers\Controller;
use App\Models\DonationType;
use Illuminate\Http\Request;

class DonationTypesController extends Controller
{
    public function index()
    {
        $types = DonationType::all();
        return view('admin.donationType.index', compact('types'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'img' => 'required',
            'description' => 'required'
        ]);

        $donationType = new DonationType();
        $donationType->name = $request->name;
        $donationType->description = $request->description;
        $img = $request->file('img');
        if($img) {
            $img_name = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images'), $img_name);
            $donationType->image = $img_name;
        }

        $donationType->save();

        return redirect()->route('admin.donationTypes.index')->with('success', 'Donation Type created successfully');
    }

    public function edit($id)
    {
        $type = DonationType::find($id);
        return view('admin.donationType.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $donationType = DonationType::find($id);
        $donationType->name = $request->name;
        $donationType->description = $request->description;
        
        $img = $request->file('img');
        if($img) {
            $img_name = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images'), $img_name);
            $donationType->image = $img_name;
        }

        $donationType->save();

        return redirect()->route('admin.donationTypes.index')->with('status', 'Donation Type updated successfully');
    }

    public function destroy($id)
    {
        $donationType = DonationType::find($id);
        $donationType->delete();
        return redirect()->route('admin.donationTypes.index')->with('status', 'Donation Type deleted successfully');
    }
    
}
