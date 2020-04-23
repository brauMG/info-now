<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    //
    protected $fillable = ['Clave_Compania','Puesto','FechaCreacion','Activo'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'Puestos';
    public $timestamps = false;
}
