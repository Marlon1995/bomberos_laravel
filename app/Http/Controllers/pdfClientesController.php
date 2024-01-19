<?php

namespace App\Http\Controllers;

use App\System;
use App\Inspecciones_sec;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class pdfClientesController extends Controller
{
    public function index(){
        return redirect('/');
    }

    public function show($id) {
        $data = System::all();
        $requerimientos = DB::table('requerimientos')
            ->join('det_requerimientos','requerimientos.id','det_requerimientos.requerimiento_id')
            ->select('requerimientos.*','det_requerimientos.*')
            ->where('det_requerimientos.client_id',$id)
            ->get();

        /* CODIGO JACXIMIR INICIO*/
        $inspecciones = DB::table('inspecciones')
            ->join('requerimientos','inspecciones.requerimiento_id','requerimientos.check_id')
            ->select('inspecciones.*','requerimientos.*')
            ->where('inspecciones.client_id',$id)
            ->get();

        /* CODIGO JACXIMIR FINAL */

        $client = DB::table('client')
            ->join('parroquias','parroquias.id','client.parroquia_id')
            /* ->join('riesgos','riesgos.id','client.riesgo_id') */
            /* ->join('categorias','categorias.id','client.categoria_id') */
            /* ->join('denominaciones','denominaciones.id','client.denominacion_id') */
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
                ,'client.email'
                ,'client.decripcion as  descripcion'
                /* ,'riesgos.descripcion as riesgo' 
                ,'categorias.descripcion as categoria'
                ,'denominaciones.descripcion as denominacion'*/
                 ,'client.estado'
                 ,'client.inspector_id'
            )->where('client.id', $id)
            ->get();

        $fotosLocal = DB::table('fotos_local')
            ->join('client','client.id','fotos_local.client_id')
            ->select(   'fotos_local.path' )
            ->where('client.id',$id)
            ->get();

        $inspecciones_sec = DB::table('inspecciones_sec')
            ->select('inspecciones_sec.riesgo','inspecciones_sec.observacion','inspecciones_sec.valor_bci','inspecciones_sec.valor_sis')
            ->where('client_id',$id)
            ->get();
            
        $inspector = DB::table('users')->select('nombre','apellido' )->where('id',$client[0]->inspector_id) ->get();


       $doc = "Formulario de Inspección";
        $pdf = PDF::loadView('formulario-cliente-pdf' ,[
                                                                'data' => $data ,
                                                                'client' => $client,
                                                                'requerimientos' => $requerimientos,
                                                                'fotosLocal' => $fotosLocal,
                                                                'inspector' => $inspector,
                                                                'inspecciones' => $inspecciones,
                                                                'inspecciones_sec' => $inspecciones_sec,
                                                             ]);
                                                             
        return $pdf->stream($doc, compact('data','client','requerimientos','fotosLocal','inspector','inspecciones','inspecciones_sec'));
       // return view('formulario-cliente-pdf', );
        
    }
}
