<?php

namespace App\Http\Controllers;

use App\AuditoriaModel;
use App\Client;
use App\Exports\ClientExport;
use App\Mail\MailTrap;
use App\Requerimientos;
use App\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class ClientsController extends Controller {

    function __construct() {
        $this->middleware(['authUser','roles:3,4']);
    }

    public function index(){
        $est_activo = 2;

        $data = System::all();

        $sector = DB::table('parroquias' ,'p')
                            ->select('p.id', 'p.descripcion')
                            ->where('p.estado', $est_activo)
                            ->orderBy('p.descripcion','ASC')
                            ->get();
        $denominacion  = DB::table('denominaciones', 'd')->select('d.id', 'd.descripcion')->where('d.estado', $est_activo)->orderBy('d.descripcion','ASC')->get();
        $categoria     = DB::table('categorias', 'cat')->select('cat.id', 'cat.descripcion')->where('cat.estado', $est_activo)->orderBy('cat.descripcion','ASC')->get();
        $riego         = DB::table('riesgos' ,'r')->select('r.id', 'r.descripcion')->where('r.estado', $est_activo)->orderBy('r.descripcion','ASC')->get();
        $pagos         = DB::table('client')
                        ->join('otros_pagos','otros_pagos.client_id', '=', 'client.id')
                        ->get();
//dd($pagos);
        if( auth()->user()->role_id == 3 ) {

            $clients = DB::table('client', 'cli')
                ->join('denominaciones', 'cli.denominacion_id', 'denominaciones.id')
                ->join('categorias', 'cli.categoria_id', 'categorias.id')
                ->join('otros_pagos', 'otros_pagos.client_id', '=', 'cli.id')
                ->select('cli.id'
                    , 'cli.ruc'
                    , 'cli.razonSocial'
                    , 'cli.representanteLegal'
                    , 'cli.parroquia_id'
                    , 'cli.telefono'
                    , 'cli.referencia'
                    , 'cli.categoria_id'
                    , 'cli.denominacion_id'
                    , 'cli.tipoFormulario'
                    , 'denominaciones.descripcion as denominacion'
                    , 'categorias.descripcion as categorias'
                    , 'otros_pagos.year_now as anio'
                    , 'cli.estado'
                )
                ->whereNotIn('cli.estado', [1])
                ->orderBy('cli.razonSocial', 'ASC')
                ->get();


        }else {
            $clients = DB::table('client', 'cli')
                ->join('denominaciones', 'cli.denominacion_id', 'denominaciones.id')
                ->join('categorias', 'cli.categoria_id', 'categorias.id')
                ->join('otros_pagos', 'otros_pagos.client_id', '=', 'cli.id')
                ->select('cli.id'
                    , 'cli.ruc'
                    , 'cli.razonSocial'
                    , 'cli.representanteLegal'
                    , 'cli.parroquia_id'
                    , 'cli.telefono'
                    , 'cli.referencia'
                    , 'cli.categoria_id'
                    , 'cli.denominacion_id'
                    , 'cli.tipoFormulario'
                    , 'denominaciones.descripcion as denominacion'
                    , 'categorias.descripcion as categorias'
                    , 'otros_pagos.year_now as anio'
                    , 'cli.estado'
                )
                ->whereNotIn('cli.estado', [1, 8])
                ->orderBy('cli.razonSocial', 'ASC')
                ->get();

        }

        return view( 'clients' , compact('data','sector','denominacion','categoria','clients','riego','pagos') );
    }

    public function store(Request $request) {
        $this->validate($request , [
            'razonSocial' => "required",
            'ruc'   => "required",
            'representanteLegal' => "required",
            'telefono' => "required",
            'referencia' => "required",
            ]);

        $send = new Client();
        $send->tipoFormulario       =  $request->input('tipoInspecion');
        $send->razonSocial          =  $request->input('razonSocial');
        $send->ruc                  =  $request->input('ruc');
        $send->representanteLegal   =  $request->input('representanteLegal');
        $send->parroquia_id         =  $request->input('parroquia');
        $send->barrio               =  $request->input('barrio');
        $send->telefono             =  $request->input('telefono');
        $send->email             =  $request->input('email');
        $send->referencia           =  $request->input('referencia');
        $send->categoria_id         =  $request->input('categoria');
        $send->denominacion_id      =  $request->input('actividad');
        $send->inspector_id     = auth()->user()->id;
        $send->estado               =  2; // ESTADO ACTIVADO
        $send->save();

        $auditoria = new AuditoriaModel();
        $auditoria->user_id = auth()->user()->id;
        $auditoria->role_id  = auth()->user()->role->id;
        $auditoria->modulo      = 'Usuarios';
        $auditoria->descripcion = 'Ingresa la informacion principal del formulario de inspeccion de razon social '.$request->input('razonSocial');
        $auditoria->accion      = 'INGRESA NEUVO FORMULARIO';
        $auditoria->valor       = $request->input('ruc');
        $auditoria->created_at  = Carbon::now();
        $auditoria->save();

        return back()->with('Respuesta','Se ingreso el la información principal del FORMULARIO DE INSPECCIÓN, correctamente.');
    }
    public function show($id) {

        $data = System::all();
        $riego = DB::table('tasa_anual')
            ->join('client',  [
                'client.denominacion_id' => 'tasa_anual.denominacion_id',
                'client.categoria_id'    => 'tasa_anual.categoria_id' ])
            ->join('riesgos','riesgos.id' ,'tasa_anual.riesgo_id')
            ->select('riesgos.id','riesgos.descripcion')
            ->where('client.id', $id)
            ->groupBy('riesgos.id','riesgos.descripcion')
            ->get();

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
        return view( 'formulario' , compact('data','client','requerimientos' , 'riego') );
    }
    public function update(Request $request, $id){
        $caso = $request->input('caso');

        if( $caso =='update_emitir') {

            DB::table('client')->where('id', $id)->update([
                'estado' => 4,
                'updated_at'  => Carbon::now()
            ]);


            $client = DB::table('client')->select('ruc', 'razonSocial','representanteLegal','email')->where('id', $id)->get();
            $body = array(
                "asunto" => "ASUNTO",
                "titulo" => "FORMULARIO DE RE-INSPECCIÓN ",
                "para" => "Estimado(a) ".strtoupper($client[0]->representanteLegal),
                "mensaje" => "Sé ha realizado la respectiva  re-inspección  de la Razón Social " . strtoupper($client[0]->razonSocial ). " con RUC: " . $client[0]->ruc . ", le recordamos que debe acercarse a las oficinas de administración del CUERPO DE BOMBEROS ATACAMES para la respectiva solicitud y pago del permiso de funcionamiento",
                "posdata" => "Saludos cordiales, Atentamente.",
                "de" => auth()->user()->nombre . ' ' . auth()->user()->apellido,
                "rol" => auth()->user()->role->role,
                "miCorreo" => auth()->user()->email,
                "telefono" => auth()->user()->telefono,
                "sistema" => "CUERPO DE BOMBEROS ATACAMES"
            );
            Mail::to($client[0]->email)->send(new MailTrap($body));

            $users = DB::table('users')
                ->join('roles', 'roles.id','=','users.role_id')
                ->select('users.nombre', 'users.apellido','users.email', 'users.role_id')
                ->whereIn('roles.id',[3,7,8])
                ->where('users.estado','=','2')

                ->get();


            foreach ( $users as $item){

                if( $item->role_id == 3 ){
                    $body = array(
                        "asunto" => "ASUNTO",
                        "titulo" => "FORMULARIO DE RE-INSPECCIÓN ",
                        "para" => "Estimado(a) Secretario(a), ".strtoupper($item->nombre.' '.$item->apellido),
                        "mensaje" => "Sé notifica que realizo la respectiva re-inspección de la Razón Social " . strtoupper($client[0]->razonSocial)." con RUC: " . $client[0]->ruc.' para que continúe con el respectivo proceso que le compete',
                        "posdata" => "Saludos cordiales, Atentamente.",
                        "de" => auth()->user()->nombre . ' ' . auth()->user()->apellido,
                        "rol" => auth()->user()->role->role,
                        "miCorreo" => auth()->user()->email,
                        "telefono" => auth()->user()->telefono,
                        "sistema" => "CUERPO DE BOMBEROS ATACAMES. Todos los derechos reservados"
                    );


                }else
                    if( $item->role_id == 7 ){
                        //jefe de prevenció
                        $para="Jefe de Prevención";
                        $body = array(
                            "asunto" => "ASUNTO",
                            "titulo" => "FORMULARIO DE RE-INSPECCIÓN ",
                            "para" => "Estimado(a) Jefe de Prevención,".strtoupper($item->nombre.' '.$item->apellido),
                            "mensaje" => "Sé notifica que realizo la respectiva re-inspección de la Razón Social " . strtoupper($client[0]->razonSocial)." con RUC: " . $client[0]->ruc.' para que continúe con el respectivo proceso que compete',
                            "posdata" => "Saludos cordiales, Atentamente.",
                            "de" => auth()->user()->nombre . ' ' . auth()->user()->apellido,
                            "rol" => auth()->user()->role->role,
                            "miCorreo" => auth()->user()->email,
                            "telefono" => auth()->user()->telefono,
                            "sistema" => "CUERPO DE BOMBEROS ATACAMES. Todos los derechos reservados"
                        );


                    }else
                        if( $item->role_id == 8 ){
                            //jefe de prevenció
                            $body = array(
                                "asunto" => "ASUNTO",
                                "titulo" => "FORMULARIO DE RE-INSPECCIÓN ",
                                "para" => "Estimado(a) Jefe de Operativo,".strtoupper($item->nombre.' '.$item->apellido),
                                "mensaje" => "Sé notifica que realizo la respectiva re-inspección de la Razón Social " . strtoupper($client[0]->razonSocial)." con RUC: " . $client[0]->ruc.' para que continúe con el respectivo proceso que compete',
                                "posdata" => "Saludos cordiales, Atentamente.",
                                "de" => auth()->user()->nombre . ' ' . auth()->user()->apellido,
                                "rol" => auth()->user()->role->role,
                                "miCorreo" => auth()->user()->email,
                                "telefono" => auth()->user()->telefono,
                                "sistema" => "CUERPO DE BOMBEROS ATACAMES. Todos los derechos reservados"
                            );

                        }
                Mail::to($item->email)->send(new MailTrap($body));

            }



            return back()->with('Respuesta','El FORMULARIO DE RE-INSPECCIÓN fue emitido correctamente!');



        }else

        if( $caso =='update_info'){
            DB::table('client')
                ->where('id', (int) $request->input('clietn_id'))
                ->update([
                    'tipoFormulario'    => $request->input('tipoInspecion'),
                    'razonSocial'       => $request->input('razonSocial'),
                    'representanteLegal'=> $request->input('representanteLegal'),
                    'parroquia_id'      => $request->input('parroquia'),
                    'barrio'            => $request->input('barrio'),
                    'telefono'          => $request->input('telefono'),
                    'referencia'        => $request->input('referencia'),
                    'categoria_id'      => (int) $request->input('categoria'),
                    'denominacion_id'   => (int) $request->input('actividad'),
                    'updated_at'        => Carbon::now()
                ]);

                    $auditoria = new AuditoriaModel();
                    $auditoria->user_id = auth()->user()->id;
                    $auditoria->role_id  = auth()->user()->role->id;
                    $auditoria->modulo      = 'Usuarios';
                    $auditoria->descripcion = 'Modifico la información de un cliente o local con id: '. (int) $request->input('clietn_id');
                    $auditoria->accion      = 'MODIFICA LOCAL';
                    $auditoria->valor       = (int) $request->input('clietn_id');
                    $auditoria->created_at  = Carbon::now();
                    $auditoria->save();

            return back()->with('Respuesta','Se Modifico un registro de usuario en el sistema correctamente!');

        }else

        if( $caso  == 'solicitar') {

            DB::table('client')->where('id', $id)->update([
                'send_email' => auth()->user()->id,
                'estado' => 6,
                'updated_at' => Carbon::now()
            ]);


            $client = DB::table('client')->select('ruc', 'razonSocial')->where('id', $id)->get();
            $secretario = DB::table('users')->select('email', 'nombre','apellido')->where('estado', 2)->where('role_id','=','3')->get();

            $secretario_enTurno = $secretario[0]->email;


            $body = array(
                "asunto" => "ASUNTO",
                "titulo" => "SOLICITUD DE MODIFICACIÓN DE FORMULARIO DE INSPECCIÓN",
                "para" => "Sr(a). Secretario(a).",
                "mensaje" => "Solicito su autorización para la modificación del Formulario de Inspección de la Razón Social: " . $client[0]->razonSocial . " con RUC: " . $client[0]->ruc . ", para la respectiva corrección de información.",
                "posdata" => "Quedo atento a su pronta respuesta, Atentamente.",
                "de" => auth()->user()->nombre . ' ' . auth()->user()->apellido,
                "rol" => auth()->user()->role->role,
                "miCorreo" => auth()->user()->email,
                "telefono" => auth()->user()->telefono,
                "sistema" => "CUERPO DE BOMBEROS ATACAMES"
            );

            Mail::to($secretario_enTurno)->send(new MailTrap($body));


            $auditoria = new AuditoriaModel();
            $auditoria->user_id = auth()->user()->id;
            $auditoria->role_id  = auth()->user()->role->id;
            $auditoria->modulo = 'Usuarios';
            $auditoria->descripcion = 'Envia correo electrónico de SOLICITUD DE MODIFICACIÓN DE FORMULARIO DE INSPECCIÓN';
            $auditoria->accion = 'envia correo';
            $auditoria->valor = $client[0]->ruc;
            $auditoria->created_at = Carbon::now();
            $auditoria->save();


            return redirect('clients')->with('Respuesta', 'Se ha enviado un correo electrónico al SECRETARIO en turno, solicitando editar este registro.');
        }else

        if($caso == 'autorizar_reinspeccion') {

                $inspector = DB::table('users')
                    ->select('email', 'nombre','apellido')
                    ->where('estado', 2)
                    ->whereIn('id',
                                            DB::table('client')
                                                ->select('send_email')
                                                ->where('id', $id)
                        )
                    ->get();

                if ( empty($inspector[0]) ){
                    $inspector = DB::table('users')
                        ->select('email', 'nombre','apellido')
                        ->where('estado', 2)
                        ->whereIn('id',
                            DB::table('client')
                                ->select('inspector_id')
                                ->where('id', $id)
                        )
                        ->get();
                }

                
                DB::table('client')->where('id', $id)->update([
                    'estado' => 5,
                    'send_email' => null,
                    'updated_at' => Carbon::now()
                ]);

                $inspector_enTurno = $inspector[0]->email;

                $client = DB::table('client')->select('ruc', 'razonSocial')->where('id', $id)->get();

                $body = array(
                    "asunto" => "ASUNTO",
                    "titulo" => "CONFIRMACIÓN DE MODIFICACIÓN DE FORMULARIO DE INSPECCIÓN",
                    "para" => "Sr(a). Inspector(a).",
                    "mensaje" => "Su solicitud para la modificación del Formulario de Inspección de la Razón Social: " . $client[0]->razonSocial . " con RUC: " . $client[0]->ruc . " ha sido procesada, puede continuar con el proceso.",
                    "posdata" => "Saludos cordiales, Atentamente.",
                    "de" => auth()->user()->nombre . ' ' . auth()->user()->apellido,
                    "rol" => auth()->user()->role->role,
                    "miCorreo" => auth()->user()->email,
                    "telefono" => auth()->user()->telefono,
                    "sistema" => "CUERPO DE BOMBEROS ATACAMES"
                );

                Mail::to($inspector_enTurno)->send(new MailTrap($body));


                $auditoria = new AuditoriaModel();
                $auditoria->user_id = auth()->user()->id;
                $auditoria->role_id  = auth()->user()->role->id;
                $auditoria->modulo = 'Usuarios';
                $auditoria->descripcion = 'Envia correo electrónico de CONFIRMACIÓN DE MODIFICACIÓN DE FORMULARIO DE INSPECCIÓN con razon social: '.$client[0]->razonSocial.' id: '.$id;
                $auditoria->accion = 'envia correo';
                $auditoria->valor = $id;
                $auditoria->created_at = Carbon::now();
                $auditoria->save();


                return redirect('clients')->with('Respuesta', 'Se ha enviado la notificacion de AUTORIZACIÓN por correo electrónico al INSPECTOR en turno.');
        }else

        if( $caso =='update_info_2'){


 
                        DB::table('client')
                        ->where('id', $request->input('clietn_id'))
                        ->update([
                                'ruc'        => $request->input('ruc'),
                                'tipoFormulario'        => $request->input('tipoInspecion'),
                                'razonSocial'           => $request->input('razonSocial'),
                                'representanteLegal'    => $request->input('representanteLegal'),
                                'parroquia_id'          => $request->input('parroquia'),
                                'barrio'                => $request->input('barrio'),
                                'telefono'              => $request->input('telefono'),
                                'referencia'            => $request->input('referencia'),
                                'categoria_id'          => $request->input('categoria'),
                                'denominacion_id'       => $request->input('actividad'),
                                'riesgo_id'             => $request->input('riesgo'),
                                'updated_at'            => Carbon::now()
                            ]);

                        $auditoria = new AuditoriaModel();
                        $auditoria->user_id     = auth()->user()->id;
                        $auditoria->role_id     = auth()->user()->role->id;
                        $auditoria->modulo      = 'Usuarios';
                        $auditoria->descripcion = 'Modifia la información de un cliente o local';
                        $auditoria->accion      = 'MODIFICA LOCAL';
                        $auditoria->valor       = $request->input('clietn_id');
                        $auditoria->created_at  = Carbon::now();
                        $auditoria->save();

                        return back()->with('Respuesta','Se MOFICICO un registro de usuario en el sistema correctamente.');

        }else

        if($caso == 'revertir_permiso'){


            DB::table('otros_pagos')
                ->where('client_id', $id)
                ->update([
                    'estado'        => 1,
                    'updated_at'    => Carbon::now()
                ]);

            DB::table('pagos_tasas')
                ->where('client_id', $id)
                ->update([
                    'estado'        => 1,
                    'updated_at'    => Carbon::now()
                ]);

            DB::table('client')
                ->where('id', $id)
                ->update([
                    'estado'        => 4,
                    'updated_at'    => Carbon::now()
                ]);

            $auditoria = new AuditoriaModel();
            $auditoria->user_id     = auth()->user()->id;
            $auditoria->role_id     = auth()->user()->role->id;
            $auditoria->modulo      = 'Revertir Permiso';
            $auditoria->descripcion = 'Al revertir permiso de funcionameinto las tablas otros_pagos,pagos_tasas,client cambian a estado  anulado id re cliente'.$id;
            $auditoria->accion      = 'MOMDIFICA LOCAL';
            $auditoria->valor       = $id;
            $auditoria->created_at  = Carbon::now();
            $auditoria->save();


            return back()->with('Respuesta','El registro fue revertido correctamente!!');




        }

    }


    public function destroy($id) {

        $client = DB::table('client')->select(   'id','razonSocial')->where('id', $id)->get();

        DB::table('client')->where('id', $id)
        ->update([
            'estado'    => 0,
            'updated_at'        => Carbon::now()
        ]);
        $auditoria = new AuditoriaModel();
        $auditoria->user_id = auth()->user()->id;
        $auditoria->role_id  = auth()->user()->role->id;
        $auditoria->modulo = 'Formularios';
        $auditoria->descripcion = 'Elimina la informacion de un formulario de inspeccion con id '.$id.' y Razón Social '.$client[0]->razonSocial;
        $auditoria->accion = 'ELIMINA FORMULARIO';
        $auditoria->valor = $id;
        $auditoria->created_at = Carbon::now();
        $auditoria->save();

        return back()->with('Respuesta','Se ELIMINO el Formulario de Inspección de la Razón Social'.strtoupper ($client[0]->razonSocial).' del sistema.');



    }

    public function pdfcliente($id){

       
        $reporte = DB::table('client', 'cli')
            ->join('denominaciones', 'cli.denominacion_id', 'denominaciones.id')
            ->join('categorias', 'cli.categoria_id','=', 'categorias.id')
            ->select('categorias.descripcion')
            ->join('parroquias', 'cli.parroquia_id', 'parroquias.id')
            ->select('cli.id'
                , 'cli.ruc'
                , 'cli.razonSocial'
                , 'cli.representanteLegal'
                , 'parroquias.descripcion as parroquia'
                , 'cli.telefono'
                , 'cli.barrio'
                , 'cli.referencia'
                , 'cli.inspector_id'
                , 'cli.categoria_id'
                , 'categorias.descripcion'
            )
            ->whereIn('cli.estado', [4])
            ->where('cli.inspector_id','=',$id)
            ->orderBy('parroquias.descripcion', 'ASC')
            ->get();
        $doc = "";
        $pdf = PDF::loadView('report/pdf' , ["reporte" => $reporte]);
        return $pdf->stream($doc . '.pdf');
    }

 

    public function export(){
        $file4 = "REPORTE DEL INSPECTOR".now()->toDateTimeString();
        return \Maatwebsite\Excel\Facades\Excel::download( new ClientExport , $file4.'.xlsx');
    }

}


