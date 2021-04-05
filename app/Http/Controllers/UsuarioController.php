<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaveUsuarioRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Usuario;
use App\Distrito;
use App\Rol;

class UsuarioController extends Controller
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
        // $prueba = Usuario::with('distritos_pk')->get();
        $roles=Rol::orderBy('rols','ASC')->get();
        if ($request->ajax()) {
        // $data = usuario::latest()->get();
        $data = Usuario::with('distritos_pk','roles_pk')->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editusuario"><i class="fas fa-pencil-square-o"></i></a>';
           // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteusuario"><i class="fas fa-trash"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        }
        return view('usuarios/index',compact('distritos','roles'));
    }

        /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    Usuario::updateOrCreate(['id' => $request->usuario_id],
    ['cel' => $request->cel,'telefono' => $request->telefono,'direccion' => $request->direccion,'distrito_id' => $request->distrito_id]);
    return response()->json(['success'=>'usuario guardado satisfactoriamente.']);
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\usuario  $usuario
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
    $usuario = Usuario::find($id);
    return response()->json($usuario);
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\usuario  $usuario
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    usuario::find($id)->delete();
    return response()->json(['success'=>'usuario eliminado satisfactoriamente.']);
    }
    }

