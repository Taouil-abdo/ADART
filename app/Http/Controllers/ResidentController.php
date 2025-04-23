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
    public function index()
    {
        $residents = Resident::paginate(5);
        return view('Admin.residents.resident',compact('residents'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::all();
        return view('Admin.residents.create', compact('rooms'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResidentRequest $request)
    {
      try {
          Resident::create($request->validated());
          Log::info('Resident created successfully', ['data' => $request->validated()]);
          return redirect()->route('residents.index')->with('success', 'Resident created successfully');
      } catch (\Exception $e) {
          Log::error('Failed to add resident', ['error' => $e->getMessage()]);
          return redirect()->back()->with('error', 'Failed to add resident');
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
        return view('Admin.residents.edit', compact('resident'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(StoreResidentRequest $request, $id)
    {
        $resident = Resident::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:residents,email,' . $resident->id,
            'phone' => 'required|string|max:15',
            'room_id' => 'required|exists:rooms,id',]);
        try {
            $resident->update($request->all());
            Log::info('Resident updated successfully', ['id' => $id, 'data' => $request->all()]);
        } catch (\Exception $e) {
            Log::error('Failed to update resident', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to update resident');
        }

        $resident->update($request->all());

        try {
            $resident->delete();
            Log::info('Resident deleted successfully', ['id' => $id]);
        } catch (\Exception $e) {
            Log::error('Failed to delete resident', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to delete resident');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $resident = Resident::findOrFail($id);
        $resident->delete();

        return redirect()->route('residents.index')->with('success', 'Resident deleted successfully');
    }
    
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');
            $residents = Resident::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('phone', 'LIKE', "%{$query}%")
            ->get();

            return response()->json(['residents' => $residents]);
        }

        return view('Admin.residents.search');
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
