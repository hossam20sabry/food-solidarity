<?php

namespace App\Http\Controllers\Dist\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        
        if ($request->user('dist')->hasVerifiedEmail()) {
            return redirect()->intended('/dist?verified=1');
        }

        if ($request->user('dist')->markEmailAsVerified()) {
            event(new Verified($request->user('dist')));
        }

        return redirect()->intended('/dist?verified=1');
    }
}
