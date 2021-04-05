<?php

namespace App\Http\Controllers;


use App\Proveedor;
use App\Distrito;

use App\Http\Requests\SaveProveedorRequest;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     // * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
        {
             return view('proveedores.index', [
            'proveedores'=>Proveedor::orderby('nombre','Asc')->paginate()
            ]);
           
        }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cbd='---Seleccione Distrito---';
        $cbid="";
        $distritos = Distrito::all();
        return view('proveedores.create', [
                'proveedor' => new Proveedor,
                'distritos'=> $distritos,
                'cbid' => $cbid,
                'cbd' => $cbd
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

   

    public function store(SaveProveedorRequest $request)
    {   
        Proveedor::create($request->validated());

        return redirect()->route('proveedores.index')->with('status', 'El proveedor ha sido guardado');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $distritos = Distrito::all();
        $temp = Proveedor::Findorfail($id);
        $id_distrito = ($temp->distrito_id);
        $dist = Distrito::Findorfail($id_distrito);
        return view('proveedores.show', [
           'proveedor' => Proveedor::Findorfail($id),
           'distritos'=> $distritos,
           'dist'=> $dist
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {

        $distritos = Distrito::all();
        $cb = Distrito::Findorfail($proveedor->distrito_id);
        $cbid = ($cb->id);
         $cbd = ($cb->distrito);

        return view('proveedores.edit', [
          'proveedor' => $proveedor,
          'distritos'=> $distritos,
          'cbid' => $cbid,
          'cbd' => $cbd
        ]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Proveedor $proveedor, SaveProveedorRequest $request)
    {
        $proveedor->update($request->validated());

        return redirect()->route('proveedores.show', $proveedor)->with('status', 'El proveedor ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor -> delete();
        return redirect()->route('proveedores.index')->with('status', 'El proveedor fue eliminado');
    }

    
}

