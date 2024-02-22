<?php

namespace App\Http\Controllers\Admin\DryFoodType;

use App\Http\Controllers\Controller;
use App\Models\DryFoodType;
use Illuminate\Http\Request;

class DryFoodTypesController extends Controller
{
    public function index()
    {
        $types = DryFoodType::all();
        return view('admin.dryFoodType.index', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $dryFoodType = new DryFoodType();
        $dryFoodType->name = $request->name;
        $dryFoodType->save();

        return redirect()->route('admin.dryFoodTypes.index')->with('success', 'Dry Food Type created successfully');
    }

    public function edit($id)
    {
        $type = DryFoodType::find($id);
        return view('admin.dryFoodType.edit', compact('type'));
    }   

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $dryFoodType = DryFoodType::find($id);
        $dryFoodType->name = $request->name;
        $dryFoodType->save();

        return redirect()->route('admin.dryFoodTypes.index')->with('status', 'Dry Food Type updated successfully');
    }

    public function destroy($id)
    {
        $dryFoodType = DryFoodType::find($id);
        $dryFoodType->delete();
        return redirect()->route('admin.dryFoodTypes.index')->with('status', 'Dry Food Type deleted successfully');
    }

}
