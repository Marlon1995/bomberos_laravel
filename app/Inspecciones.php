<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspecciones extends Model
{
    protected $table = 'inspecciones';
    protected $fillable = [
        'client_id', 'requerimiento_id', 'respuesta', 'tipo' , 'estado'
    ];
}
