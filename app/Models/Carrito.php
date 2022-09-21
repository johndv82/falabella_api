<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = "carrito";
    protected $fillable = [
        'cliente_id', 'producto_id', 'cantidad', 'fecha'
    ];
}
