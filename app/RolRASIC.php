<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolRASIC extends Model
{
    //
    protected $fillable = ['RolRASIC','FechaCreacion','Activo'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'RolesRASIC';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;
}
