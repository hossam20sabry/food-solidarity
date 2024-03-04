<?php

namespace App\Http\Controllers\Admin\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('admin.city.index', compact('cities'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $dryFoodType = new City();
        $dryFoodType->name = $request->name;
        $dryFoodType->save();

        return redirect()->route('admin.cities.index')->with('success', 'City created successfully');
    }


    public function edit($id)
    {
        $city = City::find($id);
        return view('admin.city.edit', compact('city'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $city = City::find($id);
        $city->name = $request->name;
        $city->save();

        return redirect()->route('admin.cities.index')->with('status', 'City updated successfully');
    }


    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();
        return redirect()->route('admin.cities.index')->with('status', 'City deleted successfully');
    }


}
