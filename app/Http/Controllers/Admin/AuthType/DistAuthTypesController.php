<?php

namespace App\Http\Controllers\Admin\AuthType;

use App\Http\Controllers\Controller;
use App\Models\DistAuthType;
use Illuminate\Http\Request;

class DistAuthTypesController extends Controller
{
    public function index()
    {
        $types = DistAuthType::all();
        return view('admin.distAuthType.index', compact('types'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $authType = new DistAuthType();
        $authType->name = $request->name;
        $authType->save();

        return redirect()->route('admin.distAuthTypes.index')->with('success', 'Auth Type created successfully');
    }

    public function edit($id)
    {
        $type = DistAuthType::find($id);
        return view('admin.distAuthType.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $authType = DistAuthType::find($id);
        $authType->name = $request->name;
        $authType->save();

        return redirect()->route('admin.distAuthTypes.index')->with('status', 'Auth Type updated successfully');
    }

    public function destroy($id)
    {
        $authType = DistAuthType::find($id);
        $authType->delete();
        return redirect()->route('admin.distAuthTypes.index')->with('status', 'Auth Type deleted successfully');
    }
}
