<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    /** @use HasFactory<\Database\Factories\StockFactory> */
    use HasFactory;
    protected $fillable = ['stock_id', 'item_name', 'quantity', 'stock_status', 'unit','category_id', 'supplier_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier(){
        return $this->belongsTo(supplier::class);
    }
   

}
