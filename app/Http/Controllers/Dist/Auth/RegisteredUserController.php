<?php

namespace App\Http\Controllers\Dist\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AuthType;
use App\Models\Dist;
use App\Models\DistAuthType;
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
        $authorTypes = DistAuthType::all();
        return view('dist.auth.register', compact('authorTypes'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dist_auth_type_id' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Dist::class],
            'phone' => ['required', 'string', 'max:255', 'unique:'.Dist::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $dist = Dist::create([
            'name' => $request->name,
            'dist_auth_type_id' => $request->dist_auth_type_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($dist));

        Auth::guard('dist')->login($dist);

        return redirect('/');
    }
}
