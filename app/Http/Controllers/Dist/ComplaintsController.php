<?php

namespace App\Http\Controllers\Dist;

use App\Http\Controllers\Controller;
use App\Models\DonorComplaint;
use Illuminate\Http\Request;

class ComplaintsController extends Controller
{
    public function create()
    {
        return view('dist.complaints.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        DonorComplaint::create([
            'content' => $request->text,
            'dist_id' => auth()->guard('dist')->user()->id
        ]);

        return redirect()->back()->with('success', 'Your complaint has been sent successfully we will get back to you soon on your Notifications.');
    }
}
