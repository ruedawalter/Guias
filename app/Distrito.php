<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use App\Remitente;
class Distrito extends Model
{
public function clientes_pk()
    {
        return $this->belongsTo(Cliente::class);
    }
public function remitentes_pk(){
	return $this->belongsTo(Remitente::class);
}
public function usuarios_pk(){
	return $this->belongsTo(Usuario::class);
}
public function scopeDistrito($query){
        return $query->where('id','=',$distrito_id);
    }

    public $fillable = ['distrito'];
};

