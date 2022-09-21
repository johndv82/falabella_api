<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despacho extends Model
{
    protected $table = "despachos";

    protected $fillable = [
        'cliente_id', 'direccion_id', 'envio_domicilio', 'fecha_despacho', 'cod_tienda_retiro', 'estado_despacho'
    ];
}
