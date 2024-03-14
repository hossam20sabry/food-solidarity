<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.edit', [
            'admin' => $admin,
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::guard('admin')->user()->id],
        ]);

        $admin = Admin::find(Auth::guard('admin')->user()->id);
        $admin->update($request->all());
        return redirect()->route('admin.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);

        $admin = Auth::guard('admin')->user();

        if(! Auth::guard('admin')->check() || ! Hash::check($request->password, $admin->password)) {
            return Redirect::back()->withErrors(['password' => 'The provided password is incorrect.']);
        }

        Auth::guard('admin')->logout(); 
        $admin = Admin::find($admin->id);
        $admin->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
