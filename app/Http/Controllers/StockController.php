<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StockController extends Controller
{
    /**
     * Display a listing of the stocks.
     */
    public function index()
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

      $lowStockItems = Stock::where('StockStatus', 'Low Stock')->count();
      $outOfStockItems = Stock::where('StockStatus', 'Out of Stock')->count();
      $recentStocks = Stock::with(['category', 'supplier'])->latest()->take(5)->get();

      $stocks = Stock::with(['category', 'supplier'])->latest()->paginate(5);
      $categories = Category::all();
      $suppliers = Supplier::all();

      return view('Admin.stock.stock', compact('totalItems', 'totalQuantity', 'stockStatusCounts', 
            'itemsByCategory', 'lowStockItems', 'outOfStockItems','recentStocks','stocks','categories',
        'suppliers'
       ));    
   }

    /**
     * Store a newly created stock in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);
        
        // Generate a unique stock ID
        $validated['stock_id'] = 'STK-' . Str::upper(Str::random(6));
        
        // Set stock status based on quantity
        if ($validated['quantity'] > 10) {
            $validated['StockStatus'] = 'In Stock';
        } elseif ($validated['quantity'] > 0) {
            $validated['StockStatus'] = 'Low Stock';
        } else {
            $validated['StockStatus'] = 'Out of Stock';
        }

        Stock::create($validated);

        return redirect()->route('stock.index')
            ->with('success', 'Stock item created successfully.');
    }

    /**
     * Update the specified stock in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);
        
        // Set stock status based on quantity
        if ($validated['quantity'] > 10) {
            $validated['StockStatus'] = 'In Stock';
        } elseif ($validated['quantity'] > 0) {
            $validated['StockStatus'] = 'Low Stock';
        } else {
            $validated['StockStatus'] = 'Out of Stock';
        }

        $stock->update($validated);

        return redirect()->route('stock.index')
            ->with('success', 'Stock item updated successfully.');
    }

    /**
     * Remove the specified stock from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stock.index')
            ->with('success', 'Stock item deleted successfully.');
    }

    
}