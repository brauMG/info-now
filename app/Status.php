<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $fillable = ['Status','FechaCreacion','Activo','Clave_Compania'];
    protected $guarded = ['Clave'];
    protected $table = 'Status';
    protected $primaryKey = 'Clave';
    public $timestamps = false;
}
