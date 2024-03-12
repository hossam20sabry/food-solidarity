<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dist;
use App\Models\Donation;
use App\Models\DonorComplaint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $topDonors = Dist::with('donations')
            ->select('dists.id', 'dists.name', 'dists.email', DB::raw('SUM(donations.quantity) as total_quantity'))
            ->where('donations.status', 'matched')
            ->join('donations', 'dists.id', '=', 'donations.dist_id')
            ->groupBy('dists.id', 'dists.name')
            ->orderByDesc('total_quantity')
            ->take(10)
            ->get();

        // Donations
        $startDate = Carbon::now()->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $startDateWeek = Carbon::now()->startOfWeek();
        $endDateWeek = Carbon::now()->endOfWeek();

        $startDateMonth = Carbon::now()->startOfMonth();
        $endDateMonth = Carbon::now()->endOfMonth();

        $totalDonations = Donation::where('status', '!=','pending')->count();

        $totalDonationsMatched = Donation::where('status', 'matched')->count();

        $donationsDay = Donation::where('matched_at',  '>=', $startDate)
                            ->where('matched_at',  '<=', $endDate)->count();

        $totalDonationsDay = Donation::where('created_at',  '>=', $startDate)
                            ->where('created_at',  '<=', $endDate)->count();

        $donationsWeek = Donation::where('matched_at', '>=', $startDateWeek)
                            ->where('matched_at', '<=', $endDateWeek)->count();

        $totalDonationsWeek = Donation::where('created_at', '>=', $startDateWeek)
                            ->where('created_at', '<=', $endDateWeek)->count();
            
        $donationsMonth = Donation::where('matched_at',  '>=', $startDateMonth)
                            ->where('matched_at', '<=', $endDateMonth)->count();

        $totalDonationsMonth = Donation::where('created_at',  '>=', $startDateMonth)
                            ->where('created_at',  '<=', $endDateMonth)->count();


        // Complaints
        $UnsolvedComplaints = DonorComplaint::where('answered', 0)->count();

        $solvedComplaints = DonorComplaint::where('answered', 1)->count();

        $UnsolvedComplaintsDay = DonorComplaint::where('answered', 0)
                                ->where('created_at',  '>=', $startDate)
                                ->where('created_at',  '<=', $endDate)->count();

        $solvedComplaintsDay = DonorComplaint::where('answered', 1)
                                ->where('created_at', '>=', $startDate)
                                ->where('created_at', '<=', $endDate)->count();

        $UnsolvedComplaintsWeek = DonorComplaint::where('answered', 0)
                                ->where('created_at', '>=', $startDateWeek)
                                ->where('created_at', '<=', $endDateWeek)->count();

        $solvedComplaintsWeek = DonorComplaint::where('answered', 1)
                                ->where('created_at', '>=', $startDateWeek)
                                ->where('created_at', '<=', $endDateWeek)->count();

        $UnsolvedComplaintsMonth = DonorComplaint::where('answered', 0)
                                ->where('created_at', '>=', $startDateMonth)
                                ->where('created_at', '<=', $endDateMonth)->count();

        $solvedComplaintsMonth = DonorComplaint::where('answered', 1)
                                ->where('created_at', '>=', $startDateMonth)
                                ->where('created_at', '<=', $endDateMonth)->count();


        return view('admin.dashboard', compact('donationsDay', 
            'donationsWeek', 'donationsMonth', 'UnsolvedComplaintsDay', 'solvedComplaintsDay',
            'totalDonations', 'totalDonationsMatched', 'totalDonationsDay', 
            'totalDonationsWeek', 'totalDonationsMonth', 'solvedComplaintsWeek', 'solvedComplaintsMonth',
            'UnsolvedComplaintsWeek', 'UnsolvedComplaintsMonth', 'UnsolvedComplaints', 'solvedComplaints',
            'topDonors'
        ));
    }
}
