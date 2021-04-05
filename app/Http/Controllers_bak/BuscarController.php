<?php

namespace App\Http\Controllers;

use App\User;
use App\Cliente;
use Illuminate\Http\Request;

class BuscarController extends Controller
{
    public function bCliente($id){
    	$datos = Cliente::find($id);
        return response()->json($datos);
    }
    public function bRemitente($id){
    	$datos = User::find($id);
        return response()->json($datos);
    }
}
