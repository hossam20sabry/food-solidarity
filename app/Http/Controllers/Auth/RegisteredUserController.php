<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuthType;
use App\Models\City;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $authorTypes = AuthType::where('flag', '1')->get();
        $cities = City::all();
        return view('auth.register', compact('authorTypes', 'cities'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'not_regex:/<\s*script|<\s*\/script\s*>|<\s*html|<\s*\/html\s*>/i'],
            'city_id' => ['required'],
            'auth_type_id' => ['required', 'not_regex:/<\s*script|<\s*\/script\s*>|<\s*html|<\s*\/html\s*>/i'],
            'address' => ['required', 'not_regex:/<\s*script|<\s*\/script\s*>|<\s*html|<\s*\/html\s*>/i'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class, 'not_regex:/<\s*script|<\s*\/script\s*>|<\s*html|<\s*\/html\s*>/i'],
            'phone' => ['required', 'string', 'max:255', 'unique:'.User::class, 'not_regex:/<\s*script|<\s*\/script\s*>|<\s*html|<\s*\/html\s*>/i'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'auth_type_id' => $request->auth_type_id,
            'city_id' => $request->city_id,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
