<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroClimatico extends Model
{
    use HasFactory;

    // Indicamos que este modelo usa la tabla 'climas'
    protected $table = 'climas';

    // Permitimos que estos campos se llenen desde el formulario
    protected $fillable = [
        'ciudad_id', 
        'estado_clima', 
        'temperatura'
    ];

    /**
     * Relación: Un registro pertenece a una Ciudad
     */
   

    public function ciudad() {
        // El segundo parámetro 'ciudad_id' es la llave foránea en tu tabla climas
        return $this->belongsTo(Ciudad::class, 'ciudad_id'); 
    }
}