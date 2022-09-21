<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = "direcciones";
    protected $fillable = [
        'descripcion', 'cliente_id', 'departamento', 'provincia', 'distrito', 'referencia', 'favorito'
    ];
}
