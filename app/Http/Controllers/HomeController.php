<?php

namespace App\Http\Controllers;

use App\Models\AwarenessArticle;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $article = AwarenessArticle::where('explore', 1)->first();
        return view('welcome', compact('article'));
    }
}
