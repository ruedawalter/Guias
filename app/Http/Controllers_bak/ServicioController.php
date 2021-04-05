<?php

namespace App\Http\Controllers;

use App\Servicio;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class ServicioController extends Controller
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
    $data = Servicio::latest()->get();
    return Datatables::of($data)
    ->addIndexColumn()
    ->addColumn('action', function($row){
       $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editservicio"><i class="fas fa-pencil-square-o"></i></a>';
       //$btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteservicio"><i class="fas fa-trash"></i></a>';
        return $btn;
    })
    ->rawColumns(['action'])
    ->make(true);
    }
    return view('servicios/index');
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    Servicio::updateOrCreate(['id' => $request->servicio_id],
    ['nombre' => $request->nombre]);
    return response()->json(['success'=>'servicio guardado satisfactoriamente.']);
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\servicio  $servicio
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
    $servicio = Servicio::find($id);
    return response()->json($servicio);
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\servicio  $servicio
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    Servicio::find($id)->delete();
    return response()->json(['success'=>'servicio eliminado satisfactoriamente.']);
    }
    }