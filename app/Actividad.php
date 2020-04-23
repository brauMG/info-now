<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    //
    protected $fillable = ['Clave_Compania','Clave_Proyecto','Clave_Fase','Descripcion','FechaAccion','Decision','Clave_Status','FechaCreacion','Activo'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'Actividades';
    public $timestamps = false;
}
