<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function index(){
        $admins = Admin::all();
        return view('admin.index', compact('admins'));
    }

    public function destroy(Request $request)
    {
        $current_admin = auth()->guard('admin')->user();
        if ($current_admin->id == $request->id) {
            return redirect()->route('admin.index')->with('error', 'You can not delete your own account');
        }

        if($current_admin->main == 1) {
            $admin = Admin::find($request->id);
            $admin->delete();
            return redirect()->route('admin.index')->with('status', 'Admin deleted successfully');
        }
        else{
            return redirect()->route('admin.index')->with('error', 'this is process not allowed for you');
        }

    }

    public function main(Request $request)
    {
        $admin = auth()->guard('admin')->user();
        
        if($admin->main == 1) {
            $admin = Admin::find($request->id);
            $admin->main = 1;
            $admin->save();
            return redirect()->route('admin.index')->with('status', 'Admin become main admin successfully');
        }
        else{
            return redirect()->route('admin.index')->with('error', 'this is process not allowed for you'); 
        }

    }
}
