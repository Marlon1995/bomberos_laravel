<?php

namespace App\Http\Controllers;

use App\Especies;
use App\Exports\CierreCajaExport;
use App\Exports\InspectoresExport;
use App\Exports\NoemitidosExport;
use App\System;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Excel;
use App\Client;

class ReporteController extends Controller
{
    function __construct()
    {
        $this->middleware(['authUser','roles:3,5,7,8,4']);
    }

    public function index(){
         $data = System::all();
         return view( 'report', compact('data') );

    }

    public function reporte1(){
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
               'otros_pagos.year_now',
               'otros_pagos.numPermisoFuncionamiento',
               'otros_pagos.numTransaccion',
               'otros_pagos.numTituloAdmin',
               
               'valor','otros_pagos.recargo',
                'otros_pagos.created_at')
            ->whereNotIn('tipos_pago.id', [2])
            ->where('otros_pagos.estado','=', 8)
            ->where('otros_pagos.created_at','like', date("Y-m-d").'%' )
            ->orderBy('otros_pagos.created_at', 'desc')
            ->get();

            $reporte_ordenanzas = DB::table('pagos_ordenanza')
            ->join('client', 'client.id', 'pagos_ordenanza.client_id')
            ->join('tipos_pago', function ($join) {
                $join->on('tipos_pago.id', 'pagos_ordenanza.tipoPago')
                    ->where('tipos_pago.nombre', '<>', 'PAGO TOTAL');
            })
            ->leftJoin('formaspago', 'formaspago.id', 'pagos_ordenanza.formaPago_id')
            ->select(   'ruc',
                'razonSocial',
                'formaspago.nombre as formaspago',
                'tipos_pago.nombre as tipos_pago',
                'valor',
               'pagos_ordenanza.year_now',
               'pagos_ordenanza.numPermisoFuncionamiento',
               'pagos_ordenanza.numTransaccion',
               'pagos_ordenanza.numTituloAdmin',
               'valor','pagos_ordenanza.recargo',
                'pagos_ordenanza.created_at')
            ->whereNotIn('tipos_pago.id', [2])
            ->where('pagos_ordenanza.estado','=', 8)
            ->where('pagos_ordenanza.created_at','like', date("Y-m-d").'%' )
            ->orderBy('pagos_ordenanza.created_at', 'desc')
            ->get();

