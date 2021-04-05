<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
	public function distritos_pk()
    {
        return $this->belongsTo(Distrito::class,'distrito_id')->orderBy('distrito');
    }
    public function roles_pk()
    {
        return $this->belongsTo(Rol::class,'id_rol')->orderBy('rols');
    }
    public $table = "users";
     protected $guarded=[];
}
