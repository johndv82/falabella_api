<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = "pagos";

    protected $fillable = [
        'cliente_id', 'metodo_pago', 'monto_pago', 'cupon_descuento', 'fecha'
    ];
}
