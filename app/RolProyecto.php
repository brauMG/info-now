<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolProyecto extends Model
{
    //
    protected $fillable = ['Clave_Proyecto','Clave_Fase','Clave_Rol_RASIC','Clave_Usuario','Descripcion','FechaCreacion','Activo'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'RolesProyectos';
    public $timestamps = false;
}
