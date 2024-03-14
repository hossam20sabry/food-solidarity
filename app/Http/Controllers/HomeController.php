<?php

namespace App\Http\Controllers;

use App\Models\AwarenessArticle;
use App\Models\Dist;
use App\Notifications\NewDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function index()
    {
        $article = AwarenessArticle::where('explore', 1)->first();
        $topDonors = Dist::with('donations')
            ->select('dists.id', 'dists.name', 'dists.email', DB::raw('SUM(donations.quantity) as total_quantity'))
            ->where('donations.status', 'matched')
            ->join('donations', 'dists.id', '=', 'donations.dist_id')
            ->groupBy('dists.id', 'dists.name')
            ->orderByDesc('total_quantity')
            ->take(10)
            ->get();

        return view('welcome', compact('article', 'topDonors'));
    }

    public function about()
    {
        return view('aboutUs');
    }

}
