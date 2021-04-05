<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public function usuarios_pk(){
	return $this->belongsTo(Usuario::class);
}
}