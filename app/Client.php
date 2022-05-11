<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table ='client';
    protected $fillable = [
        'tipoFormulario','razonSocial','ruc','representanteLegal','parroquia_id','barrio_id','telefono','referencia','actividad_id', 'categoria_id', 'tipoNegocio_id','estado',
        'inspector_id', 'descripcion'
    ];

    protected $casts=[
        'ruc'=> 'string'

    ];

    public function actiidad(){
        return $this->belongsTo(Actividades::class);
    }
    public function categorias(){
        return $this->belongsTo(Categorias::class);
    }


}
