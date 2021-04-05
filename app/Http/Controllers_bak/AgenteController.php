<?php

namespace App\Http\Controllers;
use App\Agente;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class AgenteController extends Controller
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

        if ($request->ajax()) {
        $data = Agente::latest()->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editagente"><i class="fas fa-pencil-square-o"></i></a>';
           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteagente"><i class="fas fa-trash"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        }
        return view('agentes/index',compact('agentes'));
    }

        /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    Agente::updateOrCreate(['id' => $request->agente_id],
    ['nombres' => $request->nombres,'cel' => $request->cel,'email' => $request->email]);
    return response()->json(['success'=>'agente guardado satisfactoriamente.']);
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\agente  $agente
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
    $agente = Agente::find($id);
    return response()->json($agente);
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\agente  $agente
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    Agente::find($id)->delete();
    return response()->json(['success'=>'agente eliminado satisfactoriamente.']);
    }
    }
