<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Distrito;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class ClienteController extends Controller
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
        $prueba = Cliente::with('distritos_pk')->get();
        if ($request->ajax()) {
        // $data = Cliente::latest()->get();
        $data = Cliente::with('distritos_pk')->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editcliente"><i class="fas fa-pencil-square-o"></i></a>';
          // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletecliente"><i class="fas fa-trash"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        }
        return view('clientes/index',compact('distritos','prueba'));
    }

    public function show($id)
    {
        $datacliente = Cliente::findOrFail($id);
        return $datacliente;

    }

        /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    Cliente::updateOrCreate(['id' => $request->cliente_id],
    ['nombre' => $request->nombre,'cel' => $request->cel,'telefono' => $request->telefono,'direccion' => $request->direccion,'distrito_id' => $request->distrito_id]);
    return response()->json(['success'=>'cliente guardado satisfactoriamente.']);
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\cliente  $cliente
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
    $cliente = cliente::find($id);
    return response()->json($cliente);
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\cliente  $cliente
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    Cliente::find($id)->delete();
    return response()->json(['success'=>'cliente eliminado satisfactoriamente.']);
    }
    }
