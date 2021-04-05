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
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GuiagController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $distritos = Distrito::orderBy('distrito','ASC')->get();
        $servicios = Servicio::orderBy('nombre','ASC')->get();
        $clientes = Cliente::orderBy('nombre','ASC')->get();
        $remitentes=User::remitente()->orderBy('name')->get();
        $agentes=User::agente()->orderBy('name')->get();
        $fpagos = Fpago::orderBy('nombre','asc')->get();
        $estados = Estado::orderBy('nombre','asc')->get();
        $ultid = Guia::latest('id')->first();
        $ag= Auth::user()->id;

        if ($request->ajax()) {
        // $data = guia::latest()->get();
        $data = Guia::with('clientes_pk','remitentes_pk','estados_pk')
        ->where('id_agente','=',$ag)
        ->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editguia"><i class="fas fa-pencil-square-o"></i></a>';
           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-secondary btn-sm deleteguia"><i class="fas fa-eye"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        }

        return view('aguias/index',compact('distritos','servicios','agentes','clientes','remitentes','estados','fpagos','ultid'));
    }

        /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    Guia::updateOrCreate(['id' => $request->guia_id],
    ['id_estado' => $request->id_estado,'fentrega' => $request->fentrega,'obsentrega' => $request->obsentrega]);
    return response()->json(['success'=>'guia guardado satisfactoriamente.']);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\guia  $guia
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
            // $datos = User::find($id);
        $datos = DB::select('SELECT u.id,u.name,u.telefono,u.cel,u.direccion,u.distrito_id,d.id,d.distrito from users u JOIN distritos d on u.distrito_id = d.id
                 where u.id =' . $id);
            // $datos = Cliente::with('distritos_pk')->get();
            return response()->json($datos);

    }
    public function bRemitente($cod,$id)
    {
            // $datos = Cliente::find($id);
            // $datos = Cliente::with('distritos_pk')->get();
            // $datos=Cliente::Bdistrito($id)->get();
            $datos = DB::select('SELECT c.id,c.nombre,c.telefono,c.cel,c.direccion,c.distrito_id,d.id,d.distrito from clientes c JOIN distritos d on c.distrito_id = d.id
                 where c.id =' . $id);
            return response()->json($datos);
    }
       public function edit($id)
    {

         $guia = DB::select('SELECT g.id,g.guia,g.fecha,g.id_servicio,g.id_cliente,g.id_remitente,g.id_fpago,g.monto,g.smonto,g.hdesde,g.hhasta,g.id_agente,g.obsguia,g.id_estado,g.fentrega,g.obsentrega,g.updated_at,c.nombre as cliente, c.cel as celc,c.telefono as telefonoc,c.distrito_id,c.direccion as direccionc,u.name as remitente,u.direccion as direccionu,u.telefono as telefonou,u.cel as celu,u.distrito_id,c.distrito_id,d.distrito,du.distrito as distritou,s.nombre as snombre, fp.nombre as fpago,est.nombre as estado  FROM guias g JOIN users u on g.id_remitente = u.id JOIN clientes c on g.id_cliente = c.id JOIN distritos d on c.distrito_id = d.id JOIN distritos as du on u.distrito_id = du.id JOIN servicios s on s.id = g.id_servicio JOIN fpagos as fp on fp.id = g.id_fpago JOIN estados as est on est.id = g.id_estado where g.id =' . $id);
    // $guia = Guia::find($id);
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
    Guia::find($id)->delete();
    return response()->json(['success'=>'guia eliminado satisfactoriamente.']);
    }

    // public function buscarRem($cod)
    // {
    //         $datos = Remitente::findOrFail($cod);
    //         return response()->json($datos);
    // }


    }
