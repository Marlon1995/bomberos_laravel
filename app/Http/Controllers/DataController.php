<?php

namespace App\Http\Controllers;

use App\Especies;
use App\Requerimientos;
use App\System;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;



class DataController extends Controller
{
    public function denomincacniones($id){
        $denominacion  = DB::table('denominaciones')
            ->select('denominaciones.id', 'denominaciones.descripcion')
            ->join('tasa_anual','tasa_anual.denominacion_id','denominaciones.id')
            ->where('denominaciones.estado', 2)
            ->where('tasa_anual.categoria_id','=',$id)
            ->groupBy('denominaciones.id', 'denominaciones.descripcion')
            ->orderBy('denominaciones.descripcion','ASC')
            ->get();
        return json_encode($denominacion);
    }
    public function verificaRuc($ruc){

        $cliente  = DB::table('client')
            ->select('ruc','razonSocial','representanteLegal','barrio', 'referencia', 'telefono', 'email')
            ->where('ruc','=',$ruc)
            ->get();
        $respues[] = array("ruc" => "El RUC ".$ruc." aun no se encuentra registrado..");
        $cliente = (empty($cliente[0]->ruc)) ? $respues : $cliente;

        return json_encode($cliente);
    }

    public function resumenInfoCliente($id){
        $cliente  =   DB::table('client')
    ->select('client.*', 'categorias.descripcion as nombre_categoria', 'denominaciones.descripcion as nombre_denominacion')
    ->join('categorias', 'client.categoria_id', '=', 'categorias.id')
    ->join('denominaciones', 'client.denominacion_id', '=', 'denominaciones.id')
    ->where('client.id', '=', $id)
    ->get();

        

        return json_encode($cliente);
    }

    public function resumenPago($id){

        $anticipos = DB::table('client')
            ->join('otros_pagos',  'otros_pagos.client_id' , 'client.id')
            ->select( DB::raw('sum(otros_pagos.valor) as anticipos' ))
            ->where('client.id','=',$id)
            ->where('otros_pagos.estado','=',8)
            ->where('otros_pagos.tipoPago','=',1)
            ->get();

        $descuentos = DB::table('client')
            ->join('otros_pagos',  'otros_pagos.client_id' , 'client.id')
            ->select( DB::raw('sum(otros_pagos.valor) as descuentos' ))
            ->where('client.id','=',$id)
            ->where('otros_pagos.estado','=',8)
            ->where('otros_pagos.tipoPago','=',2)
            ->get();

        $RecargoTrimestral = DB::table('client')
            ->join('otros_pagos',  'otros_pagos.client_id' , 'client.id')
            ->select( DB::raw('sum(otros_pagos.valor) as RecargoTrimestral' ))
            ->where('client.id','=',$id)
            ->where('otros_pagos.estado','=',7)
            ->where('otros_pagos.tipoPago','=',4)
            ->get();


        $TasaAnual = DB::table('client')
            ->join('otros_pagos',  'otros_pagos.client_id' , 'client.id')
            ->select( DB::raw('sum(otros_pagos.valor) as TasaAnual' ))
            ->where('client.id','=',$id)
            ->where('otros_pagos.estado','=',8)
            ->where('otros_pagos.tipoPago','=',6)
            ->get();

/*         $TasaAnualR =  DB::table('client','cli')
            ->join('tasa_anual',  [
                'cli.categoria_id' => 'tasa_anual.categoria_id',
                'cli.riesgo_id' => 'tasa_anual.riesgo_id' ,
                'cli.denominacion_id' => 'tasa_anual.denominacion_id' ])
            ->select('tasa_anual.valTasaAnual as TasaAnualR')
            ->where('cli.id', $id)
            ->get(); */

        /*return $TasaAnualR; */
        
        $cliente = DB::table('client')
            /* ->join('categorias',  'categorias.id' , 'client.categoria_id') */
            ->join('parroquias',  'parroquias.id' , 'client.parroquia_id')
            ->select( 'client.razonSocial','client.representanteLegal','client.ruc','client.barrio', 'client.telefono','parroquias.descripcion as parroquia','client.referencia'/* ,'categorias.descripcion as categoria' */)
            ->where('client.id','=',$id)
            ->get();

        




        $saldo = round( (( $TasaAnual[0]->TasaAnual - ($anticipos[0]->anticipos + $descuentos[0]->descuentos )) + $RecargoTrimestral[0]->RecargoTrimestral ), 5);


         if(!empty($cliente[0]->ruc)) {
            $res = array(
                "Pagos" => array(
                    "anticipos"         => (empty($anticipos[0]->anticipos)) ? 0 : $anticipos[0]->anticipos,
                    "descuentos"        => (empty($descuentos[0]->descuentos)) ? 0 : $descuentos[0]->descuentos,
                    "RecargoTrimestral" => (empty($RecargoTrimestral[0]->RecargoTrimestral)) ? 0 :round($RecargoTrimestral[0]->RecargoTrimestral,5),
                    "TasaAnual"         => (empty($TasaAnual[0]->TasaAnual)) ? 0 : round($TasaAnual[0]->TasaAnual,5),
                    "TasaAnualR"         => (empty($TasaAnual[0]->TasaAnualR)) ? 0 : round($TasaAnual[0]->TasaAnualR,5)
                ),
                "cliente" => array(
                    "razonSocial"           => strtoupper ($cliente[0]->razonSocial),
                    "representanteLegal"    => strtoupper ($cliente[0]->representanteLegal),
                    "ruc"                   => $cliente[0]->ruc,
                    "telefono"              => $cliente[0]->telefono,
                    "direccion"             => strtoupper ($cliente[0]->parroquia.' '.$cliente[0]->barrio),
                    /* "categoria"             => strtoupper ($cliente[0]->categoria), */
                    "saldo"                 => $saldo
                 ),
                "Respuesta"     => 'ok'
            );


            return json_encode($res);
        }
        $res = array(
            "Pagos" => [],
            "cliente" => [],
            "Respuesta"     => 'no existe infromacion'
        );
        return json_encode($res);
    }

