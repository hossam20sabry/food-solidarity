<?php

namespace App\Http\Controllers\Dist\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\Dist;
use App\Notifications\FoodSolidariry;
use Illuminate\Support\Facades\Auth;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('dist')->hasVerifiedEmail()) {
            return redirect()->intended('/dist');
        }

        // $request->user('dist')->sendEmailVerificationNotification('dist');

        // return back()->with('status', 'verification-link-sent');

        if ($request->user('dist')->hasVerifiedEmail()) {
            return redirect()->intended('/dist');
        }

        $dist = Auth::guard('dist')->user();
        $dist = Dist::find($dist->id);

        $url = route('dist.verification.verify', [
            'id' => $dist->getKey(), // Assuming $dist is an Eloquent model
            'hash' => sha1($dist->getEmailForVerification()), // Assuming you're using sha1 hash for the email
        ]);
        
        $details = [
            'greeting' => 'Hello!',
            'firstline' => 'You are receiving this email because we received a password reset request for your account.            ',
            'secondtline' => 'This password reset link will expire in 60 minutes. If you did not request a password reset, no further action is required.',
            'button' => 'Verify Email',
            'url' => $url,   
            'lastline' => 'Thank you', 
        ];


        // if(!$dist) return back()->withInput($request->only('email'));

        Notification::send($dist , new FoodSolidariry($details));

        // $request->user('dist')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
