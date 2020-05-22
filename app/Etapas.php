<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Etapas extends Model
{
    protected $fillable = ['Clave_Proyecto','Clave_Fase','Descripcion','Fecha_Vencimiento','Hora_Vencimiento', 'Clave_Compania'];
    protected $guarded = ['Clave'];
    protected $primaryKey = 'Clave';
    protected $table = 'Etapas';
    public $timestamps = true;
}
