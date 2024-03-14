<?php

namespace App\Http\Controllers\Dist;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Dist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $dist = Auth::guard('dist')->user();
        $cities = City::all();
        return view('dist.profile.edit', [
            'user' => $dist,
            'cities' => $cities
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'not_regex:/<\s*script|<\s*\/script\s*>|<\s*html|<\s*\/html\s*>/i'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::guard('dist')->user()->id, 'not_regex:/<\s*script|<\s*\/script\s*>|<\s*html|<\s*\/html\s*>/i'],
            'city_id' => ['required', 'string', 'max:255', 'not_regex:/<\s*script|<\s*\/script\s*>|<\s*html|<\s*\/html\s*>/i'],
        ]);

        $dist = Dist::find(Auth::guard('dist')->user()->id);
        $dist->update($request->all());
        return redirect()->route('dist.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);

        $dist = Auth::guard('dist')->user();

        if(! Auth::guard('dist')->check() || ! Hash::check($request->password, $dist->password)) {
            return Redirect::back()->withErrors(['password' => 'The provided password is incorrect.']);
        }

        Auth::guard('dist')->logout(); 
        $dist = Dist::find($dist->id);
        $dist->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
