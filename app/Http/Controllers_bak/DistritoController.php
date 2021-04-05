<?php

namespace App\Http\Controllers;
use App\Distrito;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;


class DistritoController extends Controller
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
        $data = Distrito::latest()->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editdistrito"><i class="fas fa-pencil-square-o"></i></a>';
           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletedistrito"><i class="fas fa-trash"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        }
        return view('distritos/index',compact('distritos'));
    }

        /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    Distrito::updateOrCreate(['id' => $request->distrito_id],
    ['id' => $request->id,'distrito' => $request->distrito]);
    return response()->json(['success'=>'distrito guardado satisfactoriamente.']);
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\distrito  $distrito
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
    $distrito = Distrito::find($id);
    return response()->json($distrito);
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\distrito  $distrito
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    Distrito::find($id)->delete();
    return response()->json(['success'=>'distrito eliminado satisfactoriamente.']);
    }
    }
