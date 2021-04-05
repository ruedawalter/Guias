<?php

namespace App\Http\Controllers;

use App\Fpago;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class FpagoController extends Controller
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
    $data = Fpago::latest()->get();
    return Datatables::of($data)
    ->addIndexColumn()
    ->addColumn('action', function($row){
       $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-secondary btn-sm editfpago"><i class="fas fa-eye"></i></a>';
       // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletefpago"><i class="fas fa-trash"></i></a>';
        return $btn;
    })
    ->rawColumns(['action'])
    ->make(true);
    }
    return view('fpagos/index');
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    Fpago::updateOrCreate(['id' => $request->fpago_id],
    ['nombre' => $request->nombre]);
    return response()->json(['success'=>'fpago guardado satisfactoriamente.']);
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\fpago  $fpago
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
    $fpago = Fpago::find($id);
    return response()->json($fpago);
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\fpago  $fpago
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    Fpago::find($id)->delete();
    return response()->json(['success'=>'fpago eliminado satisfactoriamente.']);
    }
    }