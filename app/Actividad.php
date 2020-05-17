<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    //
    protected $fillable = ['Clave_Compania','Clave_Proyecto','Descripcion','FechaAccion','Decision','Clave_Historial','FechaCreacion','Activo', 'Clave_Usuario', 'Orden'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'Actividades';
    public $timestamps = false;
}