    public function resumenPagoOrdenanzas($id){
      

        $anticipos = DB::table('client')
            ->join('pagos_ordenanza',  'pagos_ordenanza.client_id' , 'client.id')
            ->select( DB::raw('sum(pagos_ordenanza.valor) as anticipos' ))
            ->where('pagos_ordenanza.id','=',$id)
            ->where('pagos_ordenanza.estado','=',8)
            ->where('pagos_ordenanza.tipoPago','=',1)
            ->get();

        $descuentos = DB::table('client')
            ->join('pagos_ordenanza',  'pagos_ordenanza.client_id' , 'client.id')
            ->select( DB::raw('sum(pagos_ordenanza.valor) as descuentos' ))
            ->where('pagos_ordenanza.id','=',$id)
            ->where('pagos_ordenanza.estado','=',8)
            ->where('pagos_ordenanza.tipoPago','=',2)
            ->get();

        $RecargoTrimestral = DB::table('client')
            ->join('pagos_ordenanza',  'pagos_ordenanza.client_id' , 'client.id')
            ->select( DB::raw('sum(pagos_ordenanza.valor) as RecargoTrimestral' ))
            ->where('pagos_ordenanza.id','=',$id)
            ->where('pagos_ordenanza.estado','=',7)
            ->where('pagos_ordenanza.tipoPago','=',4)
            ->get();


        $TasaAnual = DB::table('client')
            ->join('pagos_ordenanza',  'pagos_ordenanza.client_id' , 'client.id')
            ->select( DB::raw('sum(pagos_ordenanza.valor) as TasaAnual' ))
            ->where('pagos_ordenanza.id','=',$id)
            ->where('pagos_ordenanza.estado','=',7)
            //->where('pagos_ordenanza.tipoPago','=',6)
            ->get();
            

/*         $TasaAnualR =  DB::table('client','cli')
            ->join('tasa_anual',  [
                'cli.categoria_id' => 'tasa_anual.categoria_id',
                'cli.riesgo_id' => 'tasa_anual.riesgo_id' ,
                'cli.denominacion_id' => 'tasa_anual.denominacion_id' ])
            ->select('tasa_anual.valTasaAnual as TasaAnualR')
            ->where('cli.id', $id)
            ->get(); */

        /*return $TasaAnualR; */
        
        $cliente = DB::table('client')
            /* ->join('categorias',  'categorias.id' , 'client.categoria_id') */
            ->join('parroquias',  'parroquias.id' , 'client.parroquia_id')
            ->join('pagos_ordenanza',  'pagos_ordenanza.client_id' , 'client.id')
            ->select( 'client.razonSocial','client.representanteLegal',
            DB::raw('TRIM(SUBSTRING_INDEX(pagos_ordenanza.descripcion, \'.\', 3)) as descripcion')
            ,'client.ruc','client.barrio', 'client.telefono','parroquias.descripcion as parroquia','client.referencia'/* ,'categorias.descripcion as categoria' */)
            ->where('pagos_ordenanza.id','=',$id)
            ->get();

        




        $saldo = round( (( $TasaAnual[0]->TasaAnual - ($anticipos[0]->anticipos + $descuentos[0]->descuentos )) + $RecargoTrimestral[0]->RecargoTrimestral ), 5);


         if(!empty($cliente[0]->ruc)) {
            $res = array(
                "Pagos" => array(
                    "anticipos"         => (empty($anticipos[0]->anticipos)) ? 0 : $anticipos[0]->anticipos,
                    "descuentos"        => (empty($descuentos[0]->descuentos)) ? 0 : $descuentos[0]->descuentos,
                    "RecargoTrimestral" => (empty($RecargoTrimestral[0]->RecargoTrimestral)) ? 0 :round($RecargoTrimestral[0]->RecargoTrimestral,5),
                    "TasaAnual"         => (empty($TasaAnual[0]->TasaAnual)) ? 0 : round($TasaAnual[0]->TasaAnual,5),
                    "TasaAnualR"         => (empty($TasaAnual[0]->TasaAnualR)) ? 0 : round($TasaAnual[0]->TasaAnualR,5)
                ),
                "cliente" => array(
                    "razonSocial"           => strtoupper ($cliente[0]->razonSocial),
                    "representanteLegal"    => strtoupper ($cliente[0]->representanteLegal),
                    "ruc"                   => $cliente[0]->ruc,
                    "telefono"              => $cliente[0]->telefono,
                    "descripcion"              => $cliente[0]->descripcion,
                    "direccion"             => strtoupper ($cliente[0]->parroquia.' '.$cliente[0]->barrio),
                   
                    "saldo"                 => $saldo
                 ),
                "Respuesta"     => 'ok'
            );


            return json_encode($res);
        }
        $res = array(
            "Pagos" => [],
            "cliente" => [],
            "Respuesta"     => 'no existe infromacion'
        );
        return json_encode($res);
    }

