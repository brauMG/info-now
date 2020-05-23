<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    //
    protected $fillable = ['Clave_Compania','Clave_Proyecto','Descripcion','Decision','FechaCreacion','Estado', 'Clave_Usuario', 'Fecha_Vencimiento', 'Hora_Vencimiento', 'Clave_Etapa', 'Clave_Fase'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'Actividades';
    public $timestamps = false;
}
