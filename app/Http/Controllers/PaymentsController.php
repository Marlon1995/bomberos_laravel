<?php

namespace App\Http\Controllers;

use App\AuditoriaModel;
use App\Mail\MailTrap;
use App\PagosTasasModel;
use App\OtrosPagosModel;
use App\Client;
use App\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade as PDF;


class PaymentsController extends Controller
{

    function __construct()
    {
        $this->middleware(['authUser', 'roles:3,5']);
    }


    public function index()
    {
        $pagos = DB::table('client')
            ->join('pagos_tasas', 'pagos_tasas.client_id', 'client.id')
            ->join('tasa_anual', 'tasa_anual.id', 'pagos_tasas.tasa_anual_id')
            ->leftJoin('otros_pagos', 'otros_pagos.client_id', 'client.id')
            ->select('client.id', 'client.ruc', 'client.razonSocial', 'client.representanteLegal', 'tasa_anual.valTasaAnual',
                'otros_pagos.valor',
                'otros_pagos.tipoPago')
            ->get();
        $clients = DB::table('client', 'cli')
            /* ->join('denominaciones', 'cli.denominacion_id', 'denominaciones.id') */
            /* ->join('categorias', 'cli.categoria_id', 'categorias.id') */
            /* ->join('riesgos', 'cli.riesgo_id', 'riesgos.id') */
            ->leftJoin('otros_pagos', function ($lj) {
                $lj->on('otros_pagos.client_id', '=', 'cli.id')
                    ->where('otros_pagos.tipoPago', '<>', 3);
            })
            ->join('pagos_tasas', 'pagos_tasas.client_id', 'cli.id')
            ->join('tasa_anual', 'pagos_tasas.tasa_anual_id', 'tasa_anual.id')
            ->select('cli.id'
                , 'cli.ruc'
                , 'cli.razonSocial'
                , 'cli.representanteLegal'
                /* , 'denominaciones.descripcion as denominacion' */
                /* , 'categorias.descripcion as categorias' */
                /* , 'riesgos.descripcion as riesgo' */
                , 'cli.estado'
                , 'tasa_anual.valTasaAnual'
            )
            ->orderBy('cli.id', 'DESC')
            ->get();


        $impuestos = DB::table('client')
            /* ->join('categorias', 'categorias.id', 'client.categoria_id') */
            /* ->join('denominaciones', 'denominaciones.id', 'client.denominacion_id') */
            ->join('parroquias', 'parroquias.id', 'client.parroquia_id')
            ->select('client.id', 'client.razonSocial', 'client.representanteLegal', 'client.ruc', 'client.barrio', 'client.telefono', 'parroquias.descripcion as parroquia', 'client.referencia'/* , 'categorias.descripcion as categoria' *//* , 'denominaciones.descripcion as denominacion' */)
            ->whereIn('client.estado', [7])
            ->get();

        $formasPago = DB::table('formaspago')
            ->select('id', 'nombre')
            ->whereIn('estado', [2])
            ->orderBy('nombre', 'asc')
            ->get();


        $data = System::all();
        return view('payments', compact('data', 'pagos', 'clients', 'impuestos', 'formasPago'));
    }

