<?php

namespace App\Http\Controllers\Ben;

use App\Http\Controllers\Controller;
use App\Models\Need;
use App\Notifications\NewRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $needs = $user->needs;

        return view('ben.index', compact('needs'));
    }

    public function notifications(){
        $notifications = auth()->user()->Notifications;
        return view('notifications', compact('notifications'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        //start validation
        if($request->qty == null){
            return redirect()->back()->with('error', 'Quantity is required');
        }
        if($request->type == null){
            return redirect()->back()->with('error', 'Type is required');
        }
        //end validation

        if($user->authType->name == 'individual' && $request->qty > 10){
            return redirect()->back()->with('error', 'Maxmimum quantity is 10');
        }

        
        $need = Need::create([
            'user_id' => $user->id,
            'donation_type_id' => $request->type,
            'quantity' => $request->qty,
            'status' => 'confirmed',
        ]);

        $details = [
            'head' => 'New Request',
            'greeting' => 'Hello '.$user->name,
            'body' => 'You have successfully created new Request',
            'url' => route('needs.show', $need->id),
            'id' => $need->id,
        ];

        Notification::send($user, new NewRequest($details));

        return redirect()->back()->with('status', 'Needs created successfully');

    }

    public function show(Need $need)
    {
        $ben = auth()->user();
        return view('ben.show', compact('need', 'ben'));
    }
}