    public function dashboard(){
        $array = array(
            "industrias" => '0999999999',
            "almacenamiento" => 'XXXXXXXXXXXXXXXXXXXXX',
            "instalaciones" => 'XXXXXXXXXXXXXXXXXXXXX',
            "servicios" => '0.00',
            "comercios" => '0.00',


        );

        return json_encode($array);
    }


    /**
     * historialPagos de pago
     */
    public function historialPagos(){
        $data = System::all();

        if( auth()->user()->role_id == 5 ) {
            $historial = DB::table('otros_pagos')
                ->join('client', 'client.id', 'otros_pagos.client_id')
                ->join('tipos_pago', function ($join) {
                    $join->on('tipos_pago.id', 'otros_pagos.tipoPago')
                        ->where('tipos_pago.nombre', '<>', 'TOTAL');
                })
                ->leftJoin('formaspago', 'formaspago.id', 'otros_pagos.formaPago_id')
                ->select('ruc', 'razonSocial', 'formaspago.nombre as formaspago', 'tipos_pago.nombre as tipos_pago', 'valor', 'otros_pagos.id', 'otros_pagos.created_at'
                    ,'otros_pagos.docRespaldo' , 'otros_pagos.descripcion' )
                ->whereIn('tipos_pago.id', [2])
                ->orderBy('otros_pagos.created_at', 'desc')
                ->get();
            return view('imprecion/historyPayments', compact('data','historial'));

        }else {
            $historial = DB::table('otros_pagos')
                ->join('client', 'client.id', 'otros_pagos.client_id')
                ->join('tipos_pago', function ($join) {
                    $join->on('tipos_pago.id', 'otros_pagos.tipoPago')
                        ->where('tipos_pago.nombre', '<>', 'PAGO TOTAL');
                 })
                ->leftJoin('formaspago', 'formaspago.id', 'otros_pagos.formaPago_id')
                ->select('ruc', 'razonSocial', 'formaspago.nombre as formaspago', 'tipos_pago.nombre as tipos_pago', 'valor', 'otros_pagos.id'
                    , 'otros_pagos.created_at', 'otros_pagos.descripcion')
                //->whereNotIn('tipos_pago.id', [5,6])
                ->where('otros_pagos.estado','=', 8)
                ->orderBy('otros_pagos.created_at', 'desc')
                ->get();
            return view('imprecion/historyPayments', compact('data', 'historial'));
        }
    }


/* historial cobros*/
public function historialOrdenanzas(){
    $data = System::all();

    if( auth()->user()->role_id == 5 ) {
        $historial = DB::table('otros')
            ->join('client', 'client.id', 'pagos_ordenanza.client_id')
            ->join('tipos_pago', function ($join) {
                $join->on('tipos_pago.id', 'pagos_ordenanza.tipoPago')
                    ->where('tipos_pago.nombre', '<>', 'TOTAL');
                  
            })
            ->leftJoin('formaspago', 'formaspago.id', 'pagos_ordenanza.formaPago_id')
            ->select('ruc', 'razonSocial', 'formaspago.nombre as formaspago', 'tipos_pago.nombre as tipos_pago', 'valor', 'pagos_ordenanza.id', 'pagos_ordenanza.created_at'
                ,'pagos_ordenanza.docRespaldo' , 'pagos_ordenanza.descripcion' )
            ->whereIn('tipos_pago.id', [2])
            ->orderBy('id', 'desc')
            ->get();
        return view('imprecion/historyOrdenanzas', compact('data','historial'));

    }else {
     
        $historial = DB::table('pagos_ordenanza')
            ->join('client', 'client.id', 'pagos_ordenanza.client_id')
            ->join('tipos_pago', function ($join) {
                $join->on('tipos_pago.id', 'pagos_ordenanza.tipoPago')
                    ->where('tipos_pago.nombre', '<>', 'PAGO TOTAL');
             })
            ->leftJoin('formaspago', 'formaspago.id', 'pagos_ordenanza.formaPago_id')
            ->select('ruc', 'razonSocial', 'formaspago.nombre as formaspago', 'tipos_pago.nombre as tipos_pago', 'valor', 'pagos_ordenanza.id'
                , 'pagos_ordenanza.created_at', 'pagos_ordenanza.descripcion')
            ->whereNotIn('tipos_pago.id', [5,6])
            ->where('pagos_ordenanza.estado','=', 8)
            ->orderBy('id', 'desc')
            ->get();
            
        return view('imprecion/historyOrdenanzas', compact('data', 'historial'));
    }
}


