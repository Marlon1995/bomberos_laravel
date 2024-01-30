<?php

namespace App\Http\Controllers;

use App\AuditoriaModel;
use App\DetalleRequerimiento;
use App\Inspecciones;
use App\Inspecciones_sec;
use App\PagoInspeccion;
use App\FotosLocalModel;
use App\Mail\MailTrap;
use App\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FormularioController extends Controller{
    function __construct() {
        $this->middleware(['authUser','roles:4,1']);
    }

    public function index() {
        return redirect('/');
    }

    public function store(Request $request) {
        //queda en el codigo
        $longitud =  $request->input('count');
        $client_id = $request->input('client_id');
        $valorBCI = $request->input('respuesta_bci');
        $valorSIE = $request->input('respuesta_electrico');

        $client = DB::table('client')->select('ruc', 'razonSocial','representanteLegal','email')->where('id', $client_id)->get();

        //añadido en el codigo
        for ($i=1; $i <= 18; $i++){
            $data = new Inspecciones();
            $data->client_id        = $client_id;
            $data->requerimiento_id = $i;
            $data->respuesta        = $request->input('respuesta_'.$i);
            $data->tipo             = 'X';
            $data->estado           = 2;
            $data->save();
        }

        //añadido en el codigo
        for ($i=19; $i <= 25; $i++){

            

            $data = new Inspecciones();
            $data->client_id        = $client_id;
            $data->requerimiento_id = $i;
            $data->respuesta        = $request->input('respuesta_'.$i)=='0'?0:$request->input('respuesta_'.$i);
            $data->tipo             = 'Y';
            $data->estado           = 2;
            $data->save();
        }

        $sumInspection_x = DB::table('inspecciones')->select('respuesta')->where(['client_id' => $client_id,'tipo' => 'X'])->get()->sum('respuesta');
        $sumInspection_y = DB::table('inspecciones')->select('respuesta')->where(['client_id' => $client_id,'tipo' => 'Y'])->get()->sum('respuesta');
        $valor_p = ((5 * $sumInspection_x)/129) + ((5*$sumInspection_y)/26) + $valorBCI + $valorSIE ;

        //valores de la tabla para el calculo
        if ($valor_p < 3) {
            $valor_descripcion = 'Alto 15% - SBU';
            
            $valor_riesgo = (float) 69;
        } else if ($valor_p > 3 && $valor_p < 5) {
            $valor_descripcion = 'Alto 15% - SBU';
            $valor_riesgo = (float) 69;
        } else if ($valor_p > 5 && $valor_p < 8) {
            $valor_descripcion = 'Medio 10% - SBU';
            $valor_riesgo = (float) 46;
        } else {
            $valor_descripcion = 'Leve 5% - SBU';
            $valor_riesgo = (float) 23;
        }

        $tipoInstalacion_id = $request->input('tipoInstalacion');
        $cantidad_m2 = (float) $request->input('cantidad_m2');
        $tipoInstalacion = DB::table('tipo_instalacion')->select('valor')->where('id', $tipoInstalacion_id)->get();

        $totalPagar = ($cantidad_m2 * $tipoInstalacion[0]->valor) + $valor_riesgo;

        //guardamos el valor final a pagar
        $pagoInspeccion = new PagoInspeccion();
        $pagoInspeccion->client_id = $client_id;
        $pagoInspeccion->valor = $totalPagar;
        $pagoInspeccion->save();

        //guardamos inspecciones_secundarios
        $valorInspeccionesSec = new Inspecciones_sec();
        $valorInspeccionesSec->client_id = $client_id;
        $valorInspeccionesSec->valor_bci = $valorBCI;
        $valorInspeccionesSec->valor_sis = $valorSIE;
        $valorInspeccionesSec->observacion = $request->input('observacion_formulario');
        $valorInspeccionesSec->riesgo = $valor_descripcion;
        $valorInspeccionesSec->tipoInstalacion_id = $tipoInstalacion_id;
        $valorInspeccionesSec->cantidad_m2 = $cantidad_m2;
        $valorInspeccionesSec->save();

        //queda en el codigo
        for ($i=1; $i <= 6; $i++) {
            if ($request->hasFile('foto'.$i)) {
                $file = $request->file('foto'.$i);
                $name = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/imgFormularios/', $name);
                $fotosLocal = new FotosLocalModel();
                $fotosLocal->client_id  = $client_id;
                $fotosLocal->path       = $name;
                $fotosLocal->number_img = $i;
                $fotosLocal->estado     = 2;
                $fotosLocal->created_at = Carbon::now();
                $fotosLocal->save();
            }
        }

        //queda en el codigo
        DB::table('client')->where('id', $client_id)->update([
            'riesgo_id'  => $request->input('tipoNegocio'),
            'decripcion' => $request->input('decripcion_riego'),
            'inspector_id'=> auth()->user()->id,
            'estado' => 4,
            'updated_at'  => Carbon::now()
        ]);

        //queda en el codigo
        $auditoria = new AuditoriaModel();
        $auditoria->user_id = auth()->user()->id;
        $auditoria->role_id  = auth()->user()->role->id;
        $auditoria->modulo = 'Usuarios';
        $auditoria->descripcion = 'Guarda la informacion del formulario de inspeccion de la rason social: '.$client[0]->razonSocial;
        $auditoria->accion = 'INGRESA FORMULARIO';
        $auditoria->valor = $client_id;
        $auditoria->created_at = Carbon::now();
        $auditoria->save();

        $users = DB::table('users')
            ->join('roles', 'roles.id','=','users.role_id')
            ->select('users.nombre', 'users.apellido','users.email', 'users.role_id')
            ->whereIn('roles.id',[3,7,8])
            ->where('users.estado','=','2')
            ->get();


        $body = array(
            "asunto" => "ASUNTO",
            "titulo" => "FORMULARIO DE INSPECCIÓN ",
            "para" => "Estimado(a) ".strtoupper($client[0]->representanteLegal),
            "mensaje" => "Sé ha realizado la respectiva  inspección  de la Razón Social " . strtoupper($client[0]->razonSocial ). " con RUC: " . $client[0]->ruc . ", le recordamos que debe acercarse a las oficinas de administración del CUERPO DE BOMBEROS ATACAMES para la respectiva solicitud y pago del permiso de funcionamiento",
            "posdata" => "Saludos cordiales, Atentamente.",
            "de" => auth()->user()->nombre . ' ' . auth()->user()->apellido,
            "rol" => auth()->user()->role->role,
            "miCorreo" => auth()->user()->email,
            "telefono" => auth()->user()->telefono,
            "sistema" => "CUERPO DE BOMBEROS ATACAMES"
        );

        Mail::to($client[0]->email)->send(new MailTrap($body));

        foreach ($users as $item) {
            if ($item->role_id == 3) {
                 $body = array(
                    "asunto" => "ASUNTO",
                    "titulo" => "FORMULARIO DE INSPECCIÓN ",
                    "para" => "Estimado(a) Recaudador(a), ".strtoupper($item->nombre.' '.$item->apellido),
                    "mensaje" => "Sé notifica que realizo la respectiva inspección de la Razón Social " . strtoupper($client[0]->razonSocial)." con RUC: " . $client[0]->ruc.' para que continúe con el respectivo proceso que le compete',
                    "posdata" => "Saludos cordiales, Atentamente.",
                    "de" => auth()->user()->nombre . ' ' . auth()->user()->apellido,
                    "rol" => auth()->user()->role->role,
                    "miCorreo" => auth()->user()->email,
                    "telefono" => auth()->user()->telefono,
                    "sistema" => "CUERPO DE BOMBEROS ATACAMES. Todos los derechos reservados"
                );
            } else if ( $item->role_id == 1  || $item->role_id == 7) {
                //jefe de prevenció
                $para="Jefe de Prevención";
                $body = array(
                    "asunto" => "ASUNTO",
                    "titulo" => "FORMULARIO DE INSPECCIÓN ",
                    "para" => "Estimado(a) Jefe de Prevención,".strtoupper($item->nombre.' '.$item->apellido),
                    "mensaje" => "Sé notifica que realizo la respectiva inspección de la Razón Social " . strtoupper($client[0]->razonSocial)." con RUC: " . $client[0]->ruc.' para que continúe con el respectivo proceso que compete',
                    "posdata" => "Saludos cordiales, Atentamente.",
                    "de" => auth()->user()->nombre . ' ' . auth()->user()->apellido,
                    "rol" => auth()->user()->role->role,
                    "miCorreo" => auth()->user()->email,
                    "telefono" => auth()->user()->telefono,
                    "sistema" => "CUERPO DE BOMBEROS ATACAMES. Todos los derechos reservados"
                );
            } else if ( $item->role_id == 8 ) {
                //jefe de prevenció
                $body = array(
                    "asunto" => "ASUNTO",
                    "titulo" => "FORMULARIO DE INSPECCIÓN ",
                    "para" => "Estimado(a) Jefe de Operativo,".strtoupper($item->nombre.' '.$item->apellido),
                    "mensaje" => "Sé notifica que realizo la respectiva inspección de la Razón Social " . strtoupper($client[0]->razonSocial)." con RUC: " . $client[0]->ruc.' para que continúe con el respectivo proceso que compete',
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

        return redirect('clients')->with('Respuesta','Se completo el registro del Formulario de Inspección correctamente.');
    }

    public function show($id) {
        //check 1
        $data = System::all();
        $requerimientos = DB::table('requerimientos')
            ->join('inspecciones','requerimientos.check_id','inspecciones.requerimiento_id')
            ->select('requerimientos.*','inspecciones.*' )
            ->where('inspecciones.client_id',$id)
            ->get();
            
        

        $inspecciones_sec = DB::table('inspecciones_sec')
            ->select('inspecciones_sec.*')
            ->where('inspecciones_sec.client_id',$id)
            ->get();

        $tipoInstalacion = DB::table('tipo_instalacion')
            ->select('tipo_instalacion.id','tipo_instalacion.descripcion')
            ->get();

        $client = DB::table('client')
            ->join('parroquias','parroquias.id','client.parroquia_id')
/*             ->join('categorias','categorias.id','client.categoria_id')
            ->join('denominaciones','denominaciones.id','client.denominacion_id') */
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
/*                 ,'categorias.descripcion as categoria'
                ,'denominaciones.descripcion as denominacion' */
                ,'client.estado'
            )->where('client.id', $id)
            ->orderBy('client.created_at', 'desc')
            ->get();
/*          $riego = DB::table('tasa_anual')
            ->join('client',  [
                'client.denominacion_id' => 'tasa_anual.denominacion_id',
                'client.categoria_id'    => 'tasa_anual.categoria_id' ])
            ->join('riesgos','riesgos.id' ,'tasa_anual.riesgo_id')
            ->select('riesgos.id','riesgos.descripcion')
            ->where('client.id', $id)
            ->groupBy('riesgos.id','riesgos.descripcion')
            ->get(); */

        $fotosLocal = DB::table('fotos_local')
            ->join('client','client.id','fotos_local.client_id')
            ->select(   'fotos_local.path' )
            ->where('client.id',$id)
            ->get();


        return view( 'formulario-edit' , compact('data','client','requerimientos','inspecciones_sec','fotosLocal', 'tipoInstalacion') );

     }

    public function update(Request $request, $id) {
        $longitud =  $request->input('count');
        $valorBCI = $request->input('respuesta_bci');
        $valorBCI = $request->input('respuesta_bci');
        $valorSIE = $request->input('respuesta_electrico');

        for ($i=1; $i <= 18; $i++){
             DB::table('inspecciones')->where(['client_id' => $id,'requerimiento_id' => $i])->update([
                'respuesta'     => $request->input('respuesta_'.$i),
             ]);
        }

        for ($i=19; $i <= 25; $i++){
            DB::table('inspecciones')->where(['client_id' => $id,'requerimiento_id' => $i])->update([
               'respuesta'     => $request->input('respuesta_'.$i),
            ]);
       }

       $sumInspection_x = DB::table('inspecciones')->select('respuesta')->where(['client_id' => $id,'tipo' => 'X'])->get()->sum('respuesta');
       $sumInspection_y = DB::table('inspecciones')->select('respuesta')->where(['client_id' => $id,'tipo' => 'Y'])->get()->sum('respuesta');
       $valor_p = ((5 * $sumInspection_x)/129) + ((5*$sumInspection_y)/26) + $valorBCI+  $valorSIE;

       //valores de la tabla para el calculo
       if ($valor_p < 3) {
        $valor_descripcion = 'Alto 15% - SBU';
        $valor_riesgo = (float) 69;
    } else if ($valor_p > 3 && $valor_p < 5) {
        $valor_descripcion = 'Alto 15% - SBU';
        $valor_riesgo = (float) 69;
    } else if ($valor_p > 5 && $valor_p < 8) {
        $valor_descripcion = 'Medio 10% - SBU';
        $valor_riesgo = (float) 46;
    } else {
        $valor_descripcion = 'Leve 5% - SBU';
        $valor_riesgo = (float) 23;
    }

       $tipoInstalacion_id = $request->input('tipoInstalacion');
       $cantidad_m2 = (float) $request->input('cantidad_m2');
       $tipoInstalacion = DB::table('tipo_instalacion')->select('valor')->where('id', $tipoInstalacion_id)->get();

       $totalPagar = ($cantidad_m2 * $tipoInstalacion[0]->valor) + $valor_riesgo;

        DB::table('pago_inspeccion')->where('client_id', $id)->update([
            'valor' => $totalPagar,
            'updated_at'  => Carbon::now()
        ]);

        DB::table('inspecciones_sec')->where('client_id', $id)->update([
            'valor_bci' => $valorBCI,
            'observacion' => $request->input('observacion_formulario'),
            'riesgo' => $valor_descripcion,
            'tipoInstalacion_id' => $tipoInstalacion_id,
            'cantidad_m2' => $cantidad_m2,
            'updated_at'  => Carbon::now()
        ]);

        DB::table('client')->where('id', $id)->update([
            'riesgo_id' => $request->input('tipoNegocio'),
            'decripcion' => $request->input('decripcion_riego'),
            'updated_at'  => Carbon::now()
        ]);


        for ($i=1; $i <= 6; $i++) {
            if ($request->hasFile('foto'.$i)) {
                $file = $request->file('foto'.$i);
                $name = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/imgFormularios/', $name);
                DB::table('fotos_local')->where(['client_id' => $id, 'number_img' => $i])->update([
                    'path'     => $name
                ]);

            }
        }


        $auditoria = new AuditoriaModel();
        $auditoria->user_id = auth()->user()->id;
        $auditoria->role_id  = auth()->user()->role->id;
        $auditoria->modulo = 'Usuarios';
        $auditoria->descripcion = 'MODIFICA EL FORMULARIO DE INSPECCIÓN del id: ' . $request->input('ruc_usuario');
        $auditoria->accion = 'modificacion de formulario de inspeccion';
        $auditoria->valor = $request->input('ruc_usuario');
        $auditoria->created_at = Carbon::now();
        $auditoria->save();


        return redirect('clients')->with('Respuesta', 'Los cambios realizados en el FORMULARIO DE INSPECCIÓN se actualizaron correctamente.');
    }

}
