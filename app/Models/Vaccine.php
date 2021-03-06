<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    public function hospital() {
	    return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function orders() {
	    return $this->hasMany(Order::class);
    }
}
