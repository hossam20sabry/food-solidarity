<?php

namespace App\Http\Controllers\Dist\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Notifications\FoodSolidariry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('dist.auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $details = [
            'greeting' => 'Hello!',
            'firstline' => 'You are receiving this email because we received a password reset request for your account.            ',
            'secondtline' => 'This password reset link will expire in 60 minutes. If you did not request a password reset, no further action is required.',

            'button' => 'Reset Password',
            'url' => route('dist.password.reset', ['token' => $request->_token]),
            'lastline' => 'Thank you',
        ];

        $dist = Dist::where('email', $request->email)->first();

        if(!$dist) return back()->withInput($request->only('email'));

        Notification::send($dist , new FoodSolidariry($details));

        return back()->with('status', 'We have emailed your password reset link!');

        // $status = Password::broker('dists')->sendResetLink(
        //     $request->only('email')
        // );

        // return $status == Password::RESET_LINK_SENT
        //             ? back()->with('status', __($status))
        //             : back()->withInput($request->only('email'))
        //                     ->withErrors(['email' => __($status)]);
    }
}
