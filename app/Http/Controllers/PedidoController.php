<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\DetallePedido;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * @OA\Post(
     *     path="/pedidos",
     *     operationId="store",
     *     description="Registra un nuevo pedido del Cliente",
     *     tags={"Pedidos"},
     *     @OA\RequestBody(
     *         description="Datos de Pedido",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *              @OA\Schema(
     *                 @OA\Property(
     *                     property="cliente_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="carrito_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="fecha",
     *                     type="date"
     *                 ),
     *                 @OA\Property(
     *                     property="despacho_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="pago_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="estado",
     *                     type="integer"
     *                 ),
     *                 example={"cliente_id": 1, "carrito_id": 1, "fecha": "02/02/2022", "despacho_id": 3, "pago_id": 2, "estado": 1}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Registro Guardado"
     *     ),
     *     @OA\Response(
     *         response="409",
     *         description="Datos de registro en conflicto"
     *     )
     * )
     */
    public function store(Request $request){
        $this->validate($request,[
            "cliente_id" => "required|numeric",
            "carrito_id" => "required|numeric",
            "fecha" => "required",
            "despacho_id" => "required|numeric",
            "pago_id" => "required|numeric",
            "estado" => "required|numeric"
        ]);
        $input = $request->all();

        $itemsCarrito = Carrito::where("cliente_id", $request->input("cliente_id"))->get();

        $detalles = [];
        foreach ($itemsCarrito as $item) {
            $det = new DetallePedido();
            $det->producto_id = $item['producto_id'];
            $det->cantidad = $item['cantidad'];
            $det->estado = 1;
            $detalles[] = $det;
        }

        $pedido = Pedido::create($input);

        DB::beginTransaction();
        try {
            $pedido->save();
            $pedido->detalles()->saveMany($detalles);
            DB::commit();
            return response()->json(["code"=>201, "msg"=>"Registro Guardado"]); //Created
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["code"=>409, "msg"=>"Datos de registro en conflicto"]); //Conflict
        }
    }
}
