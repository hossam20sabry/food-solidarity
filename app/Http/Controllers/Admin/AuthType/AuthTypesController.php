<?php

namespace App\Http\Controllers\Admin\AuthType;

use App\Http\Controllers\Controller;
use App\Models\AuthType;
use Illuminate\Http\Request;

class AuthTypesController extends Controller
{
    public function index()
    {
        $types = AuthType::all();
        return view('admin.authType.index', compact('types'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $authType = new AuthType();
        $authType->name = $request->name;
        $authType->save();

        return redirect()->route('admin.authTypes.index')->with('success', 'Auth Type created successfully');
    }

    public function edit($id)
    {
        $type = AuthType::find($id);
        return view('admin.authType.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $authType = AuthType::find($id);
        $authType->name = $request->name;
        $authType->save();

        return redirect()->route('admin.authTypes.index')->with('status', 'Auth Type updated successfully');
    }

    public function destroy($id)
    {
        $authType = AuthType::find($id);
        $authType->delete();
        return redirect()->route('admin.authTypes.index')->with('status', 'Auth Type deleted successfully');
    }

    
}
