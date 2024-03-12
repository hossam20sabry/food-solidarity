<?php

namespace App\Http\Controllers\Admin\FoodType;

use App\Http\Controllers\Controller;
use App\Models\FoodType;
use Illuminate\Http\Request;

class FoodTypesController extends Controller
{
    public function index()
    {
        $types = FoodType::all();
        return view('admin.FoodType.index', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'flag' => 'required|in:1,0'
        ]);

        $FoodType = new FoodType();
        $FoodType->name = $request->name;
        $FoodType->flag = $request->flag;
        $FoodType->save();

        return redirect()->route('admin.FoodTypes.index')->with('success', 'Dry Food Type created successfully');
    }

    public function edit($id)
    {
        $type = FoodType::find($id);
        return view('admin.FoodType.edit', compact('type'));
    }   

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'flag' => 'required'
        ]);

        $FoodType = FoodType::find($id);
        $FoodType->name = $request->name;
        $FoodType->flag = $request->flag;
        $FoodType->save();

        return redirect()->route('admin.FoodTypes.index')->with('status', 'Dry Food Type updated successfully');
    }

    public function destroy($id)
    {
        try{
            $FoodType = FoodType::find($id);
            $FoodType->delete();
            return redirect()->route('admin.FoodTypes.index')->with('status', 'Food Type deleted successfully');
        }
        catch(\Exception $e){
            return redirect()->route('admin.FoodTypes.index')->with('status', 'Food Type cannot be deleted');
        }

    }
}
