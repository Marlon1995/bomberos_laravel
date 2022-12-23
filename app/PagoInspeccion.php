<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoInspeccion extends Model
{
    protected $table = 'pago_inspeccion';
    protected $fillable = [
        'id', 'client_id', 'valor'
    ];
}