    public function exoneracion_artesano($id) {
$tipo =  'artesano';

$client = DB::table('especies', 'cli')


->select('cli.id'
    , 'cli.ruc'
    , 'cli.razonSocial'
    , 'cli.representanteLegal'
    , 'cli.direccion'

    , 'cli.estado'
)
->where('cli.id', '=', $id)->get();







$doc = "Permiso de Exoneracion";
$pdf = PDF::loadView('imprecion/exoneraciones', ['client' => $client,'tipo' => $tipo]);


return $pdf->stream($doc . '.pdf');

    }

    public function exoneracion_tercera($id) {

        $tipo =  'tercera';
        $client = DB::table('especies', 'cli')


            ->select('cli.id'
                , 'cli.ruc'
                , 'cli.razonSocial'
                , 'cli.representanteLegal'
                , 'cli.direccion'


                , 'cli.estado'
            )
            ->where('cli.id', '=', $id)->get();







        $doc = "Permiso de Exoneracion";
        $pdf = PDF::loadView('imprecion/exoneraciones', ['client' => $client,'tipo' => $tipo]);


        return $pdf->stream($doc . '.pdf');


    }

    public function exoneracion_discapacidad($id) {

        $tipo =  'discapacidad';
        $client = DB::table('especies', 'cli')


            ->select('cli.id'
                , 'cli.ruc'
                , 'cli.razonSocial'
                , 'cli.representanteLegal'
                , 'cli.direccion'


                , 'cli.estado'
            )
            ->where('cli.id', '=', $id)->get();







        $doc = "Permiso de Exoneracion";
        $pdf = PDF::loadView('imprecion/exoneraciones', ['client' => $client,'tipo' => $tipo]);


        return $pdf->stream($doc . '.pdf');


    }
    
