<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $table = 'system';
    protected $fillable = ['nombre','icono','logo','terminos','condiciones'];
//quito comentario
}
