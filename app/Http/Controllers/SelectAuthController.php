<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SelectAuthController extends Controller
{
    public function login()
    {
        return view('selectAuth.login');
    }

    public function register()
    {
        return view('selectAuth.register');
    }

}
