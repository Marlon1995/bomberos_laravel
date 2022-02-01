<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleRequerimiento extends Model
{
    protected $table = 'det_requerimientos';
    protected $fillable = [
        'client_id', 'requerimiento_id', 'respuesta', 'cantidad','observacion','estado'
    ];
}