    public function facturaPagoOrdenanzas( $id ){
        $data = System::all();
        $client = DB::table('pagos_ordenanza')
            ->join('client','client.id','pagos_ordenanza.client_id')
            /* ->join('categorias','categorias.id','client.categoria_id') */
            ->join('parroquias','client.parroquia_id','parroquias.id')
                ->join('tipos_pago',  function ($join) {
                    $join->on('tipos_pago.id',  'pagos_ordenanza.tipoPago')
                        ->where('tipos_pago.nombre','<>','PAGO TOTAL');
                })
                ->leftJoin('formaspago','formaspago.id','pagos_ordenanza.formaPago_id')
                ->select(
                    'client.ruc',
                    'client.razonSocial',
                    'parroquias.descripcion as parroquia',
                    'client.barrio',
                    'client.telefono',
                    'client.referencia',
                    'formaspago.nombre as formaspago',
                    'tipos_pago.nombre as tipos_pago',
                    'pagos_ordenanza.valor',
                    'pagos_ordenanza.recargo',
                    DB::raw('YEAR(pagos_ordenanza.created_at) as year_now'),
                    'pagos_ordenanza.id',
                    'client.representanteLegal',
                    'pagos_ordenanza.created_at',
                    DB::raw('TRIM(SUBSTRING_INDEX(pagos_ordenanza.descripcion, \'.\', 3)) as descripcion')

                )
                ->whereNotIn('tipos_pago.id', [5, 6])
                ->where('pagos_ordenanza.id', '=', $id)
               
            ->get();


        $doc = "Comprobante de Pago";
        $pdf = PDF::loadView('imprecion/billPaymentsOrdenanzas', ['data' => $data, 'client'  => $client])
            ->setPaper('A5', 'landscape');
        return $pdf->stream($doc . '.pdf' );
    }

    public function facturaPago( $id ){
        $data = System::all();
        $client = DB::table('otros_pagos')
            ->join('client','client.id','otros_pagos.client_id')
            /* ->join('categorias','categorias.id','client.categoria_id') */
            ->join('parroquias','client.parroquia_id','parroquias.id')
                ->join('tipos_pago',  function ($join) {
                    $join->on('tipos_pago.id',  'otros_pagos.tipoPago')
                        ->where('tipos_pago.nombre','<>','PAGO TOTAL');
                })
                ->leftJoin('formaspago','formaspago.id','otros_pagos.formaPago_id')
                ->select('ruc'
                    ,'razonSocial'
                    ,'parroquias.descripcion as parroquia'
                    ,'barrio'
                    ,'telefono'
                    /* ,'categorias.descripcion as categoria' */
                    ,'referencia'
                    ,'formaspago.nombre as formaspago'
                    ,'tipos_pago.nombre as tipos_pago'
                    ,'valor'
                    ,'otros_pagos.recargo'
                    ,'year_now'
                    ,'otros_pagos.id' ,'representanteLegal'
                    ,'otros_pagos.created_at'
                    ,'otros_pagos.descripcion')
                ->whereNotIn('tipos_pago.id', [5,6])
                ->where('otros_pagos.id', '=', $id)
            ->get();


        $doc = "Comprobante de Pago";
        $pdf = PDF::loadView('imprecion/billPayments', ['data' => $data, 'client'  => $client])
            ->setPaper('A5', 'landscape');
        return $pdf->stream($doc . '.pdf' );
    }

    public function facturaPago2( $id ){

        $data = System::all();


        $client = DB::table('otros_cobros')
            ->leftJoin('formaspago','formaspago.id','otros_cobros.formaPago_id')
            ->select('ruc',
                'razonSocial',
                'direccion',
                'telefono',
                'formaspago.nombre as tipos_pago',
                'valor',
                'otros_cobros.id' ,
                'year_now',
                'porcenjatetasa',
                'representanteLegal',
                'descripcion',
                'otros_cobros.created_at')

            ->where('otros_cobros.estado','=',8)
            ->where('otros_cobros.id','=',$id)
            ->get();


        $doc = "Comprobante de Pago";
        $pdf = PDF::loadView('imprecion/billDiferentPayments', ['data' => $data, 'client' => $client])
            ->setPaper('A5', 'landscape');
        return $pdf->stream($doc . '.pdf' );
    }

