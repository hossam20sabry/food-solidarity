<?php

namespace App\Http\Controllers\Dist\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Dist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required'],
        ]);
        
        $dist = Auth::guard('dist')->user();
        $dist = Dist::find($dist->id);


        if(!Hash::check($request->current_password, $dist->password)) {
            return Redirect::back()->withErrors(['password' => 'The provided password is incorrect.']);
        }

        $dist->password = Hash::make($request->password);
        $dist->save();

        return back()->with('status', 'password-updated1');
    }
}
