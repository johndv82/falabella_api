<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;

class DireccionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/direccion_cliente/{id}",
     *     description="Retorna listado de direcciones que tiene registradas un Cliente",
     *     operationId="listar",
     *     tags={"Direcciones"},
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
     *         description="listado direcciones"
     *     ),
     *     @OA\Response(
     *         response="406",
     *         description="No hay coincidencias"
     *     )
     * )
     */

    public function listar($id){
        $direcciones = Direccion::where("cliente_id", $id)->get();
        if (count($direcciones) > 0){
            return $direcciones;
        }else{
            return response()->json(["msg"=>406]); //Not Acceptable
        }
    }

    /**
     * @OA\Get(
     *     path="/direcciones/{id}",
     *     description="Retorna los datos de una determinada Dirección",
     *     operationId="obtener",
     *     tags={"Direcciones"},
     *     @OA\Parameter(
     *         description="ID Dirección",
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
     *         description="datos de la dirección"
     *     ),
     *     @OA\Response(
     *         response="406",
     *         description="No hay coincidencias"
     *     )
     * )
     */

    public function obtener($id){
        $direccion = Direccion::find($id);
        if ($direccion->id > 0){
            return $direccion;
        }else{
            return response()->json(["msg"=>406]); //Not Acceptable
        }
    }

    /**
     * @OA\Post(
     *     path="/direcciones",
     *     operationId="store",
     *     description="Agrega una nueva dirección del Cliente",
     *     tags={"Direcciones"},
     *     @OA\RequestBody(
     *         description="Datos de Dirección",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                     property="descripcion",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="cliente_id",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="departamento",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="provincia",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="distrito",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="referencia",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="favorito",
     *                     type="integer"
     *                 ),
     *                 example={"descripcion": "direccion1", "cliente_id": 1, "departamento": "Lima", "provincia": "Lima", "distrito": "La Victoria", "referencia": "nn", "favorito": 0}
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
        $input = $request->all();
        $direccion = Direccion::create($input);
        if ($direccion->id > 0){
            return response()->json(["msg"=>201]); //Created
        }else{
            return response()->json(["msg"=>409]); //Conflict
        }
    }

    /**
     * @OA\Put(
     *     path="/direcciones/{id}",
     *     operationId="update",
     *     description="Actualiza una dirección del Cliente",
     *     tags={"Direcciones"},
     *     @OA\RequestBody(
     *         description="Datos de Dirección",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                     property="descripcion",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="cliente_id",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="departamento",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="provincia",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="distrito",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="referencia",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="favorito",
     *                     type="integer"
     *                 ),
     *                 example={"descripcion": "direccion1", "cliente_id": 1, "departamento": "Lima", "provincia": "Lima", "distrito": "La Victoria", "referencia": "nn", "favorito": 0}
     *             )
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="ID Direccion",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Registro Actualizado"
     *     ),
     *     @OA\Response(
     *         response="406",
     *         description="Id no aceptado"
     *     )
     * )
     */
    public function update(Request $request, $id){
        $input = $request->all();
        $direccion = Direccion::find($id);
        if ($direccion->id >0){
            $direccion->update($input);
            return $direccion;
        }else{
            return response()->json(["msg"=>406]); //Not Acceptable
        }
    }

    /**
     * @OA\Delete(
     *     path="/direcciones/{id}",
     *     description="Elimina una dirección del Cliente",
     *     operationId="delete",
     *     tags={"Direcciones"},
     *     @OA\Parameter(
     *         description="Id de direccion a eliminar",
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
     *         description="Direccion Eliminada"
     *     ),
     *     @OA\Response(
     *         response="406",
     *         description="Id no aceptado"
     *     )
     * )
     */
    public function delete($id){
        Direccion::destroy($id);
        return response()->json(["code"=>200, "msg"=>"Registro Eliminado"]); //Ok
    }
}
