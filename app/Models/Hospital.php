<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    public function vaccines() {
    	return $this->hasMany(Vaccine::class);
  	}

    public function doctors() {
    	return $this->hasMany(Vaccine::class);
  	}
}
