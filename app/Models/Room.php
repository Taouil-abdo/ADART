<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;

    protected $fillable = ['id', 'roomNumber', 'roomStatus', 'capacity', 'block'];

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
