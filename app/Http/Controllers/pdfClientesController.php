<?php

namespace App\Http\Controllers;

use App\Requerimientos;
use App\System;
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
            ->select(   'requerimientos.*','det_requerimientos.*' )
            ->where('det_requerimientos.client_id',$id)
            ->get();
        $client = DB::table('client')
            ->join('parroquias','parroquias.id','client.parroquia_id')
            ->join('riesgos','riesgos.id','client.riesgo_id')
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
                ,'client.email'
                ,'client.decripcion as  descripcion'
                ,'riesgos.descripcion as riesgo'
                ,'categorias.descripcion as categoria'
                ,'denominaciones.descripcion as denominacion'
                 ,'client.estado'
                 ,'client.inspector_id'
            )->where('client.id', $id)
            ->get();

        $fotosLocal = DB::table('fotos_local')
            ->join('client','client.id','fotos_local.client_id')
            ->select(   'fotos_local.path' )
            ->where('client.id',$id)
            ->get();
        $inspector = DB::table('users')->select(   'nombre','apellido' )->where('id',$client[0]->inspector_id) ->get();

         //return view('formulario-cliente-pdf', compact('data','client','requerimientos','fotosLocal','inspector'));
        $doc = "Formulario de Inspección";
        $pdf = PDF::loadView('formulario-cliente-pdf' ,[
                                                                'data' => $data ,
                                                                'client' => $client,
                                                                'requerimientos' => $requerimientos,
                                                                'fotosLocal' => $fotosLocal,
                                                                'inspector' => $inspector
                                                             ]);
        return $pdf->stream($doc.'.pdf');
    }
}
