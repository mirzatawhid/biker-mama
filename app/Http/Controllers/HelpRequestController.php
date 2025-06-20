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
            'location' => 'required',
            'situation' => 'required',
            'contact_number' => 'required',
            'urgency_level' => 'required|in:low,medium,high',
        ]);

        HelpRequest::create([
            'user_id' => auth()->id(),
            'location' => $request->location,
            'situation' => $request->situation,
            'contact_number' => $request->contact_number,
            'urgency_level' => $request->urgency_level,
        ]);

        return redirect()->route('helps.index')->with('success', 'Help request sent!');
    }
}
