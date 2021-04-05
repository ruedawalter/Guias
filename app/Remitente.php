<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remitente extends Model
{
    //
    public $fillable = ['nombre','cel','email','telefono', 'direccion', 'distrito_id'];
    public function distritos_pk()
    {
        return $this->belongsTo(Distrito::class,'distrito_id')->orderBy('distrito');
    }
}
