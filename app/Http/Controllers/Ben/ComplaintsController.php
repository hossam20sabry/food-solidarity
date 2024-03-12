<?php

namespace App\Http\Controllers\Ben;

use App\Http\Controllers\Controller;
use App\Models\BenComplaint;
use Illuminate\Http\Request;

class ComplaintsController extends Controller
{
    public function create()
    {
        return view('ben.complaints.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        BenComplaint::create([
            'content' => $request->text,
            'user_id' => auth()->guard('web')->user()->id
        ]);

        return redirect()->back()->with('success', 'Your complaint has been sent successfully we will get back to you soon on your Notifications.');
    }
}
