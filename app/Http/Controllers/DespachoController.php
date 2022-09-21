<?php

namespace App\Http\Controllers;

use App\Models\Despacho;
use Illuminate\Http\Request;

class DespachoController extends Controller
{
    /**
     * @OA\Post(
     *     path="/despachos",
     *     operationId="store",
     *     description="Registra un nuevo despacho para el Cliente",
     *     tags={"Despachos"},
     *     @OA\RequestBody(
     *         description="Datos de despacho",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *              @OA\Schema(
     *                 @OA\Property(
     *                     property="cliente_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="direccion_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="envio_domicilio",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="fecha_despacho",
     *                     type="date"
     *                 ),
     *                 @OA\Property(
     *                     property="cod_tienda_retiro",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="estado_despacho",
     *                     type="integer"
     *                 ),
     *                 example={"cliente_id": 1, "direccion_id": 1, "envio_domicilio": 1, "fecha_despacho": "02/03/2022","cod_tienda_retiro": "TD004", "estado_despacho": 1}
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
            "direccion_id" => "required|numeric",
            "envio_domicilio" => "required",
            "fecha_despacho" => "required",
            "cod_tienda_retiro" => "required|numeric",
            "estado_despacho" => "required"
        ]);
        $input = $request->all();
        $depacho = Despacho::create($input);
        if ($depacho->id > 0){
            return response()->json(["code"=>201, "msg"=>"Registro Guardado"]); //Created
        }else{
            return response()->json(["code"=>409, "msg"=>"Datos de registro en conflicto"]); //Conflict
        }
    }
}
