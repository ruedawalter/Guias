<?php

namespace App\Http\Controllers;

use App\Guia;
use App\Servicio;
use App\User;
use App\Fpago;
use App\Estado;
use App\Distrito;
use App\Cliente;
use DB;

use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class BusgController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(Request $request)
    {
    	return view('busg.index');
    }

        /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\guia  $guia
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {




    }

       public function edit($id)
    {
    	$guia = DB::select('SELECT g.id,g.guia,g.fecha,g.id_servicio,g.id_cliente,g.id_remitente,g.id_fpago,g.monto,g.smonto,g.hdesde,g.hhasta,g.id_agente,g.obsguia,g.id_estado,g.fentrega,g.obsentrega,g.updated_at,c.nombre as cliente, c.cel as celc,c.telefono as telefonoc,c.distrito_id,c.direccion as direccionc,u.name as remitente,u.direccion as direccionu,u.telefono as telefonou,u.cel as celu,u.distrito_id,c.distrito_id,d.distrito,du.distrito as distritou,s.nombre as snombre, fp.nombre as fpago,est.nombre as estado  FROM guias g JOIN users u on g.id_remitente = u.id  JOIN clientes c on g.id_cliente = c.id JOIN distritos d on c.distrito_id = d.id JOIN distritos du on u.distrito_id = du.id JOIN servicios s on s.id = g.id_servicio JOIN fpagos fp on fp.id = g.id_fpago JOIN estados  est on est.id = g.id_estado  where g.guia = ?', [$id]  );

    		return response()->json($guia);
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\guia  $guia
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {

    }

    // public function buscarRem($cod)
    // {
    //         $datos = Remitente::findOrFail($cod);
    //         return response()->json($datos);
    // }


    }
