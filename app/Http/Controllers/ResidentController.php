<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Resident;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Exports\ResidentsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreResidentRequest;
use Illuminate\Support\Facades\Log;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Resident::query();
   
    if ($request->wantsJson() || $request->ajax()) {

        $search = $request->q;
        $query->where('fullname', 'like', "%{$search}%")
              ->orWhere('id', 'like', "%{$search}%")
              ->orWhere('gender', 'like', "%{$search}%")
              ->orWhere('status', 'like', "%{$search}%")
              ->orWhere('school', 'like', "%{$search}%")
              ->orWhere('age', 'like', "%{$search}%");
        return response()->json([
            'residents' => $query->get()
        ]);
    }
    $residents = $query->paginate(5);
    return view('Admin.residents.resident', compact('residents'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::where('roomStatus', 'available')->get();
        if ($rooms->isEmpty()) {
            return response()->json(['message' => 'No available rooms'], 404);
        }
        return view('Admin.residents.create', compact('rooms'))->render();
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(StoreResidentRequest $request)
{
    try {
        $room = Room::find($request->room_id);

        if (!$room) {
            return response()->json(['error' => 'Room not found'], 404);
        }
        $residentCount = $room->residents()->count();
        if ($residentCount >= $room->capacity) {
            return response()->json(['error' => 'Room is already full']);
        }        
        Resident::create($request->validated());

        Log::info('Resident created successfully', ['data' => $request->validated()]);
        return response()->json(['success' => 'Resident created successfully']);

    } catch (\Exception $e) {
        Log::error('Failed to add resident', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'Failed to add resident']);
    }
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resident = Resident::findOrFail($id);
        return view('Admin.residents.show', compact('resident'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $resident = Resident::findOrFail($id);
        $rooms = Room::all();
        return view('Admin.residents.update', compact('resident', 'rooms'))->render();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreResidentRequest $request, $id)
    {
        $resident = Resident::findOrFail($id);

        try {
            $resident->update($request->validated());
            Log::info('Resident updated successfully', ['id' => $id, 'data' => $request->all()]);
            return response()->json(['success' => 'Resident updated successfully']);
        } catch (\Exception $e) {
            Log::error('Failed to update resident', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['success' => 'Failed to update resident']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $resident = Resident::findOrFail($id);
        try {
            $resident->delete();
            Log::info('Resident deleted successfully', ['id' => $id]);
            return response()->json(['message' => 'Resident deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Failed to delete resident', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to delete resident']);
        }
    }

    public function search($query)
   {
    $residents = Resident::where('fullname', 'like', '%' . $query . '%')
    ->orWhere('status', 'like', '%' . $query . '%')
    ->orWhere('gender', 'like', '%' . $query . '%')
    ->orWhere('school', 'like', '%' . $query . '%')
    ->orWhere('school_level', 'like', '%' . $query . '%')
    ->orWhere('room_id', 'like', '%' . $query . '%')
    ->get();

    return response()->json(['residents' => $residents]);
 }

    /**
     * Generate and download PDF document for a specific resident
     */
    public function downloadPdf($id)
    {
        $resident = Resident::with('room')->findOrFail($id);

        $pdf = PDF::loadView('Admin.residents.document-pdf', compact('resident'));

        return $pdf->download('resident-' . $resident->id . '-document.pdf');
    }
}
