<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $fillable = ['Rol','FechaCreacion','Activo'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'Roles';
    public $timestamps = false;
    
    
}
