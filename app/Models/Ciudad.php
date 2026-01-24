<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ciudad extends Model
{
    protected $table = 'ciudades';
    
    public function region() {
        return $this->belongsTo(Region::class);
    }
}

