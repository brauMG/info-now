<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
   protected $fillable = ['Descripcion','FechaCreacion','Activo'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'Trabajos';
    public $timestamps = false; 
}
