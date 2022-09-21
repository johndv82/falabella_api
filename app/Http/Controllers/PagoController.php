<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * @OA\Post(
     *     path="/pagos",
     *     operationId="store",
     *     description="Registra un nuevo pago del Cliente",
     *     tags={"Pagos"},
     *     @OA\RequestBody(
     *         description="Datos de pago",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *              @OA\Schema(
     *                 @OA\Property(
     *                     property="cliente_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="metodo_pago",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="monto_pago",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="cupon_descuento",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="fecha",
     *                     type="date"
     *                 ),
     *                 example={"cliente_id": 1, "metodo_pago": "CREDITO", "monto_pago": 450.5, "cupon_descuento": "CGVFFD6FGF7","fecha": "02/03/2022"}
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
            "metodo_pago" => "required",
            "monto_pago" => "required|numeric|between:0,9999.99",
            "fecha" => "required"
        ]);
        $input = $request->all();
        $pago = Pago::create($input);
        if ($pago->id > 0){
            return response()->json(["code"=>201, "msg"=>"Registro Guardado"]); //Created
        }else{
            return response()->json(["code"=>409, "msg"=>"Datos de registro en conflicto"]); //Conflict
        }
    }
}
