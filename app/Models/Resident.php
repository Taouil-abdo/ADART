<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'email',
        'status',
        'profile_img',
        'birthday',
        'address',
        'age',
        'gender',
        'school_level',
        'date_joined',
        'date_detached',
        'urgent_contact',
        'school',
        'health_condition',
        'disease_type',
        'room_id',
    ];

    public function room(){
        return $this->belongsTo(Room::class);
    }

}