        $cobros= DB::table('otros_cobros')
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
                'numTituloAdmin',
                'descripcion',
                'otros_cobros.created_at')
           ->where('otros_cobros.created_at','like', date("Y-m-d").'%' )
            ->where('otros_cobros.estado','=',8)

            ->get();



        $especie = Especies::where('estado','=','1')
            ->where('created_at','like', date("Y-m-d").'%' )
            ->get();

        $doc = "";
        $pdf = PDF::loadView('report/reporte1' , [
                                                    "reporte" => $reporte,
                                                    "reporte_ordenanzas" => $reporte_ordenanzas,
                                                    "cobros"  => $cobros,
                                                    "especie" => $especie
                                                ])->setPaper('A4');
        return $pdf->stream($doc . '.pdf');
        
    }
    public function cierreCajaExcel(){
        $file = "CIERRE DE CAJA DIARIO".now()->toDateTimeString();
        return \Maatwebsite\Excel\Facades\Excel::download( new CierreCajaExport() , $file.'.xlsx');
    }



    public function reporte2(){
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
                'otros_pagos.created_at')
            ->whereNotIn('tipos_pago.id', [2])
            ->where('otros_pagos.estado','=', 8)
            ->where('otros_pagos.created_at','like', date("Y-m-d").'%' )
            ->where('otros_pagos.created_at','<=', date("Y-m-d H:i:s") )
            ->orderBy('otros_pagos.created_at', 'desc')
            ->get();

        $doc = "";
        $pdf = PDF::loadView('report/reporte2' , ["reporte" => $reporte]);
         return $pdf->stream($doc . '.pdf');
    }

    public function reporte3(){
        $doc = "titulo reporte";
        $pdf = PDF::loadView('report/reporte3');
        return $pdf->stream($doc . '.pdf');
    }

    public function reporte4(){
        $reporte = DB::table('client', 'cli')
            /* ->join('denominaciones', 'cli.denominacion_id', 'denominaciones.id') */
            /* ->join('categorias', 'cli.categoria_id', 'categorias.id') */
            ->join('parroquias', 'cli.parroquia_id', 'parroquias.id')
            ->select('cli.id'
                , 'cli.ruc'
                , 'cli.razonSocial'
                , 'cli.representanteLegal'
                , 'parroquias.descripcion as parroquia'
                , 'cli.telefono'
                , 'cli.barrio'
                , 'cli.referencia'
            )
            ->whereIn('cli.estado', [4])
            ->orderBy('parroquias.descripcion', 'ASC')
            ->get();
        $doc = "";
        $pdf = PDF::loadView('report/reporte4' , ["reporte" => $reporte]);
        return $pdf->stream($doc . '.pdf');
    }



    public function reporteParroquias()
    {
        $reporte = DB::table('client', 'cli')
            ->join('denominaciones', 'cli.denominacion_id', "=", 'denominaciones.id')
            ->join("parroquias", "parroquias.id", "=", "cli.parroquia_id")
            ->join('otros_pagos', 'cli.id', 'otros_pagos.client_id')
            ->select(
                'cli.id',
                'cli.ruc',
                'cli.razonSocial',
                'cli.representanteLegal',
                'parroquias.descripcion  as parroquia',
                'cli.barrio',
                'cli.telefono',
                'cli.referencia',
                'denominaciones.descripcion as denominacion',
                'otros_pagos.year_now as anio',
                'otros_pagos.valor',
                'otros_pagos.created_at'
            )
            ->where('otros_pagos.numPermisoFuncionamiento', '<>', null)
            ->where('cli.estado', '=', 8)
            ->where('otros_pagos.estado', '<>', 1)
            ->orderBy('parroquias.descripcion', 'desc')
            ->orderBy('otros_pagos.year_now', 'desc')
            ->limit(100)
            ->get();
        $doc = "";
        $pdf = PDF::loadView('report/reporteParroquias', ["reporte" => $reporte])->setPaper('A4', 'landscape');;
        return $pdf->stream($doc . '.pdf');
    }


    public function reporte6(){
        $data = System::all();
        return view('report/reporte6'  ,compact('data') );

    }

    public function reporte5(){
        $data = System::all();
        return view('report/reporteporfechaEspecie'  ,compact('data') );

    }
    public function reporte8(){
        $data = System::all();
        return view('report/reporteporfechaTitulo'  ,compact('data') );

      
    }
    public function reporte9(){
       
        $data = System::all();

        return view('report/reporteporfechaInspecciones'  ,compact('data') );

    }
    public function reporte7(){
        $data = System::all();
        return view('report'  ,compact('data') );

    }


    public function reportePorFechasEspecies( Request $request ){

        $fechas = $request->input('reservation');
        $estado = $request->input('tipoTransaccion');
        $fecha1 = substr($fechas, 0, -13);
        $fecha2 = substr($fechas, 13);

        $fecha1_c = date('Y-m-d', strtotime($fecha1));
        $fecha2_c = date('Y-m-d', strtotime($fecha2));
        $rangos = array(
            "r1" => $fecha1_c,
            "r2" => $fecha2_c
        );




    $especie = Especies::where('estado','=',$estado)
        //->where('created_at','like', date("Y-m-d").'%' )
        ->whereBetween(DB::raw('DATE(created_at)'),[ $fecha1_c, $fecha2_c])

        ->get();

    $doc = "";
    $pdf = PDF::loadView('report/reporte5' , [
                                                "fechas" => $rangos,
                                               
                                                "especie" => $especie
                                            ])->setPaper('A4');
    return $pdf->stream($doc . '.pdf');

    }

    public function reportePorFechasTitulos( Request $request ){

        $fechas = $request->input('reservation');
        $fecha1 = substr($fechas, 0, -13);
        $fecha2 = substr($fechas, 13);

        $fecha1_c = date('Y-m-d', strtotime($fecha1));
        $fecha2_c = date('Y-m-d', strtotime($fecha2));
        $rangos = array(
            "r1" => $fecha1_c,
            "r2" => $fecha2_c
        );

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
           'otros_pagos.year_now',
           'otros_pagos.numPermisoFuncionamiento',
           'otros_pagos.numTransaccion',
           'otros_pagos.numTituloAdmin',
           'valor','otros_pagos.recargo',
            'otros_pagos.created_at')
        ->whereNotIn('tipos_pago.id', [2])
        ->where('otros_pagos.estado','=', 8)
        ->whereBetween(DB::raw('DATE(otros_pagos.created_at)'),[ $fecha1_c, $fecha2_c])

       // ->where('otros_pagos.created_at','like', date("Y-m-d").'%' )
        ->orderBy('otros_pagos.created_at', 'desc')
        ->get();
      

        $reporte_ordenanzas = DB::table('pagos_ordenanza')
        ->join('client', 'client.id', 'pagos_ordenanza.client_id')
        ->join('tipos_pago', function ($join) {
            $join->on('tipos_pago.id', 'pagos_ordenanza.tipoPago')
                ->where('tipos_pago.nombre', '<>', 'PAGO TOTAL');
        })
        ->leftJoin('formaspago', 'formaspago.id', 'pagos_ordenanza.formaPago_id')
        ->select(   'ruc',
            'razonSocial',
            'formaspago.nombre as formaspago',
            'tipos_pago.nombre as tipos_pago',
            'valor',
           'pagos_ordenanza.year_now',
           'pagos_ordenanza.numPermisoFuncionamiento',
           'pagos_ordenanza.numTransaccion',
           'pagos_ordenanza.numTituloAdmin',
           'valor','pagos_ordenanza.recargo',
            'pagos_ordenanza.created_at')
        ->whereNotIn('tipos_pago.id', [2])
        ->where('pagos_ordenanza.estado','=', 8)
        //->where('pagos_ordenanza.created_at','like', date("Y-m-d").'%' )
        ->whereBetween(DB::raw('DATE(pagos_ordenanza.created_at)'),[ $fecha1_c, $fecha2_c])

        ->orderBy('pagos_ordenanza.created_at', 'desc')
        ->get();

        $cobros= DB::table('otros_cobros')
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
            'numTituloAdmin',
            'descripcion',
            'otros_cobros.created_at')
       ->where('otros_cobros.created_at','like', date("Y-m-d").'%' )
        ->where('otros_cobros.estado','=',8)

        ->get();
   

    $doc = "";
    $pdf = PDF::loadView('report/reporteTitulos' , [
                                                "fechas" => $rangos,
                                                "cobros"=>$cobros,
                                                "reporte" => $reporte,
                                                "reporte_ordenanzas" => $reporte_ordenanzas
                                                
                                            ])->setPaper('A4');
    return $pdf->stream($doc . '.pdf');

    }

    public function reportePorFechas( Request $request ){

        $fechas = $request->input('reservation');
        $fecha1 = substr($fechas, 0, -13);
        $fecha2 = substr($fechas, 13);

        $fecha1_c = date('Y-m-d', strtotime($fecha1));
        $fecha2_c = date('Y-m-d', strtotime($fecha2));
        $rangos = array(
            "r1" => $fecha1_c,
            "r2" => $fecha2_c
        );

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
           'otros_pagos.year_now',
           'otros_pagos.numPermisoFuncionamiento',
           'otros_pagos.numTransaccion',
           'otros_pagos.numTituloAdmin',
           'valor','otros_pagos.recargo',
            'otros_pagos.created_at')
        ->whereNotIn('tipos_pago.id', [2])
        ->where('otros_pagos.estado','=', 8)
        ->whereBetween(DB::raw('DATE(otros_pagos.created_at)'),[ $fecha1_c, $fecha2_c])

       // ->where('otros_pagos.created_at','like', date("Y-m-d").'%' )
        ->orderBy('otros_pagos.created_at', 'desc')
        ->get();
      

        $reporte_ordenanzas = DB::table('pagos_ordenanza')
        ->join('client', 'client.id', 'pagos_ordenanza.client_id')
        ->join('tipos_pago', function ($join) {
            $join->on('tipos_pago.id', 'pagos_ordenanza.tipoPago')
                ->where('tipos_pago.nombre', '<>', 'PAGO TOTAL');
        })
        ->leftJoin('formaspago', 'formaspago.id', 'pagos_ordenanza.formaPago_id')
        ->select(   'ruc',
            'razonSocial',
            'formaspago.nombre as formaspago',
            'tipos_pago.nombre as tipos_pago',
            'valor',
           'pagos_ordenanza.year_now',
           'pagos_ordenanza.numPermisoFuncionamiento',
           'pagos_ordenanza.numTransaccion',
           'valor','pagos_ordenanza.recargo',
           'pagos_ordenanza.numTituloAdmin',
            'pagos_ordenanza.created_at')
        ->whereNotIn('tipos_pago.id', [2])
        ->where('pagos_ordenanza.estado','=', 8)
        //->where('pagos_ordenanza.created_at','like', date("Y-m-d").'%' )
        ->whereBetween(DB::raw('DATE(pagos_ordenanza.created_at)'),[ $fecha1_c, $fecha2_c])

        ->orderBy('pagos_ordenanza.created_at', 'desc')
        ->get();

    $cobros= DB::table('otros_cobros')
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
            'numTituloAdmin',
            'representanteLegal',
            'descripcion',
            'otros_cobros.created_at')
       //->where('otros_cobros.created_at','like', date("Y-m-d").'%' )
       ->whereBetween(DB::raw('DATE(otros_cobros.created_at)'),[ $fecha1_c, $fecha2_c])

       
        ->where('otros_cobros.estado','=',8)

        ->get();



    $especie = Especies::where('estado','=','1')
        //->where('created_at','like', date("Y-m-d").'%' )
        ->whereBetween(DB::raw('DATE(created_at)'),[ $fecha1_c, $fecha2_c])

        ->get();

    $doc = "";
    $pdf = PDF::loadView('report/reporte1' , [
                                                "reporte" => $reporte,
                                                "reporte_ordenanzas" => $reporte_ordenanzas,
                                                "cobros"  => $cobros,
                                                "especie" => $especie
                                            ])->setPaper('A4');
    return $pdf->stream($doc . '.pdf');

    }

    public function noemitidos(){
        $file = "REPORTES NO EMITIDOS".now()->toDateTimeString();
        return \Maatwebsite\Excel\Facades\Excel::download( new NoemitidosExport() , $file.'.xlsx');
    }




    public function reporteContadorDiario( $tipe , $date){

        $array = [ "tipe" => $tipe,   "date" => date("Y-m-d", strtotime($date) ) ];


        if( $array['tipe'] == 'ccdiarios' ) {
            $doc = "";
            $reporte = DB::table('otros_pagos')
                ->join('client', 'client.id', 'otros_pagos.client_id')
                ->join('tipos_pago', function ( $join ) {
                $join->on('tipos_pago.id', 'otros_pagos.tipoPago')->where('tipos_pago.nombre', '<>', 'PAGO TOTAL');
            })
                ->leftJoin('formaspago', 'formaspago.id', 'otros_pagos.formaPago_id')
                ->select('ruc', 'razonSocial', 'otros_pagos.numPermisoFuncionamiento','otros_pagos.numTransaccion','year_now','formaspago.nombre as formaspago', 'tipos_pago.nombre as tipos_pago', 'valor','otros_pagos.recargo', 'otros_pagos.created_at','otros_pagos.year_now','otros_pagos.numPermisoFuncionamiento','otros_pagos.numTransaccion')
                ->whereNotIn('tipos_pago.id', [ 2 ])
                ->where('otros_pagos.estado', '=', 8)
                ->where('otros_pagos.created_at', 'like', $array['date'] . '%')
                ->orderBy('otros_pagos.created_at', 'desc')->get();
            $cobros= DB::table('otros_cobros')
                ->leftJoin('formaspago','formaspago.id','otros_cobros.formaPago_id')
                ->select('ruc',
                    'razonSocial',
                    'direccion',
                    'telefono',
                       'year_now' ,

                    'formaspago.nombre as tipos_pago',
                    'valor',
                    'otros_cobros.id' ,
                    'year_now',
                    'porcenjatetasa',
                    'representanteLegal',
                    'descripcion',
                    'otros_cobros.created_at')
                ->where('otros_cobros.created_at', 'like', $array['date'] . '%')
                ->where('otros_cobros.estado','=',8)
                ->get();

            $especie = Especies::where('estado','=','1')
                ->where('created_at','like', $array['date'] .'%' )
                ->get();


            $pdf = PDF::loadView('report/reporte1', [ "reporte" => $reporte ,"cobros"  => $cobros ,'especie' => $especie])->setPaper('A4');
          
            return $pdf->stream($doc . '.pdf');
        }elseif ( $array['tipe'] == 'remitidos' ) {

            $reporte = DB::table('client', 'cli')
                /* ->join('denominaciones', 'cli.denominacion_id', 'denominaciones.id') */
                /* ->join('categorias', 'cli.categoria_id', 'categorias.id') */
                ->join('parroquias', 'cli.parroquia_id', 'parroquias.id')
                ->select('cli.id'
                    , 'cli.ruc'
                    , 'cli.razonSocial'
                    , 'cli.representanteLegal'
                    , 'parroquias.descripcion as parroquia'
                    , 'cli.telefono'
                    , 'cli.barrio'
                    , 'cli.referencia'
                    , 'cli.created_at'
                )
                ->whereIn('cli.estado', [4])
                ->orderBy('parroquias.descripcion', 'ASC')
                ->where('cli.created_at', 'like', $array['date'] . '%')
                ->get();
            $doc = "";
            $pdf = PDF::loadView('report/reporte4' , ["reporte" => $reporte]);
            return $pdf->stream($doc . '.pdf');

            
        }elseif( $array['tipe'] == 'permisos' ) {
            $reporte = DB::table('client', 'cli')
                ->join('otros_pagos', 'cli.id', 'otros_pagos.client_id')
                ->select('cli.id'
                    , 'cli.ruc'
                    , 'cli.razonSocial'
                    , 'cli.representanteLegal'
                    , 'otros_pagos.year_now as anio'
                    ,'otros_pagos.valor'
                    ,'otros_pagos.numPermisoFuncionamiento'
                    ,'otros_pagos.created_at'
                )
                ->where('otros_pagos.numPermisoFuncionamiento', '<>', null)
                ->where('cli.estado', '=', 8)
                 ->where('otros_pagos.created_at','like', $array['date'].'%' )
                ->orderBy('otros_pagos.created_at', 'desc')
                ->orderBy('otros_pagos.year_now', 'desc')
                ->get();

            $doc = "";
            $pdf = PDF::loadView('report/reporte5' , ["reporte" => $reporte])->setPaper('A4', 'landscape');
            return $pdf->stream($doc . '.pdf');
        }elseif( $array['tipe'] == 'parroquias' ) {
            $reporte = DB::table('client', 'cli')->join('denominaciones', 'cli.denominacion_id', 'denominaciones.id')->join('parroquias', 'cli.parroquia_id', 'parroquias.id')->join('otros_pagos', 'cli.id', 'otros_pagos.client_id')->select('cli.id', 'cli.ruc', 'cli.razonSocial', 'cli.representanteLegal', 'parroquias.descripcion  as parroquia', 'cli.barrio', 'cli.telefono', 'cli.referencia', 'denominaciones.descripcion as denominacion', 'otros_pagos.year_now as anio', 'otros_pagos.valor', 'otros_pagos.created_at')->where('otros_pagos.numPermisoFuncionamiento', '<>', null)->where('cli.estado', '=', 8)->where('otros_pagos.estado', '<>', 1)->where('otros_pagos.created_at', 'like', $array['date'] . '%')->orderBy('parroquias.descripcion', 'desc')->get();

            $doc = "";
            $pdf = PDF::loadView('report/reporteParroquias' , ["reporte" => $reporte]);
            return $pdf->stream($doc . '.pdf');
        }



    }

    public function reporteContadorSemanal( $tipe , $fechaInicial , $fechaFinal) {

        $array = [ "tipe" => $tipe,  "fechaInicial"  => date("Y-m-d", strtotime($fechaInicial) ),    "fechaFinal"    => date("Y-m-d", strtotime($fechaFinal) )       ];



        if( $array['tipe'] == 'ccdiarios' ) {
            $doc = "";
            $reporte = DB::table('otros_pagos')
                ->join('client', 'client.id', 'otros_pagos.client_id')
                ->join('tipos_pago', function ( $join ) {
                    $join->on('tipos_pago.id', 'otros_pagos.tipoPago')->where('tipos_pago.nombre', '<>', 'PAGO TOTAL');
                })
                ->leftJoin('formaspago', 'formaspago.id', 'otros_pagos.formaPago_id')
                ->select('ruc', 'razonSocial', 'otros_pagos.numPermisoFuncionamiento','otros_pagos.numTransaccion','year_now', 'formaspago.nombre as formaspago', 'tipos_pago.nombre as tipos_pago', 'valor','otros_pagos.recargo', 'otros_pagos.created_at')
                ->whereNotIn('tipos_pago.id', [ 2 ])
                ->where('otros_pagos.estado', '=', 8)
                ->where('otros_pagos.created_at','>=', $array['fechaInicial'].'%' )
                ->where('otros_pagos.created_at','<=', $array['fechaFinal'].'%' )

                ->orderBy('otros_pagos.created_at', 'desc')->get();
            $cobros= DB::table('otros_cobros')
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
                ->where('otros_cobros.created_at','>=', $array['fechaInicial'].'%' )
                ->where('otros_cobros.created_at','<=', $array['fechaFinal'].'%' )
                ->where('otros_cobros.estado','=',8)
                ->get();

            $especie = Especies::where('estado','=','1')
                ->where('created_at','like', $array['fechaInicial'] .'%' )
                ->where('created_at','like', $array['fechaFinal'] .'%' )
                ->get();



            $pdf = PDF::loadView('report/reporte1', [ "reporte" => $reporte ,"cobros"  => $cobros , 'especie' => $especie])->setPaper('A4');
            return $pdf->stream($doc . '.pdf');
        }elseif ( $array['tipe'] == 'remitidos' ) {

            $reporte = DB::table('client', 'cli')
                /* ->join('denominaciones', 'cli.denominacion_id', 'denominaciones.id') */
                /* ->join('categorias', 'cli.categoria_id', 'categorias.id') */
                ->join('parroquias', 'cli.parroquia_id', 'parroquias.id')
                ->select('cli.id'
                    , 'cli.ruc'
                    , 'cli.razonSocial'
                    , 'cli.representanteLegal'
                    , 'parroquias.descripcion as parroquia'
                    , 'cli.telefono'
                    , 'cli.barrio'
                    , 'cli.referencia'
                    , 'cli.created_at'
                )
                ->whereIn('cli.estado', [4])
                ->orderBy('parroquias.descripcion', 'ASC')
                ->where('cli.created_at','>=', $array['fechaInicial'].'%' )
                ->where('cli.created_at','<=', $array['fechaFinal'].'%' )

                ->get();

            $doc = "";
            $pdf = PDF::loadView('report/reporte4' , ["reporte" => $reporte]);
            return $pdf->stream($doc . '.pdf');
            
        }elseif( $array['tipe'] == 'permisos' ) {
            $reporte = DB::table('client', 'cli')
                ->join('otros_pagos', 'cli.id', 'otros_pagos.client_id')
                ->select('cli.id'
                    , 'cli.ruc'
                    , 'cli.razonSocial'
                    , 'cli.representanteLegal'
                    , 'otros_pagos.year_now as anio'
                    ,'otros_pagos.valor'
                    ,'otros_pagos.numPermisoFuncionamiento'
                    ,'otros_pagos.created_at'
                )
                ->where('otros_pagos.numPermisoFuncionamiento', '<>', null)
                ->where('cli.estado', '=', 8)
                ->where('otros_pagos.created_at','>=', $array['fechaInicial'].'%' )
                ->where('otros_pagos.created_at','<=', $array['fechaFinal'].'%' )
                ->orderBy('otros_pagos.created_at', 'desc')
                ->orderBy('otros_pagos.year_now', 'desc')
                ->get();

            $doc = "";
            $pdf = PDF::loadView('report/reporte5' , ["reporte" => $reporte])->setPaper('A4', 'landscape');
            return $pdf->stream($doc . '.pdf');
        }elseif( $array['tipe'] == 'parroquias' ) {
            $reporte = DB::table('client', 'cli')->join('denominaciones', 'cli.denominacion_id', 'denominaciones.id')->join('parroquias', 'cli.parroquia_id', 'parroquias.id')->join('otros_pagos', 'cli.id', 'otros_pagos.client_id')->select('cli.id', 'cli.ruc', 'cli.razonSocial', 'cli.representanteLegal', 'parroquias.descripcion  as parroquia', 'cli.barrio', 'cli.telefono', 'cli.referencia', 'denominaciones.descripcion as denominacion', 'otros_pagos.year_now as anio', 'otros_pagos.valor', 'otros_pagos.created_at')->where('otros_pagos.numPermisoFuncionamiento', '<>', null)->where('cli.estado', '=', 8)
                ->where('otros_pagos.estado', '<>', 1)
                ->where('otros_pagos.created_at', '>=', $array['fechaInicial'] . '%')
                ->where('otros_pagos.created_at', '<=', $array['fechaFinal'] . '%')

                ->orderBy('parroquias.descripcion', 'desc')->get();

            $doc = "";
            $pdf = PDF::loadView('report/reporteParroquias' , ["reporte" => $reporte])->setPaper('A4', 'landscape');
            return $pdf->stream($doc . '.pdf');
        }




    }

    }
