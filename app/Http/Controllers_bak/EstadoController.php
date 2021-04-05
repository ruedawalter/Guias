<?php

namespace App\Http\Controllers;

use App\Estado;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class EstadoController extends Controller
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
    $data = Estado::latest()->get();
    return Datatables::of($data)
    ->addIndexColumn()
    ->addColumn('action', function($row){
       $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editestado"><i class="fas fa-pencil-square-o"></i></a>';
       //$btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteestado"><i class="fas fa-trash"></i></a>';
        return $btn;
    })
    ->rawColumns(['action'])
    ->make(true);
    }
    return view('estados/index');
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    Estado::updateOrCreate(['id' => $request->estado_id],
    ['nombre' => $request->nombre]);
    return response()->json(['success'=>'estado guardado satisfactoriamente.']);
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\estado  $estado
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
    $estado = Estado::find($id);
    return response()->json($estado);
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\estado  $estado
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    Estado::find($id)->delete();
    return response()->json(['success'=>'estado eliminado satisfactoriamente.']);
    }
    }