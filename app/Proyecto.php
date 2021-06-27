<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    //
    protected $fillable = ['Clave_Compania','Descripcion','Criterio','Clave_Status','Clave_Area','Clave_Fase','Clave_Enfoque','Clave_Trabajo','Clave_Indicador','Objectivo','FechaCreacion','Activo'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'Proyectos';
    public $timestamps = false;
}
