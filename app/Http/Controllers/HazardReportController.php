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
    $validated = $request->validate([
        'hazard_type' => 'required|string',
        'description' => 'required|string',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'address' => 'required|string',
    ]);

    $validated['user_id'] = auth()->id();

    HazardReport::create($validated);

    return redirect()->route('hazards.index')->with('success', 'Hazard reported successfully!');
}

public function mapView(Request $request)
{
    $type = $request->get('type'); // optional filter
    $hazards = HazardReport::when($type, fn($q) => $q->where('hazard_type', $type))->get();
    $types = HazardReport::select('hazard_type')->distinct()->pluck('hazard_type');

    return view('hazards.map', compact('hazards', 'types', 'type'));
}



}