    public function especiesPayments( $id ){

        $data = System::all();


        $client = Especies::where('estado','=','1')
            ->where('id','=',$id)
            ->get();


        $doc = "Comprobante de Pago";
        $pdf = PDF::loadView('imprecion/especiesPayments', ['data' => $data, 'client' => $client])
            ->setPaper('A5', 'landscape');
        return $pdf->stream($doc . '.pdf' );
    }



    public function inspecciones(){
        $data = System::all();
        $clients = DB::table('client','cli')
            /* ->join('denominaciones','cli.denominacion_id','denominaciones.id') */
            /* ->join('categorias','cli.categoria_id','categorias.id') */
            ->select(   'cli.id'
                ,'cli.ruc'
                ,'cli.razonSocial'
                ,'cli.representanteLegal'
                ,'cli.parroquia_id'
                ,'cli.telefono'
                ,'cli.referencia'
                ,'cli.categoria_id'
                ,'cli.denominacion_id'
                ,'cli.tipoFormulario'
                /* ,'denominaciones.descripcion as denominacion' */
                /* ,'categorias.descripcion as categorias' */
                ,'cli.estado'
            )
            ->orWhere( function ( $q ){
                $q->whereNotIn('cli.estado', array(1));
            })
            ->orderBy('cli.id','desc')
            ->get();
        return view( 'inspecciones' , compact('data','clients') );
    }





    /*
    public function ok($id){
        $requerimientos = DB::table('requerimientos')
            ->join('det_requerimientos','requerimientos.id','det_requerimientos.requerimiento_id')
            ->select(   'requerimientos.id as edit','requerimientos.*','det_requerimientos.*' )
            ->where('det_requerimientos.client_id',$id)
            ->get();
        $client = DB::table('client')
            ->join('parroquias','parroquias.id','client.parroquia_id')
            ->join('categorias','categorias.id','client.categoria_id')
            ->join('denominaciones','denominaciones.id','client.denominacion_id')
            ->select(   'client.id'
                ,'client.created_at'
                ,'client.tipoFormulario'
                ,'client.ruc'
                ,'client.razonSocial'
                ,'client.representanteLegal'
                ,'parroquias.descripcion as parroquia'
                ,'client.barrio'
                ,'client.referencia'
                ,'client.telefono'
                ,'client.riesgo_id'
                ,'client.decripcion'
                ,'categorias.descripcion as categoria'
                ,'denominaciones.descripcion as denominacion'
                ,'client.estado'
            )->where('client.id', $id)
            ->get();
        $riego = DB::table('riesgos' ,'r')->select('r.id', 'r.descripcion')->where('r.estado', 2)->orderBy('r.descripcion','ASC')->get();

        $fotosLocal = DB::table('fotos_local')
            ->join('client','client.id','fotos_local.client_id')
            ->select(   'fotos_local.path' )
            ->where('client.id',$id)
            ->get();

        $a = array(
            "requerimientos" => $requerimientos,
            "cl" => $client,
            "r" => $riego,
            "fl" => $fotosLocal
        );
        return  json_encode($a);

    }

    public function ok2($id){

         $riego         = DB::table('riesgos' ,'r')->select('r.id', 'r.descripcion')->where('r.estado', 2)->orderBy('r.descripcion','ASC')->get();

        $requerimientos = Requerimientos::all();
        $client = DB::table('client')
            ->join('parroquias','parroquias.id','client.parroquia_id')
            ->join('categorias','categorias.id','client.categoria_id')
            ->join('denominaciones','denominaciones.id','client.denominacion_id')
            ->select(   'client.id'
                ,'client.ruc'
                ,'client.razonSocial'
                ,'client.representanteLegal'
                ,'parroquias.descripcion as parroquia'
                ,'client.barrio'
                ,'client.referencia'
                ,'client.telefono'
                ,'denominaciones.descripcion as denominacion'
                ,'categorias.descripcion as categoria'
                ,'client.estado'
            )->where('client.id', $id)
            ->get();

        $a = array(
            "requerimientos" => $requerimientos,
            "cl" => $client,
            "r" => $riego
         );
        return  json_encode($a);

    }



*/






}
