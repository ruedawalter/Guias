<?php

namespace App\Http\Controllers;

use App\Banco;
use Response;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BancoController extends Controller
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
    $data = Banco::latest()->get();
    return Datatables::of($data)
    ->addIndexColumn()
    ->addColumn('action', function($row){
       $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editbanco"><i class="fas fa-pencil-square-o"></i></a>';
       $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletebanco"><i class="fas fa-trash"></i></a>';
        return $btn;
    })
    ->rawColumns(['action'])
    ->make(true);
    }
    return view('bancos/index',compact('bancos'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    Banco::updateOrCreate(['id' => $request->banco_id],
    ['nombre' => $request->nombre]);
    return response()->json(['success'=>'banco guardado satisfactoriamente.']);
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\banco  $banco
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
    $banco = Banco::find($id);
    return response()->json($banco);
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\banco  $banco
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    Banco::find($id)->delete();
    return response()->json(['success'=>'banco eliminado satisfactoriamente.']);
    }
    }