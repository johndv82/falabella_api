<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/carrito_cliente/{id}",
     *     description="Retorna listado de productos en carrito por Cliente",
     *     operationId="listar",
     *     tags={"Carrito"},
     *     @OA\Parameter(
     *         description="ID Cliente",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="listado carrito"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="No hay coincidencias"
     *     )
     * )
     */
    public function listar($id){
        $carrito = Carrito::where("cliente_id", $id)->get();
        if (count($carrito) > 0){
            return $carrito;
        }else{
            return response()->json(["code"=>404, "msg"=>"Not found"]); //Not found
        }
    }

    /**
     * @OA\Post(
     *     path="/carrito",
     *     operationId="store",
     *     description="Agrega nuevo producto al Carrito del Cliente",
     *     tags={"Carrito"},
     *     @OA\RequestBody(
         *         description="Datos de agregado de Carrito",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *              @OA\Schema(
     *                 @OA\Property(
     *                     property="cliente_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="producto_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="cantidad",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="fecha",
     *                     type="date"
     *                 ),
     *                 example={"cliente_id": 1, "producto_id": 2, "cantidad": 1, "fecha": "02/02/2022"}
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
            "producto_id" => "required|numeric",
            "cantidad" => "required|numeric"
        ]);
        $input = $request->all();

        $productoIgual = Carrito::where([['cliente_id', $request->input("cliente_id")], ['producto_id', $request->input('producto_id')]])->first();

        if (empty($productoIgual)){
            $carrito = Carrito::create($input);
            if ($carrito->id > 0){
                return response()->json(["code"=>201, "msg"=>"Registro Guardado"]); //Created
            }else{
                return response()->json(["code"=>409, "msg"=>"Datos de registro en conflicto"]); //Conflict
            }
        }else{
            $productoIgual->cantidad +=1;
            $productoIgual->update();
            return response()->json(["code"=>201, "msg"=>"Registro Guardado"]); //Created
        }
    }

    /**
     * @OA\Delete(
     *     path="/carrito/{id}",
     *     description="Elimina un producto de Carrito del Cliente",
     *     operationId="delete",
     *     tags={"Carrito"},
     *     @OA\Parameter(
     *         description="Id de carrito a eliminar",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             format="int64",
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Carrito Eliminado"
     *     ),
     *     @OA\Response(
     *         response="406",
     *         description="Id no aceptado"
     *     )
     * )
     */
    public function delete($id){
        $carritoBuscado = Carrito::find($id);
        if ($carritoBuscado != null){
            $carritoBuscado->delete();
            return response()->json(["code"=>200, "msg"=>"Registro Eliminado"]); //Ok
        }else{
            return response()->json(["code"=>406, "msg"=>"Id no aceptado"]); //Not Acceptable
        }
    }
}
