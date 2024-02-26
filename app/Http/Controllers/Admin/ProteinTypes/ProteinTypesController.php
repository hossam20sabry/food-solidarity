<?php

namespace App\Http\Controllers\Admin\ProteinTypes;

use App\Http\Controllers\Controller;
use App\Models\Protein;
use App\Models\ProteinType;
use Illuminate\Http\Request;

class ProteinTypesController extends Controller
{
    public function index()
    {
        $types = ProteinType::all();
        return view('admin.proteinType.index', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $proteinType = new ProteinType();
        $proteinType->name = $request->name;
        $proteinType->save();

        return redirect()->route('admin.proteinTypes.index')->with('success', 'Dry Food Type created successfully');
    }

    public function edit($id)
    {
        $type = ProteinType::find($id);
        return view('admin.proteinType.edit', compact('type'));
    }   

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $proteinType = ProteinType::find($id);
        $proteinType->name = $request->name;
        $proteinType->save();

        return redirect()->route('admin.proteinTypes.index')->with('status', 'Dry Food Type updated successfully');
    }

    public function destroy($id)
    {
        $proteinType = ProteinType::find($id);
        $proteinType->delete();
        return redirect()->route('admin.proteinTypes.index')->with('status', 'Dry Food Type deleted successfully');
    }
}
