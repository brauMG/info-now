<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
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
        'email',
        'Clave_Area',
        'Clave_Puesto',
        'Clave_Rol',
        'password',
        'UltimoLogin',
        'FechaCreacion',
        'Activo',
        'envio_de_correo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guarded = ['Clave'];
    protected $table = 'Usuarios';
    protected $primaryKey = 'Clave';
    public $timestamps = false;
    public function getAuthPassword()
    {
        return $this->password;
    }
}
