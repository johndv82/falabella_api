<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(){
        return Producto::all();
    }

    public function store(Request $request){
        $input = $request->all();
        $producto = Producto::create($input);
        if ($producto->id > 0){
            return response()->json(["msg"=>201]); //Created
        }else{
            return response()->json(["msg"=>409]); //Conflict
        }
    }
}
