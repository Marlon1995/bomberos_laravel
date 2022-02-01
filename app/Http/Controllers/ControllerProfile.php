<?php

namespace App\Http\Controllers;

use App\AuditoriaModel;
use App\Mail\MailTrap;
use App\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ControllerProfile extends Controller
{

    function __construct() {
        $this->middleware(['authUser','roles:1,2,3,4,5,6,7,8,9,10']);
    }

    public function index() {
        return view( 'profile'  );
    }

    public function update(Request $request, $id)
    {
        $tipe = $request->input('tipe');

        if ($tipe == "updateInformationUser"){
             DB::table('users')->where('id', auth()->user()->id)->update([
                'cedula' => $request->input('cedula'),
                'nombre' => $request->input('nombre'),
                'apellido' => $request->input('apellido'),
                'telefono' => $request->input('telefono'),
                 'direccion' => $request->input('direccion'),
                 'sexo' => $request->input('sexo'),
                'updated_at' => Carbon::now()
            ]);
            return back()->with('Respuesta', 'Tu INFORMACIÓN PERSONAL fue actualizada correctamente.');

        }else


        if($tipe == "updatePasword") {
            $contraseniaNueva = $request->input('contraseniaNueva');
            $confirmaContrasenia = $request->input('confirmaContrasenia');

            if ($contraseniaNueva != $confirmaContrasenia) {
                return back()->with('Respuesta_erro', 'La confirmación de tu contraseña no coincide, Reintenta');
            }

            DB::table('users')->where('id', auth()->user()->id)->update([
                'password' => bcrypt($contraseniaNueva),
                'updated_at' => Carbon::now()
            ]);

            $auditoria = new AuditoriaModel();
            $auditoria->user_id = auth()->user()->id;
            $auditoria->role_id = auth()->user()->role->id;
            $auditoria->modulo = 'Perfil';
            $auditoria->descripcion = 'Cambio de Contraseña del usuario: ' . auth()->user()->id;
            $auditoria->accion = 'CAMBIO DE CONTRASEÑA';
            $auditoria->valor = auth()->user()->id;
            $auditoria->created_at = Carbon::now();
            $auditoria->save();

            $body = array(
                "asunto" => "CAMBIO DE CONTRASEÑA",
                "titulo" => "ALERTA DE SEGURIDAD",
                "para" => auth()->user()->role->role,
                "mensaje" => "Alerta de seguridad, su contraseña ha sido modificada Fecha: " . now()->toDateString() . ", si desconoce de este cambio, comunique al Administrador",
                "posdata" => "",
                "de" => "Cambio de Contraseña",
                "rol" => "Contraseñas ",
                "miCorreo" => "no-reply@bomberosatacames.gob.ec",
                "telefono" => "000000000",
                "sistema" => "CUERPO DE BOMBEROS ATACAMES"
            );


            Mail::to(auth()->user()->email)->send(new MailTrap($body));


            return back()->with('Respuesta', 'Tu CONTRASEÑA fue actualizada correctamente.');
        }

    }
}
