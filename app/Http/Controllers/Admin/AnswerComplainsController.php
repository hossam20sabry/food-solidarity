<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonorComplaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class AnswerComplainsController extends Controller
{
    public function index(){
        $complaints = DonorComplaint::where('answered', 0)->get();
        return view('admin.answerComplaint.index', [
            'complaints' => $complaints
        ]);
    }

    public function create($id){
        $complaint = DonorComplaint::find($id);
        return view('admin.answerComplaint.create', [
            'complaint' => $complaint
        ]);
    }

    public function store(Request $request, $id){
        $complaint = DonorComplaint::find($id);
        $complaint->answered = 1;

        $details = [
            'head' => 'New Answer',
            'greeting' => 'Hello ' . $complaint->dist->name,
            'body' => 'Your Complaint has been resolved.'
        ];

        Notification::send($complaint->dist, new \App\Notifications\NewAnswerDonor($details));
        $complaint->save();
        return redirect()->back()->with('success', 'Complaint Answered Successfully.');
    }

}
