<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = "pedidos";

    protected $fillable = [
        'cliente_id', 'carrito_id', 'fecha', 'despacho_id', 'pago_id', 'estado'
    ];

    public function detalles(){
        return $this->hasMany(DetallePedido::class,'pedido_id','id');
    }
}
