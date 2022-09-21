<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(){
        return Cliente::all();
    }

    public function store(Request $request){
        $input = $request->all();
        $cliente = Cliente::create($input);
        if ($cliente->id > 0){
            return response()->json(["msg"=>201]); //Created
        }else{
            return response()->json(["msg"=>409]); //Conflict
        }
    }
}
