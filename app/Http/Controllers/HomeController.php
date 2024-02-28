<?php

namespace App\Http\Controllers;

use App\Models\AwarenessArticle;
use App\Notifications\NewDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function index()
    {
        $article = AwarenessArticle::where('explore', 1)->first();
        return view('welcome', compact('article'));
    }

    public function notification()
    {
        $user = auth()->user();

        $details = [
            'greeting' => 'Hello '. $user->name,
            'firstline' => 'Thank you for your donation',
            'url' => '/',
            'lastline' => 'Thank you',
        ];
        
        Notification::send($user, new NewDonation($details));

        return redirect('/');
    }
}