    public function update(Request $request, $id_)
    {


        $tipoPago = $request->input('tipoPago');
        $anio = date('Y');

        if ($tipoPago == 1) {
            // 1 es anticipo
            $valor__tbPagos = $request->input('valor__tbPagos');
            $id = $request->input('cliend_ida');
            $decripcion_mp = $request->input('decripcion_mp');
            $numTransaccion = $request->input('numTransaccion');
            $formaPago_id = $request->input('formaPago');

            if ($valor__tbPagos == 0 || $numTransaccion == 0) {
                return back()->with('Respuesta_erro', 'Verifique la información ingresada y reintente!!');
            }

            $anio = date('Y');

            $send = new OtrosPagosModel();
            $send->client_id = $id;
            $send->tipoPago = 1;
            $send->year_now = $anio;
            $send->valor = $valor__tbPagos;
            $send->descripcion = $decripcion_mp;
            $send->formaPago_id = $formaPago_id;
            $send->numTransaccion = $numTransaccion;
            $send->estado = 8;
            $send->save();


            $auditoria = new AuditoriaModel();
            $auditoria->user_id = auth()->user()->id;
            $auditoria->role_id = auth()->user()->role->id;
            $auditoria->modulo = 'Pago Solicitud anticupo';
            $auditoria->descripcion = 'Genera el pago de la SOLICITUD DE ANTICIPO del cliente_id: ' . $id . ',valor: ' . $valor__tbPagos . ', numtransaccion ' . $numTransaccion . ', dscrpcion ' . $decripcion_mp;
            $auditoria->accion = 'Pago de anticipo';
            $auditoria->valor = $valor__tbPagos;
            $auditoria->created_at = Carbon::now();
            $auditoria->save();


            $client = DB::table('client')->select('ruc', 'razonSocial', 'representanteLegal', 'ruc', 'email')->where('id', $id)->get();

            $formasPago = DB::table('formaspago')
                ->select('id', 'nombre')
                ->whereIn('estado', [2])
                ->whereIn('id', [$formaPago_id])
                ->get();


            $body = array(
                "asunto" => "COMPROBANTE DE PAGO",
                "titulo" => "PAGO DE SOLICITUD DE ANTICIPO DE IMPUESTO DE TASA ANUAL",
                "para" => "Estimado(a). " . strtoupper($client[0]->representanteLegal),
                "mensaje" => "Ud, a realizado el pago de ANTICIPO AL IMPUESTO ANUAL a la RAZÓN SOCIAL " . strtoupper($client[0]->razonSocial) . ", con RUC: " . strtoupper($client[0]->ruc) . " el valor de $" . $valor__tbPagos . ' en ' . $formasPago[0]->nombre,
                "posdata" => "Saludos cordiales, Atentamente.",
                "de" => auth()->user()->nombre . ' ' . auth()->user()->apellido,
                "rol" => auth()->user()->role->role,
                "miCorreo" => auth()->user()->email,
                "telefono" => auth()->user()->telefono,
                "sistema" => "CUERPO DE BOMBEROS ATACAMES"
            );

            Mail::to($client[0]->email)->send(new MailTrap($body));

            return back()->with('Respuesta', 'Se genero el PAGO DE ANTICIPO correctamente.(IMPRECIÓN DE COMPROBANTES EN COLA)');
        } else

            if ($tipoPago == 2) {


                $file = $request->file('documentoRespaldo');
                $docRespaldo = time() .'documentoRespaldo';
                $file->move(public_path(). '/dicumentosRespaldo/', $docRespaldo);







                 // dos es descuento
                $valor__tbPagos = floatval ($request->input('valor__tbPagos'));
               // dd($valor__tbPagos);







                $id = $request->input('cliend_idmp');
                $decripcion_mp = $request->input('decripcion_mp');



                $anio = date('Y');







                $send = new OtrosPagosModel();
                $send->client_id = $id;
                $send->tipoPago = 2;
                $send->year_now = $anio;
                $send->valor = $valor__tbPagos;
                $send->docRespaldo = $docRespaldo;
                $send->descripcion = $decripcion_mp;
                $send->estado = 8;
                $send->save();


                $client = DB::table('client')->select('ruc', 'razonSocial', 'representanteLegal', 'ruc', 'email')->where('id', $id)->get();

                $body = array(
                    "asunto" => "ASUNTO",
                    "titulo" => "SOLICITUD DE PAGO DE DESCUENTO",
                    "para" => "Sr(a). " . strtoupper($client[0]->representanteLegal),
                    "mensaje" => "Su solicitud de DESCUENTO para la Razón Social: " . strtoupper($client[0]->razonSocial) . " con RUC: " . strtoupper($client[0]->ruc) . " ha sido procesada correctamente, el valor descontado es de $ " . $valor__tbPagos . ' por motivo de ' . $decripcion_mp . '.',
                    "posdata" => "Saludos cordiales, Atentamente.",
                    "de" => auth()->user()->nombre . ' ' . auth()->user()->apellido,
                    "rol" => auth()->user()->role->role,
                    "miCorreo" => auth()->user()->email,
                    "telefono" => auth()->user()->telefono,
                    "sistema" => "CUERPO DE BOMBEROS ATACAMES"
                );

                Mail::to($client[0]->email)->send(new MailTrap($body));


                $auditoria = new AuditoriaModel();
                $auditoria->user_id = auth()->user()->id;
                $auditoria->role_id = auth()->user()->role->id;
                $auditoria->modulo = 'Impuesto';
                $auditoria->descripcion = 'Genrea una SOLICITUD DE PAGO DE DESCUENTO del cliente_id: ' . $id . ' con valor: $ ' . $valor__tbPagos . ' como pagado por motivo ' . $decripcion_mp;
                $auditoria->accion = 'Pago de descunto';
                $auditoria->valor = $id;
                $auditoria->created_at = Carbon::now();
                $auditoria->save();


                //$imprecion= PDF::loadView('imprecion/imprecion');
                //return $imprecion->download('imprecion.pdf');

                return back()->with('Respuesta', 'Se a generado la SOLICITUD DE PAGO DE DESCUENTO correctamente. (IMPRECIÓN DE COMPROBANTES EN COLA)');

            } else

                if ($tipoPago == 3) {
                    /// 3 es pago total



                    $valor__tbPagos = $request->input('valor__tbPagos');
                    $id = $request->input('cliend_ida');
                    $decripcion_mp = $request->input('decripcion_mp_1');
                    $numTransaccion = $request->input('numTransaccion');
                    $numTransaccion = $request->input('numTransaccion');
                    $formaPago_id = $request->input('formaPago');
                    $recargo = $request->input('recargo_valor');
             
                    $numPermisoFuncionamiento = $request->input('numPermisoFuncionamiento');
                    $numTituloAdmin = $request->input('numTituloAdmin');

                    if($formaPago_id != 1 && $numTransaccion == 0 ){
                        return back()->with('Respuesta_wn', 'El número de transaccion es requerida');

                    }

                    $anio = date('Y');
                    $send = new OtrosPagosModel();
                    $send->client_id = $id;
                    $send->tipoPago = 3;
                    $send->year_now = $anio;
                    $send->recargo= $recargo;
                    $send->valor = ($valor__tbPagos + 2);
                    $send->numPermisoFuncionamiento = $numPermisoFuncionamiento;
                    $send->numTituloAdmin = $numTituloAdmin;
                

                    if($numTransaccion != 0 ){
                        $send->numTransaccion = $numTransaccion;
                    }

                    if($numTituloAdmin != 0 ){
                        $send->numTituloAdmin = $numTituloAdmin;
                    }
                    $send->descripcion = $decripcion_mp;
                    $send->formaPago_id = $formaPago_id;
                    $send->estado = 8;
                    $send->save();


                    DB::table('pagos_tasas')
                        ->where('client_id', $id)
                        ->where('estado', '=', 7)
                        ->update([
                            'estado' => 8, // pago total
                            'updated_at' => Carbon::now()
                        ]);


                    DB::table('client')
                        ->where('id', $id)
                        ->where('estado', '=', 7)
                        ->update([
                            'estado' => 8, // pago total
                            'updated_at' => Carbon::now()
                        ]);


                    $auditoria = new AuditoriaModel();
                    $auditoria->user_id = auth()->user()->id;
                    $auditoria->role_id = auth()->user()->role->id;
                    $auditoria->modulo = 'Pago Total Generado';
                    $auditoria->descripcion = 'Genera el pago Total del impuesto de tasa anual, cliente_id: ' . $id . ' y cambia a estado 8 que es pagado 100%, e inserta el valor pagado  $ ' . ($valor__tbPagos+2) . ' en';
                    $auditoria->accion = 'Pago Total';
                    $auditoria->valor = $id;
                    $auditoria->created_at = Carbon::now();
                    $auditoria->save();

                    $formasPago = DB::table('formaspago')
                        ->select('id', 'nombre')
                        ->whereIn('estado', [2])
                        ->whereIn('id', [$formaPago_id])
                        ->get();

                    $info_cli = DB::table('client')->select('*')->where('id', '=', $id)->get();

                    $body = array(
                        "asunto" => "COMPROBANTE DE PAGO",
                        "titulo" => "PAGO TOTAL DE IMPUESTO DE TASA ANUAL",
                        "para" => "Estimado(a). " . strtoupper($info_cli[0]->representanteLegal),
                        "mensaje" => "Ud, a realizado el pago TOTAL DEL IMPUESTO DE TASA ANUAL de la RAZÓN SOCIAL " . strtoupper($info_cli[0]->razonSocial) . ", con RUC: " . $info_cli[0]->ruc . " el valor de $" . $valor__tbPagos . ' en ' . $formasPago[0]->nombre.' y $2.00 del valor de la especie, valido hasta el 31 de diciembre del ', date('Y'),
                        "posdata" => "Saludos cordiales, Atentamente.",
                        "de" => auth()->user()->nombre . ' ' . auth()->user()->apellido,
                        "rol" => auth()->user()->role->role,
                        "miCorreo" => auth()->user()->email,
                        "telefono" => auth()->user()->telefono,
                        "sistema" => "CUERPO DE BOMBEROS ATACAMES"
                    );


                    Mail::to($info_cli[0]->email)->send(new MailTrap($body));


                    return back()->with('Respuesta', 'Se realizo el Pago TOTAL IMPUESTO ANUAL. (IMPRECIÓN DE COMPROBANTES EN COLA)');
                }
    }


     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $client = Client::where('id','=', $id)->select('id')->get();
        
        PagosTasasModel::where('client_id','=', $client[0]->id)
                       ->where("estado",7)
                       ->delete();

        OtrosPagosModel::where('client_id','=', $client[0]->id)
                       ->whereIn("tipoPago",[3,6])
                       ->whereIn("estado",[7,8])
                       ->delete();


        DB::table('client')->where('id', $id)->update([
            'estado' => 4,
            'updated_at'  => Carbon::now()
        ]);
 



        $auditoria = new AuditoriaModel();
        $auditoria->user_id = auth()->user()->id;
        $auditoria->role_id = auth()->user()->role->id;
        $auditoria->modulo  = 'Pago Solicitud ANULADO';
        $auditoria->descripcion = 'Elimina pago  la SOLICITUD DE ANTICIPO del cliente_id: ' . $id;
        $auditoria->accion      = 'ANULAR PAGO';
        $auditoria->valor       = $id;
        $auditoria->created_at  = Carbon::now();
        $auditoria->save();
        

        return back()->with('Respuesta','EL PAGO FUE ANULADO!!.');
    
    }
}

