<?php
namespace App\Http\Controllers;
use App\Models\HazardReport;
use Illuminate\Http\Request;

class HazardReportController extends Controller
{

    public function index()
{
    // All hazards from all users
    $hazards = HazardReport::latest()->get();
    return view('hazards.index', compact('hazards'));
}

public function myHazards()
{
    // Hazards submitted by logged in user only
    $hazards = auth()->user()->hazardReports()->latest()->get();
    return view('hazards.my', compact('hazards'));
}


    public function create()
    {
        return view('hazards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required',
            'description' => 'required',
            'hazard_type' => 'required|in:pothole,construction,accident,other',
        ]);

        HazardReport::create([
            'user_id' => auth()->id(),
            'location' => $request->location,
            'description' => $request->description,
            'hazard_type' => $request->hazard_type,
        ]);

        return redirect()->route('hazards.index')->with('success', 'Hazard reported successfully!');
    }
}
