<?php
namespace App\Http\Controllers;
use App\Remitente;
use App\Distrito;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class RemitenteController extends Controller
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
        $prueba = Remitente::with('distritos_pk')->get();
        if ($request->ajax()) {
        // $data = remitente::latest()->get();
        $data = Remitente::with('distritos_pk')->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editremitente"><i class="fas fa-pencil-square-o"></i></a>';
           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteremitente"><i class="fas fa-trash"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        }
        return view('remitentes/index',compact('distritos','prueba'));
    }

        /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    Remitente::updateOrCreate(['id' => $request->remitente_id],
    ['nombre' => $request->nombre,'cel' => $request->cel,'email' => $request->email,'telefono' => $request->telefono,'direccion' => $request->direccion,'distrito_id' => $request->distrito_id]);
    return response()->json(['success'=>'remitente guardado satisfactoriamente.']);
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\remitente  $remitente
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
    $remitente = Remitente::find($id);
    return response()->json($remitente);
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\remitente  $remitente
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    Remitente::find($id)->delete();
    return response()->json(['success'=>'remitente eliminado satisfactoriamente.']);
    }
    }

