<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    //
    protected $fillable = ['Descripcion','Orden','FechaCreacion','Activo'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'Fases';
    public $timestamps = false;
}
