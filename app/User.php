<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Rol;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id_rol','cel','telefono','direccion','distrito_id'
    ];
    public function distritos_pk()
    {
        return $this->belongsTo(Distrito::class,'distrito_id')->orderBy('distrito');
    }
    public function scopeAdministrador($query){
        return $query->where('id_rol','=',3);
    }
    public function scopeRemitente($query){
        return $query->where('id_rol','=',2);
    }
    public function scopeAgente($query){
        return $query->where('id_rol','=',1);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
