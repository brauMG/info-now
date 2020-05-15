<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $fillable = ['Rol','FechaCreacion','Activo'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'Roles';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
