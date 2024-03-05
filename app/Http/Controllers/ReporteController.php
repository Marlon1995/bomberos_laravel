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
        $this->middleware(['authUser','roles:3,5,7,8,4,1']);
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
                'otros_pagos.updated_at as created_at')
            ->whereNotIn('tipos_pago.id', [2])
            ->where('otros_pagos.estado','=', 8)
            ->where('otros_pagos.updated_at','like', date("Y-m-d").'%' )
            ->orderBy('otros_pagos.updated_at', 'desc')
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
                'pagos_ordenanza.updated_at as created_at')
            ->whereNotIn('tipos_pago.id', [2])
            ->where('pagos_ordenanza.estado','=', 8)
            ->where('pagos_ordenanza.updated_at','like', date("Y-m-d").'%' )
            ->orderBy('pagos_ordenanza.updated_at', 'desc')
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
                'otros_cobros.updated_at as created_at')
           ->where('otros_cobros.updated_at','like', date("Y-m-d").'%' )
            ->where('otros_cobros.estado','=',8)

            ->get();



        $especie = Especies::where('estado','=','1')
            ->where('updated_at','like', date("Y-m-d").'%' )
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
                'otros_pagos.updated_at as created_at')
            ->whereNotIn('tipos_pago.id', [2])
            ->where('otros_pagos.estado','=', 8)
            ->where('otros_pagos.updated_at','like', date("Y-m-d").'%' )
            ->where('otros_pagos.updated_at','<=', date("Y-m-d H:i:s") )
            ->orderBy('otros_pagos.updated_at', 'desc')
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
                'otros_pagos.updated_at as created_at'
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

    public function reporte11(){
       
        $data = System::all();

        return view('report/reporteporfechaNoEmitidos'  ,compact('data') );

    }

    public function reporte12(){
       
        $data = System::all();

        return view('report/reporteporfechaParroquias'  ,compact('data') );

    }
    public function reporte7(){
        $data = System::all();
        return view('report'  ,compact('data') );

    }

    public function reporte10(){
        $data = System::all();
        return view('report/reporteporfechaEspecies'  ,compact('data') );

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
        //->where('updated_at','like', date("Y-m-d").'%' )
        ->whereBetween(DB::raw('DATE(updated_at)'),[ $fecha1_c, $fecha2_c])

        ->get();

   

    $doc = "";
    $pdf = PDF::loadView('report/reporte5' , [
                                                "fechas" => $rangos,
                                               
                                                "especie" => $especie
                                            ])->setPaper('A4');
    return $pdf->stream($doc . '.pdf');

    }

    public function reportePorFechasEspeciesEmitidas( Request $request ){

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
            'otros_pagos.updated_at as created_at')
        ->whereNotIn('tipos_pago.id', [2])
        ->where('otros_pagos.estado','=', 8)
        ->whereNotNull('otros_pagos.numTituloAdmin')
        ->whereBetween(DB::raw('DATE(otros_pagos.updated_at)'),[ $fecha1_c, $fecha2_c])

       // ->where('otros_pagos.updated_at','like', date("Y-m-d").'%' )
        ->orderBy('otros_pagos.updated_at', 'desc')
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
            'pagos_ordenanza.updated_at as created_at')
        ->whereNotIn('tipos_pago.id', [2])
        ->where('pagos_ordenanza.estado','=', 8)
        ->whereNotNull('pagos_ordenanza.numTituloAdmin')

        //->where('pagos_ordenanza.updated_at','like', date("Y-m-d").'%' )
        ->whereBetween(DB::raw('DATE(pagos_ordenanza.updated_at)'),[ $fecha1_c, $fecha2_c])

        ->orderBy('pagos_ordenanza.updated_at', 'desc')
        ->get();

        $cobros=  Especies::where('estado','=','1')
        //->where('updated_at','like', date("Y-m-d").'%' )
        ->whereBetween(DB::raw('DATE(updated_at)'),[ $fecha1_c, $fecha2_c])

        ->get();

      
   

    $doc = "";
    $pdf = PDF::loadView('report/reporteEspecies' , [
                                                "fechas" => $rangos,
                                                "cobros"=>$cobros,
                                                "reporte" => $reporte,
                                                "reporte_ordenanzas" => $reporte_ordenanzas
                                                
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
            'otros_pagos.updated_at as created_at')
        ->whereNotIn('tipos_pago.id', [2])
        ->where('otros_pagos.estado','=', 8)
        ->whereNotNull('otros_pagos.numTituloAdmin')
        ->whereBetween(DB::raw('DATE(otros_pagos.updated_at)'),[ $fecha1_c, $fecha2_c])

       // ->where('otros_pagos.updated_at','like', date("Y-m-d").'%' )
        ->orderBy('otros_pagos.updated_at', 'desc')
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
            'pagos_ordenanza.updated_at as created_at')
        ->whereNotIn('tipos_pago.id', [2])
        ->whereNotNull('pagos_ordenanza.numTituloAdmin')
        ->where('pagos_ordenanza.estado','=', 8)
        //->where('pagos_ordenanza.updated_at','like', date("Y-m-d").'%' )
        ->whereBetween(DB::raw('DATE(pagos_ordenanza.updated_at)'),[ $fecha1_c, $fecha2_c])

        ->orderBy('pagos_ordenanza.updated_at', 'desc')
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
            'otros_cobros.updated_at as created_at')
            ->whereNotNull('otros_cobros.numTituloAdmin')
       ->where('otros_cobros.updated_at','like', date("Y-m-d").'%' )
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
            'otros_pagos.updated_at as created_at')
        ->whereNotIn('tipos_pago.id', [2])
        ->where('otros_pagos.estado','=', 8)
        ->whereBetween(DB::raw('DATE(otros_pagos.updated_at)'),[ $fecha1_c, $fecha2_c])

       // ->where('otros_pagos.updated_at','like', date("Y-m-d").'%' )
        ->orderBy('otros_pagos.updated_at', 'desc')
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
            'pagos_ordenanza.updated_at as created_at')
        ->whereNotIn('tipos_pago.id', [2])
        ->where('pagos_ordenanza.estado','=', 8)
        //->where('pagos_ordenanza.updated_at','like', date("Y-m-d").'%' )
        ->whereBetween(DB::raw('DATE(pagos_ordenanza.updated_at)'),[ $fecha1_c, $fecha2_c])

        ->orderBy('pagos_ordenanza.updated_at', 'desc')
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
            'otros_cobros.updated_at as created_at')
       //->where('otros_cobros.updated_at','like', date("Y-m-d").'%' )
       ->whereBetween(DB::raw('DATE(otros_cobros.updated_at)'),[ $fecha1_c, $fecha2_c])

       
        ->where('otros_cobros.estado','=',8)

        ->get();



    $especie = Especies::where('estado','=','1')
        //->where('updated_at','like', date("Y-m-d").'%' )
        ->whereBetween(DB::raw('DATE(updated_at)'),[ $fecha1_c, $fecha2_c])

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




    public function ReporteNoEmitidos(Request $request ){
       
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
        ->leftJoin('formaspago', 'formaspago.id', 'otros_pagos.formaPago_id')
        ->select(   'ruc',
            'razonSocial',
            'formaspago.nombre as formaspago',
            'valor',
            'referencia',
            'telefono',
            'email',
           'otros_pagos.year_now',
           'otros_pagos.numPermisoFuncionamiento',
           'otros_pagos.numTransaccion',
           'otros_pagos.numTituloAdmin',
           'valor','otros_pagos.recargo',
            'otros_pagos.updated_at as created_at')
        ->whereIn('otros_pagos.estado', [4,7])
       // ->where('otros_pagos.estado','=', 4)
        ->whereBetween(DB::raw('DATE(otros_pagos.updated_at)'),[ $fecha1_c, $fecha2_c])
        ->orderBy('client.updated_at', 'desc')
        ->get();
      

   




    $doc = "NO EMITIDOS";
    $pdf = PDF::loadView('report/reporteNoEmitidos' , [
                                                "reporte" => $reporte,
                                                "rangos" => $rangos
                                            ])->setPaper('A4');
    return $pdf->stream($doc . '.pdf');
    
    
    }



    
    public function ReporteFechaPorParroquias(Request $request ){
       
        $fechas = $request->input('reservation');
        $parroquia_id = $request->input('parroquia');

      
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
       
        ->join('parroquias', 'parroquias.id', 'client.parroquia_id')
        ->select(   'ruc',
            'razonSocial',
           
            'valor',
            'referencia',
            'telefono',
            'email',
            'barrio',
            'parroquias.descripcion as parroquia',
           'otros_pagos.year_now',
           'otros_pagos.numPermisoFuncionamiento',
           'otros_pagos.numTransaccion',
           'otros_pagos.numTituloAdmin',
           'valor','otros_pagos.recargo',
            'otros_pagos.updated_at as created_at')
       // ->whereNotIn('tipos_pago.id', [2])
        ->where('otros_pagos.estado','=', 8)
        ->where('client.parroquia_id','=',$parroquia_id)
        ->whereBetween(DB::raw('DATE(otros_pagos.updated_at)'),[ $fecha1_c, $fecha2_c])
        ->orderBy('parroquias.descripcion', 'desc')
        ->orderBy('client.updated_at', 'desc')
       
        ->get();
      

   




    $doc = "POR PARROQUIAS";
    $pdf = PDF::loadView('report/reportefechaPorParroquia' , [
                                                "reporte" => $reporte,
                                                "rangos" => $rangos
                                            ])->setPaper('B5');
    return $pdf->stream($doc . '.pdf');
    
    
    }
   

    public function reporteContadorSemanal( $tipe , $fechaInicial , $fechaFinal) {
   

        $array = [ "tipe" => $tipe,  "fechaInicial"  => date("Y-m-d", strtotime($fechaInicial) ),    "fechaFinal"    => date("Y-m-d", strtotime($fechaFinal) )       ];



        if( $tipe == 'ccdiarios' ) {
           $this->reporte1();
        }elseif ( $tipe == 'remitidos' ) {

            $this->reporte4();
        }elseif( $tipe== 'permisos' ) {
            $this->reporte5();
        }elseif( $tipe == 'parroquias' ) {
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
                'otros_pagos.updated_at as created_at'
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




    }

    }
