<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especies extends Model
{
    protected $table    = 'especies';

    protected $fillable = [
        'cantidad','razonSocial', 'representanteLegal', 'ruc','direccion','telefono','especie','valor','estado'
    ];



}
