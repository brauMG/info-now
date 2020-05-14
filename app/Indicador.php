<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    //
    protected $fillable = ['Descripcion','FechaCreacion','Activo','Clave_Compania'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'Indicador';
    public $timestamps = false;
}
