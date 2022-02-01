<?php

namespace App\Http\Controllers;

use App\AuditoriaModel;
use App\DetalleRequerimiento;
use App\FotosLocalModel;
use App\Mail\MailTrap;
use App\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FormularioController extends Controller{
    function __construct() {
        $this->middleware(['authUser','roles:4']);
    }

    public function index() {
        return redirect('/');
    }

    public function store(Request $request){
        $longitud =  $request->input('count');
        $client_id = $request->input('client_id');
        $client = DB::table('client')->select('ruc', 'razonSocial','representanteLegal','email')->where('id', $client_id)->get();

        for ($i=1; $i <= 27; $i++){
            $data = new DetalleRequerimiento();
            $data->client_id        = $client_id;
            $data->requerimiento_id = $i;
            $data->respuesta        = $request->input('respuesta_'.$i);
            $data->cantidad         = $request->input('cantidad_'.$i);
            $data->cantidadB         = $request->input('cantidadB_'.$i);
            $data->observacion      = $request->input('observacion_'.$i);
            $data->estado           = 2;
            $data->save();
        }

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

        DB::table('client')->where('id', $client_id)->update([
            'riesgo_id'  => $request->input('tipoNegocio'),
            'decripcion' => $request->input('decripcion_riego'),
            'estado' => 4,
            'updated_at'  => Carbon::now()
        ]);


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

        foreach ( $users as $item){

            if( $item->role_id == 3 ){
                 $body = array(
                    "asunto" => "ASUNTO",
                    "titulo" => "FORMULARIO DE INSPECCIÓN ",
                    "para" => "Estimado(a) Secretario(a), ".strtoupper($item->nombre.' '.$item->apellido),
                    "mensaje" => "Sé notifica que realizo la respectiva inspección de la Razón Social " . strtoupper($client[0]->razonSocial)." con RUC: " . $client[0]->ruc.' para que continúe con el respectivo proceso que le compete',
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


            }else
            if( $item->role_id == 8 ){
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
            ->orderBy('client.created_at', 'desc')
            ->get();
         $riego = DB::table('tasa_anual')
            ->join('client',  [
                'client.denominacion_id' => 'tasa_anual.denominacion_id',
                'client.categoria_id'    => 'tasa_anual.categoria_id' ])
            ->join('riesgos','riesgos.id' ,'tasa_anual.riesgo_id')
            ->select('riesgos.id','riesgos.descripcion')
            ->where('client.id', $id)
            ->groupBy('riesgos.id','riesgos.descripcion')
            ->get();

        $fotosLocal = DB::table('fotos_local')
            ->join('client','client.id','fotos_local.client_id')
            ->select(   'fotos_local.path' )
            ->where('client.id',$id)
            ->get();


        return view( 'formulario-edit' , compact('data','client','requerimientos','riego','fotosLocal') );

     }

    public function update(Request $request, $id) {
        $longitud =  $request->input('count');

        for ($i=1; $i <= 27; $i++){
             DB::table('det_requerimientos')->where(['client_id' => $id,'requerimiento_id' => $i])->update([
                'respuesta'     => $request->input('respuesta_'.$i),
                'cantidad'      => $request->input('cantidad_'.$i),
                'cantidadB'     => $request->input('cantidadB_'.$i),
                'observacion'   => $request->input('observacion_'.$i),

             ]);
        }

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
