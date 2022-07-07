<?php

namespace App\Http\Controllers;

use App\AuditoriaModel;
use App\Mail\MailTrap;
use App\OtrosPagosModel;
use App\PagosTasasModel;
use App\System;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PerisoFuncionamientoController extends Controller
{


    function __construct() {
        $this->middleware(['authUser','roles:3']);
    }


    public function index(){
        $data = System::all();
        $clients = DB::table('client', 'cli')
            ->join('denominaciones', 'cli.denominacion_id', 'denominaciones.id')
            ->join('categorias', 'cli.categoria_id', 'categorias.id')
            ->join('riesgos', 'cli.riesgo_id', 'riesgos.id')
            ->select('cli.id'
                , 'cli.ruc'
                , 'cli.razonSocial'
                , 'cli.representanteLegal'
                , 'cli.parroquia_id'
                , 'cli.barrio'
                , 'cli.telefono'
                ,'cli.updated_at'
                , 'cli.referencia'
                , 'cli.categoria_id'
                , 'cli.riesgo_id'
                , 'cli.denominacion_id'
                , 'cli.tipoFormulario'
                , 'denominaciones.descripcion as denominacion'
                , 'categorias.descripcion as categorias'
                , 'riesgos.descripcion as riesgo'
                , 'cli.estado'
            )
            ->where('cli.estado', '=', 8)
            ->orderBy('cli.razonSocial', 'ASC')
            ->get();


        return view('permisos', compact('data', 'clients'));
    }

    public function pdf($id) {
        $client = DB::table('client', 'cli')
            ->join('parroquias','cli.parroquia_id','parroquias.id')
            ->join('denominaciones', 'cli.denominacion_id', 'denominaciones.id')
            ->join('categorias', 'cli.categoria_id', 'categorias.id')
            ->join('riesgos', 'cli.riesgo_id', 'riesgos.id')
            ->select('cli.id'
                , 'cli.ruc'
                , 'cli.razonSocial'
                , 'cli.representanteLegal'
                , 'parroquias.descripcion as parroquia'
                , 'cli.barrio'
                , 'cli.telefono'
                , 'cli.referencia'
                , 'cli.categoria_id'
                , 'cli.riesgo_id'
                , 'cli.denominacion_id'
                , 'cli.tipoFormulario'
                , 'denominaciones.descripcion as denominacion'
                , 'categorias.descripcion as categorias'
                , 'riesgos.descripcion as riesgo'
                , 'cli.estado'
            )
            ->where('cli.id', '=', $id)->get();

        $anticipos = DB::table('client')
            ->join('otros_pagos',  'otros_pagos.client_id' , 'client.id')
            ->select( DB::raw('sum(otros_pagos.valor) as anticipos' ))
            ->where('client.id','=',$id)
            ->where('otros_pagos.estado','=',8)
            ->where('otros_pagos.tipoPago','=',1)
            ->get();

        $descuentos = DB::table('client')
            ->join('otros_pagos',  'otros_pagos.client_id' , 'client.id')
            ->select('otros_pagos.descripcion as descripcion')
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



        $tasas= array(
            array(
                "TasaAnual"         => (empty($TasaAnual[0]->TasaAnual)) ? 0 : round($TasaAnual[0]->TasaAnual,5),
            )
        );

        $numPermisoFuncionamiento = DB::table('otros_pagos')
             ->select( 'numPermisoFuncionamiento as name')
            ->where('client_id', '=', $id)
            ->where('tipoPago', '=', 3)
            ->where('estado', '=', 8)
            ->get();


        $auditoria = new AuditoriaModel();
        $auditoria->user_id = auth()->user()->id;
        $auditoria->role_id  = auth()->user()->role->id;
        $auditoria->modulo      = 'Permiso';
        $auditoria->descripcion = 'Genera el permiso de funcionamiento de la razon Social: '.$client[0]->razonSocial.' con ruc '.$client[0]->ruc.' del permiso '.$id;
        $auditoria->accion      = 'GENERA PERMISO DE FUNCIONAMIENTO';
        $auditoria->valor       = $id;
        $auditoria->created_at  = Carbon::now();
        $auditoria->save();





//        return view('permiso-funcionamiento', compact('client','client','numPermisoFuncionamiento'));
        $doc = "Permiso de Funcionamiento";
        $pdf = PDF::loadView('permiso-funcionamiento', ['client' => $client,
                                                        'tasas' => $tasas,
                                                        'numPermisoFuncionamiento' => $numPermisoFuncionamiento
                                                        ,'descuentos'=> $descuentos]);


        return $pdf->stream($doc . '.pdf');


    }


   


    public function show($id) {


        $generarPago = DB::table('client','cli')
            ->join('tasa_anual',  [
                                            'cli.categoria_id' => 'tasa_anual.categoria_id',
                                            'cli.riesgo_id' => 'tasa_anual.riesgo_id' ,
                                            'cli.denominacion_id' => 'tasa_anual.denominacion_id' ])
            ->select('cli.id as cliente_id','tasa_anual.id as tasas_anual_id','tasa_anual.valTasaAnual as valor','cli.id', 'cli.ruc','cli.razonSocial','cli.representanteLegal','cli.email')
            ->where('cli.id', $id)
            ->get();

        $anio= date('Y');
        $mes = date("m");
        $mes = $mes-1;

        $valorFechaRegistro = ($generarPago[0]->valor / 12) * $mes;

        //$valorCalculado = $generarPago[0]->valor - $valorFechaRegistro;
        $valorCalculado = $generarPago[0]->valor;

        $obj = new PagosTasasModel();  
        $obj->client_id     = $generarPago[0]->cliente_id;
        $obj->tasa_anual_id = $generarPago[0]->tasas_anual_id;
        $obj->estado        = 7; // pago tasa anual pendiente
        $obj->save();

        $send = new OtrosPagosModel();
        $send->client_id = $generarPago[0]->cliente_id;
        $send->tipoPago  = 3; // TOTAL
        $send->year_now  = $anio;
        $send->valor     = $valorCalculado;
        $send->estado    = 7; // estado pendiente
        $send->save();


        $send = new OtrosPagosModel();
        $send->client_id = $generarPago[0]->cliente_id;
        $send->tipoPago  = 6;
        $send->year_now  = $anio;
        $send->valor     = $valorCalculado;
        $send->estado    = 8; //pagado
        $send->save();


        
        $auditoria = new AuditoriaModel();
        $auditoria->user_id = auth()->user()->id;
        $auditoria->role_id  = auth()->user()->role->id;
        $auditoria->modulo      = 'Genera Pago';
        $auditoria->descripcion = 'Genera el valor de tasa anual para la razon Social: '.$generarPago[0]->razonSocial.' con ruc '.$generarPago[0]->ruc.' el valor de de tasa anual: $'.$valorCalculado.', para el cliente_id '.$generarPago[0]->cliente_id.', con id '.$generarPago[0]->id;
        $auditoria->accion      = 'GENERA PAGO TASA ANUAL';
        $auditoria->valor       = $id;
        $auditoria->created_at  = Carbon::now();
        $auditoria->save();


        $body = array(
            "asunto" => "ASUNTO",
            "titulo" => "SOLICITUD DE PAGO DE TASA ANUAL",
            "para" => "Sr(a). ".$generarPago[0]->representanteLegal,
            "mensaje" => "La solicitud de pago de impuesto de TASA ANUAL para la Razón Social: " . $generarPago[0]->razonSocial . " con RUC: " . $generarPago[0]->ruc . " ha sido generada correctamente, se le recuerda que tiene que cancelar el valor de $ ".$valorCalculado.' en las oficinas del CUERPO DE BOMBEROS DEL CANTÓN ATACAMES, impuesto valido hasta el 31 diciembre de '.$anio,
            "posdata" => "Saludos cordiales, Atentamente.",
            "de" => auth()->user()->nombre . ' ' . auth()->user()->apellido,
            "rol" => auth()->user()->role->role,
            "miCorreo" => auth()->user()->email,
            "telefono" => auth()->user()->telefono,
            "sistema" => "CUERPO DE BOMBEROS ATACAMES"
        );



//        Mail::to($generarPago[0]->email)->send(new MailTrap($body));


        DB::table('client')->where('id', $id)->update([
            'estado' => 7, // Se a generado la solicitud de pago del permiso de funcionamiento correctamente
            'updated_at'  => Carbon::now()
        ]);

        return back()->with('Respuesta', 'Se a generado la solicitud de pago del permiso de funcionamiento correctamente.');
    }

}
