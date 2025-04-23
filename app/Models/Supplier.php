<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'phoneNumber',
        'email',
        'address',
        'suppliedProduct',
        'paymentMethode',
        'isActive',
    ];

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
