<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfoque extends Model
{
    //
    protected $fillable = ['Clave_Enfoque','Descripcion','FechaCreacion','Activo'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'Enfoques';
    public $timestamps = false;
}
