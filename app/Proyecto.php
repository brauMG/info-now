<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    //
    protected $fillable = ['Clave_Compania','Descripcion','Clave_Usuario','Clave_Area','Clave_Fase','Clave_Enfoque','Clave_Trabajo','Clave_Indicador','Objectivo'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'Proyectos';
    public $timestamps = false;
}
