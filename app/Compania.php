<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compania extends Model
{
    //
    protected $fillable = ['Descripcion','FechaCreacion','Activo','Dominio'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'Companias';
    public $timestamps = false;    
}
