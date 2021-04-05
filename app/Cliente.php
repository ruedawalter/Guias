<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Cliente extends Model
{

    //
    public $fillable = ['nombre','cel','telefono', 'direccion', 'distrito_id'];
    public function distritos_pk()
    {
        return $this->belongsTo(Distrito::class,'distrito_id')->orderBy('distrito');
    }
    public function scopeBdistrito($query, $id)
{
    if ($id != '') {
        $query->where('clientes.id', '=',  $id )->join('distritos', 'clientes.distrito_id', '=', 'clientes.id');
    }
    return $query;
}
}
