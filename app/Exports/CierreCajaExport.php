<?php

namespace App\Exports;

use App\Especies;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CierreCajaExport implements FromView
{

    public function view():View
    {
        $reporte = DB::table('otros_pagos')
        ->join('client', 'client.id', 'otros_pagos.client_id')
        ->join('tipos_pago', function ($join) {
            $join->on('tipos_pago.id', 'otros_pagos.tipoPago')
                ->where('tipos_pago.nombre', '<>', 'PAGO TOTAL');
        })
        ->leftJoin('formaspago', 'formaspago.id', 'otros_pagos.formaPago_id')
        ->select(   'ruc',
            'razonSocial',
            'formaspago.nombre as formaspago',
            'tipos_pago.nombre as tipos_pago',
         
            'valor',
            'year_now',
            'numPermisoFuncionamiento',
            'numTransaccion',
            'otros_pagos.created_at')
            ->whereNotIn ('tipos_pago.id', [2]) 
       ->where('otros_pagos.estado','=', 8)
       ->where('otros_pagos.created_at','like', date("Y-m-d").'%' )
       ->orderBy('otros_pagos.created_at', 'desc')
       ->get();
    
            //return $cobros;
         $cero = 0;
        foreach( $reporte as $item ){
            $arrayDATA[] = [ 
            'fechaYHora'         => $item->created_at,
            'anio'               => $item->year_now,
            'numEspecie'         => $item->numPermisoFuncionamiento,
            'ruc'                => $item->ruc,
            'razonSocial'        => strtoupper($item->razonSocial),
            'formaPago'          => strtoupper($item->formaspago),
            'numTransaccion'     => $item->numTransaccion,
            'valorPermiso'       => $item->valor-2,
            'valorEspecie'       => 2,

            'descuento'      =>  $cero,
            
            '2018'               => $cero,
            '2019'               => $cero,
            'I'                  => $cero,
            'II'                 => $cero,
            'III'                => $cero,
            'IV'                 => $cero,
            'total'              => $item->valor,
            'bandera'            => 'pagos totates'
            ];
        }
    
        $cobros= DB::table('otros_cobros')
        ->leftJoin('formaspago','formaspago.id','otros_cobros.formaPago_id')
        ->select('ruc',
            'razonSocial',
            'formaspago.nombre as formaspago',
            'valor',
            'year_now',
            'numTransaccion',
            'porcenjatetasa',
            'otros_cobros.created_at')
        ->where('otros_cobros.created_at','like', date("Y-m-d").'%' )
        ->where('otros_cobros.estado','=',8)
        ->get();
    
        foreach( $cobros as $item ){
            $arrayDATA[] = [ 
            'fechaYHora'         => $item->created_at,
            'anio'               => $item->year_now,
            'numEspecie'         => '',
            'ruc'                => $item->ruc,
            'razonSocial'        => strtoupper($item->razonSocial),
            'formaPago'          => strtoupper($item->formaspago),
            'numTransaccion'     => $item->numTransaccion,
            'valorPermiso'       => $item->valor,
            'valorEspecie'       => 2,
            'descuento'      => $cero,
           
            '2018'               => ($item->year_now==='2018')?$item->porcenjatetasa."%":$cero,
            '2019'               => ($item->year_now==='2019')?$item->porcenjatetasa."%":$cero,
            'I'                  => $cero,
            'II'                 => $cero,
            'III'                => $cero,
            'IV'                 => $cero,
            'total'              => ($item->valor+($item->valor*($item->porcenjatetasa/100))),
            'bandera'            => 'otros cobros'
    
            ];
        }
    
    
    
        $especie = Especies::where('estado','=','1')
        ->where('created_at','like', date("Y-m-d").'%' )
        ->get();
        foreach( $especie as $item ){        
            $arrayDATA[] = [ 
            'fechaYHora'         => $item->created_at,
            'anio'               => date("Y", strtotime($item->created_at)),
            'numEspecie'         => $item->especie,
            'ruc'                => $item->ruc,
            'razonSocial'        => strtoupper($item->razonSocial),
            'formaPago'          => 'EFECTIVO',
            'numTransaccion'     => '',
            'valorPermiso'       => $cero,
            'valorEspecie'       => ($item->valor * $item->cantidad),
            'descuento'      => $cero,
            '2018'               => $cero,
            '2019'               => $cero,
            'I'                  => $cero,
            'II'                 => $cero,
            'III'                => $cero,
            'IV'                 => $cero,
            'total'              => ($item->valor * $item->cantidad),
            'bandera'            => 'especies'
    
            ];
        }  
 
      
        return view('report/cierreCajaExcel', ['reporte' => $reporte ]);

      
    }
}
