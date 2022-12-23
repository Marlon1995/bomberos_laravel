<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspecciones_sec extends Model
{
    protected $table = 'inspecciones_sec';
    protected $fillable = [
        'client_id', 'valor_bci', 'observacion', 'riesgo'
    ];
}
