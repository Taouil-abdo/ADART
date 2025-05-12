<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StockRequest;

class StockController extends Controller
{
    /**
     * Display a listing of the stocks.
     */

     private $alert_quantity = 100;

     public function index(Request $request)
     {
         $totalItems = Stock::count();
         $totalQuantity = Stock::sum('quantity');
         $stockStatusCounts = Stock::select('StockStatus', DB::raw('count(*) as count'))
         ->groupBy('StockStatus')
         ->get();

         $itemsByCategory = Stock::select('categories.name as category', DB::raw('count(*) as count'))
         ->join('categories', 'stocks.category_id', '=', 'categories.id')
         ->groupBy('categories.name')
         ->get();
         
         $lowStockItems = Stock::where('StockStatus', 'low_stock')->count();
         $outOfStockItems = Stock::where('StockStatus', 'out_of_stock')->count();
         $recentStocks = Stock::with(['category', 'supplier'])->latest()->take(5)->get();

         $query = supplier::query();
         if($request->ajax() || $request->wantsJson()){
             $search = $request->q;
             $query = Stock::with(['category', 'supplier'])
                 ->where('item_name', 'LIKE', "%$search%")
                 ->orWhere('quantity', 'LIKE', "%$search%")
                 ->orWhere('StockStatus', 'LIKE', "%$search%");
             return response()->json([
                 'stocks'=> $query->get()
             ]);
         }
         
         $stocks = Stock::with(['category', 'supplier'])->latest()->paginate(5);

         return view('Admin.stock.stock', compact('totalItems', 'totalQuantity', 'stockStatusCounts', 
            'itemsByCategory', 'lowStockItems', 'outOfStockItems','recentStocks','stocks'
         )); 
     } 

   public function create(){
     $categories = Category::all();
     $suppliers = Supplier::all();
     return view('Admin.stock.create', compact('categories', 'suppliers'));
   }

    /**
     * Show the form for editing the specified stock.
     */
    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('Admin.stock.update', compact('stock', 'categories', 'suppliers'));
   }
    /**
     * Store a newly created stock in storage.
     */
    public function store(StockRequest $request)
    {
        $data = $request->validated();
        $data['StockStatus'] = $this->determineStockStatus($data['quantity']);
        Stock::create($data);
        return redirect()->route('stock.index')->with('success', 'Stock item created successfully.');
    }

    /**
     * Update the specified stock in storage.
     */
    public function update(StockRequest $request, $id)
    {
        $stock = Stock::findOrFail($id);
        $validated = $request->validated();
        $validated['StockStatus'] = $this->determineStockStatus($validated['quantity']);
        $stock->update($validated);
        if($stock){
            return response()->json(["success" => "Stock item updated successfully."]);
        }else{
            return response()->json(["error" => "Stock item not found."], 404);
        }
    }

    /**
     * Remove the specified stock from storage.
     */
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        if (!$stock) {
            return response()->json(["error" => "Stock item not found."], 404);
        }
        $stock->delete();
        return response()->json(["success" => "Stock item deleted successfully."]);
    }
    /**
     * Determine the stock status based on the quantity.
     */
    public function determineStockStatus($quantity)
    {
        if ($quantity > 20) {
            return 'in_stock';
        } elseif ($quantity > 1) {
            return 'low_stock';
        } else {
            return 'out_of_stock';
        }
    }
    
}