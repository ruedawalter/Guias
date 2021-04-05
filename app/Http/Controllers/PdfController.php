<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Guia;
use App\Servicio;
use App\User;
use App\Fpago;
use App\Estado;
use App\Distrito;
use App\Cliente;
use DB;
use Illuminate\Support\Facades\Auth;


class PdfController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	// public function __construct()
 //    {
 //        $this->middleware('auth');
 //    }

	public function PDFGuias(Request $request){

		$inicio =$request->fechain;
		$fin =$request->fechafin;
		 $guias = DB::select('SELECT  g.id,g.guia,g.fecha,g.id_servicio,g.id_cliente,g.id_remitente,g.id_fpago,g.monto,g.smonto, (g.monto + g.smonto) as totald,g.hdesde,g.hhasta,g.id_agente,g.obsguia,g.id_estado,g.fentrega,g.obsentrega,g.updated_at,c.nombre as cliente, c.cel as celc,c.telefono as telefonoc,c.distrito_id,c.direccion as direccionc,u.name as remitente,u.direccion as direccionu,u.telefono as telefonou,u.cel as celu,u.distrito_id,c.distrito_id,d.distrito,du.distrito as distritou,s.nombre as snombre, fp.nombre as fpago,est.nombre as estado, ua.name as agente  FROM guias g   JOIN users u on g.id_remitente = u.id JOIN users ua on g.id_agente = ua.id  JOIN clientes c on g.id_cliente = c.id JOIN distritos d on c.distrito_id = d.id JOIN distritos du on u.distrito_id = du.id JOIN servicios s on s.id = g.id_servicio JOIN fpagos fp on fp.id = g.id_fpago JOIN estados  est on est.id = g.id_estado where g.fecha =?', [$inicio]);
		 if (count($guias)>0){
		 	$pdf = PDF::loadview('pdf.admgg', compact('guias'));
			return $pdf->setPaper('A4', 'landscape')->download(date('YmdHi').'reporteguias.pdf');
		}else{
		 	$message='Sin datos para el reporte';
		 	return redirect('admguias')->with('message', $message);
		 }
	}

	public function PDFGuiasR(Request $request){

		$inicio =$request->fechain;
		$id_remitente =$request->id_remitenter;
		 $guias = DB::select('SELECT  g.id,g.guia,g.fecha,g.id_servicio,g.id_cliente,g.id_remitente,g.id_fpago,g.monto,g.smonto, (g.monto + g.smonto) as totald,g.hdesde,g.hhasta,g.id_agente,g.obsguia,g.id_estado,g.fentrega,g.obsentrega,g.updated_at,c.nombre as cliente, c.cel as celc,c.telefono as telefonoc,c.distrito_id,c.direccion as direccionc,u.name as remitente,u.direccion as direccionu,u.telefono as telefonou,u.cel as celu,u.distrito_id,c.distrito_id,d.distrito,du.distrito as distritou,s.nombre as snombre, fp.nombre as fpago,est.nombre as estado, ua.name as agente  FROM guias g   JOIN users u on g.id_remitente = u.id JOIN users ua on g.id_agente = ua.id  JOIN clientes c on g.id_cliente = c.id JOIN distritos d on c.distrito_id = d.id JOIN distritos du on u.distrito_id = du.id JOIN servicios s on s.id = g.id_servicio JOIN fpagos fp on fp.id = g.id_fpago JOIN estados  est on est.id = g.id_estado where  g.fecha = ? and g.id_remitente =?',[$inicio, $id_remitente]);


		 if (count($guias)>0){
			$pdf = PDF::loadview('pdf.remrg', compact('guias'));
			return $pdf->setPaper('A4', 'landscape')->download(date('YmdHi').'reporteguiasRemitente.pdf');
		}else{
		 	$message='Sin datos para el reporte';
		 	return redirect('admguias')->with('message', $message);
		 }

	}

	public function PDFGuiasA(Request $request){

		$inicio =$request->fechain;
		$id_agente =$request->id_agentea;
		 $guias = DB::select('SELECT  g.id,g.guia,g.fecha,g.id_servicio,g.id_cliente,g.id_remitente,g.id_fpago,g.monto,g.smonto, (g.monto + g.smonto) as totald,g.hdesde,g.hhasta,g.id_agente,g.obsguia,g.id_estado,g.fentrega,g.obsentrega,g.updated_at,c.nombre as cliente, c.cel as celc,c.telefono as telefonoc,c.distrito_id,c.direccion as direccionc,u.name as remitente,u.direccion as direccionu,u.telefono as telefonou,u.cel as celu,u.distrito_id,c.distrito_id,d.distrito,du.distrito as distritou,s.nombre as snombre, fp.nombre as fpago,est.nombre as estado, ua.name as agente  FROM guias g   JOIN users u on g.id_remitente = u.id JOIN users ua on g.id_agente = ua.id  JOIN clientes c on g.id_cliente = c.id JOIN distritos d on c.distrito_id = d.id JOIN distritos du on u.distrito_id = du.id JOIN servicios s on s.id = g.id_servicio JOIN fpagos fp on fp.id = g.id_fpago JOIN estados  est on est.id = g.id_estado where  g.fecha = ? and g.id_agente =?',[$inicio, $id_agente]);

		 if (count($guias)>0){
		 	$pdf = PDF::loadview('pdf.agrg', compact('guias'));
			return $pdf->setPaper('A4', 'landscape')->download(date('YmdHi').'reporteguiasAgente.pdf');
		 }else{
		 	$message='Sin datos para el reporte';
		 	return redirect('admguias')->with('message', $message);
		 }
		 }

		 public function PDFGuiasRem(Request $request){

		$inicio =$request->fechain;
		$id_remitente =Auth::user()->id;
		 $guias = DB::select('SELECT  g.id,g.guia,g.fecha,g.id_servicio,g.id_cliente,g.id_remitente,g.id_fpago,g.monto,g.smonto, (g.monto + g.smonto) as totald,g.hdesde,g.hhasta,g.id_agente,g.obsguia,g.id_estado,g.fentrega,g.obsentrega,g.updated_at,c.nombre as cliente, c.cel as celc,c.telefono as telefonoc,c.distrito_id,c.direccion as direccionc,u.name as remitente,u.direccion as direccionu,u.telefono as telefonou,u.cel as celu,u.distrito_id,c.distrito_id,d.distrito,du.distrito as distritou,s.nombre as snombre, fp.nombre as fpago,est.nombre as estado, ua.name as agente  FROM guias g   JOIN users u on g.id_remitente = u.id JOIN users ua on g.id_agente = ua.id  JOIN clientes c on g.id_cliente = c.id JOIN distritos d on c.distrito_id = d.id JOIN distritos du on u.distrito_id = du.id JOIN servicios s on s.id = g.id_servicio JOIN fpagos fp on fp.id = g.id_fpago JOIN estados  est on est.id = g.id_estado where  g.fecha = ? and g.id_remitente =?',[$inicio, $id_remitente]);


		 if (count($guias)>0){
			$pdf = PDF::loadview('pdf.rgrem', compact('guias'));
			return $pdf->setPaper('A4', 'landscape')->download(date('YmdHi').'reporteguiasRemitente.pdf');
		}else{
		 	$message='Sin datos para el reporte';
		 	return redirect('remguias')->with('message', $message);
		 }

	}

	public function PDFGuiasAg(Request $request){

		$inicio =$request->fechain;
		$id_agente = Auth::user()->id;
		 $guias = DB::select('SELECT  g.id,g.guia,g.fecha,g.id_servicio,g.id_cliente,g.id_remitente,g.id_fpago,g.monto,g.smonto, (g.monto + g.smonto) as totald,g.hdesde,g.hhasta,g.id_agente,g.obsguia,g.id_estado,g.fentrega,g.obsentrega,g.updated_at,c.nombre as cliente, c.cel as celc,c.telefono as telefonoc,c.distrito_id,c.direccion as direccionc,u.name as remitente,u.direccion as direccionu,u.telefono as telefonou,u.cel as celu,u.distrito_id,c.distrito_id,d.distrito,du.distrito as distritou,s.nombre as snombre, fp.nombre as fpago,est.nombre as estado, ua.name as agente  FROM guias g   JOIN users u on g.id_remitente = u.id JOIN users ua on g.id_agente = ua.id  JOIN clientes c on g.id_cliente = c.id JOIN distritos d on c.distrito_id = d.id JOIN distritos du on u.distrito_id = du.id JOIN servicios s on s.id = g.id_servicio JOIN fpagos fp on fp.id = g.id_fpago JOIN estados  est on est.id = g.id_estado where  g.fecha = ? and g.id_agente =?',[$inicio, $id_agente]);

		 if (count($guias)>0){
		 	$pdf = PDF::loadview('pdf.rgagente', compact('guias'));
			return $pdf->setPaper('A4', 'landscape')->download(date('YmdHi').'reporteguiasAgente.pdf');
		 }else{
		 	$message='Sin datos para el reporte';
		 	return redirect('aguias')->with('message', $message);
		 }
		 }

}
