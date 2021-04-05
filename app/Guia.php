<?php

namespace App;
use App\Estado;
use App\Fpago;
use App\User;
use App\Cliente;
use App\Servicio;

use Illuminate\Database\Eloquent\Model;

class Guia extends Model
{
	public $fillable = ['guia','fecha','id_servicio','id_cliente','id_remitente', 'id_fpago', 'monto','smonto','hdesde','hhasta','obsguia','id_agente','id_estado','fentrega','obsentrega'];
    public function servicios_pk()
    {
        return $this->belongsTo(Servicio::class,'id_servicio')->orderBy('nombre');
    }
    public function clientes_pk()
    {
        return $this->belongsTo(Cliente::class,'id_cliente')->orderBy('nombre');
    }
    public function agentes_pk()
    {
        return $this->belongsTo(User::class,'id_agente')->orderBy('name');
    }
    public function remitentes_pk()
    {
        return $this->belongsTo(User::class,'id_remitente')->orderBy('name');
    }
    public function fpagos_pk()
    {
        return $this->belongsTo(Fpago::class,'id_fpago')->orderBy('nombre');
    }
    public function estados_pk()
    {
        return $this->belongsTo(Estado::class,'id_estado')->orderBy('nombre');
    }
}
