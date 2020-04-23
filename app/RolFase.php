<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolFase extends Model
{
    protected $fillable = ['Clave_Compania','Descripcion','FechaCreacion','Activo'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'RolesFase';
    public $timestamps = false;
}
