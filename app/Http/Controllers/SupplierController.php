<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = supplier::query();
   
        if ($request->wantsJson() || $request->ajax()) {

          $search = $request->q;
          $query->where('name', 'like', "%{$search}%")
              ->orWhere('id', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phoneNumber', 'like', "%{$search}%")
              ->orWhere('suppliedProduct', 'like', "%{$search}%");
          return response()->json([
            'suppliers' => $query->get()
          ]);
        }
        $suppliers = $query->paginate(5);
        return view('Admin.suppliers.supplier', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        try {
            Supplier::create($request->validated());
            return redirect()->route("supplier.create")->with(['success'=>'Supplier Added successfully']);
        } catch (Exception $e) {
            return response()->json(['error'=> 'Failed to add supplier']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('Admin.suppliers.update', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        try {
            $supplier->update($request->validated());
            return response()->json(['success'=>'Supplier updated successfully']);
        } catch (Exception $e) {
            return response()->json(['error'=> 'Failed to update supplier']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        try {
            $supplier->delete();
            return response()->json(['success' => 'Supplier deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete supplier']);
        }
    }

    
}
