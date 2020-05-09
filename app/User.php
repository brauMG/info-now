<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Clave_Compania',
        'Iniciales',
        'Nombres',
        'Correo',
        'Clave_Area',
        'Clave_Puesto',
        'Clave_Rol',
        'Contrasena',
        'UltimoLogin',
        'FechaCreacion',
        'Activo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Contrasena'
    ];
    protected $guarded = ['Clave'];
    protected $table = 'Usuarios';
    protected $primaryKey = 'Clave';
    public $timestamps = false;
    public function getAuthPassword()
    {
        return $this->Contrasena;
    }
}
