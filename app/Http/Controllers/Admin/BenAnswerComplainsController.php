<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BenComplaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class BenAnswerComplainsController extends Controller
{
    public function index(){
        $complaints = BenComplaint::where('answered', 0)->get();
        return view('admin.benAnswerComplaint.index', [
            'complaints' => $complaints
        ]);
    }

    public function create($id){
        $complaint = BenComplaint::find($id);
        return view('admin.benAnswerComplaint.create', [
            'complaint' => $complaint
        ]);
    }

    public function store(Request $request, $id){
        $complaint = BenComplaint::find($id);
        $complaint->answered = 1;

        $details = [
            'head' => 'New Answer',
            'greeting' => 'Hello ' . $complaint->user->name,
            'body' => 'Your Complaint has been resolved.'
        ];

        Notification::send($complaint->user, new \App\Notifications\NewAnswerDonor($details));
        $complaint->save();
        return redirect()->back()->with('success', 'Complaint Answered Successfully.');
    }
}
