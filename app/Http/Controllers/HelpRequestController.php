<?php

namespace App\Http\Controllers;

use App\Models\HelpRequest;
use Illuminate\Http\Request;

class HelpRequestController extends Controller
{
    public function index()
{
    // All help requests from all users
    $helps = HelpRequest::latest()->get();
    return view('helps.index', compact('helps'));
}

public function myHelps()
{
    // Help requests submitted by logged in user only
    $helps = auth()->user()->helpRequests()->latest()->get();
    return view('helps.my', compact('helps'));
}


    public function create()
    {
        return view('helps.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'help_type' => 'required|string',
        'description' => 'required|string',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'address' => 'required|string',
    ]);

    HelpRequest::create([
        'help_type' => $request->help_type,
        'description' => $request->description,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'address' => $request->address,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('dashboard')->with('success', 'Help request submitted successfully!');
}

}
