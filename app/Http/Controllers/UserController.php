<?php

namespace App\Http\Controllers;

use App\AuditoriaModel;
use App\Mail\MailTrap;
use App\Role;
use App\System;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware(['authUser', 'roles:1,5']);
    }


    public function index()
    {
        $data = System::all();
        if (auth()->user()->role_id == 1) {
            $users = User::all();
            $roles = Role::all();
        } else {
            $users = User::all()->whereNotIn('role_id',  array(1, 2));
            $roles = DB::table('roles')
            ->select('roles.id','roles.key','roles.role','roles.descripcion','roles.estado')
            ->orderBy('roles.role','ASC')
            ->get();
           /* $roles = DB::table('roles')
                ->select('roles.*')
                ->whereNotIn('roles.id',
                    DB::table('users')
                        ->select('users.role_id')
                        ->whereNotIn('users.role_id',array())
                        ->where('users.estado', '=', 2)
                        ->groupBy('users.role_id')
                        //->get()
                )
                ->whereNotIn('roles.id',  array(1, 2))
                ->get();*/
        }

        return view('users', compact('data', 'users', 'roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cedula' => "required",
            'nombre' => "required",
            'apellido' => "required",
            'telefono' => "required",
            'direccion' => "required",
            'email' => "required|email",
        ]);

        $user = DB::table('users')->select('email')->where('email', $request->input('email'))->get();

        if (!empty($user[0]->email)) {
            if ($user[0]->email == $request->input('email')) {
                return back()->with('Respuesta_wn', 'El usuario ' . strtoupper($user[0]->email) . ' ya esta registrado en el sistema.');
            }
        }

        $password = '$' . rand(99234276, 799234276) . '$CBA';

        $send = new User();
        $send->cedula     =  $request->input('cedula');
        $send->nombre     =  $request->input('nombre');
        $send->apellido   =  $request->input('apellido');
        $send->sexo       =  $request->input('sexo');
        $send->telefono   = $request->input('telefono');
        $send->direccion  =  $request->input('direccion');
        $send->email      =  $request->input('email');
        $send->role_id    = $request->input('rol');
        $send->password    = bcrypt($password);
        $send->estado      = 2;
        $send->save();

        $auditoria = new AuditoriaModel();
        $auditoria->user_id = auth()->user()->id;
        $auditoria->role_id  = auth()->user()->role->id;
        $auditoria->modulo = 'Cuentas';
        $auditoria->descripcion = 'Agrega el correo ' . $request->input('email') . ' al sistema con rol ' . $request->input('rol');
        $auditoria->accion = 'INGRESA NUEVO USUARIO';
        $auditoria->valor = $request->input('cedula');
        $auditoria->created_at = Carbon::now();
        $auditoria->save();

        $body = array(
            "asunto" => "REGISTRADO EN EL SISTEMA",
            "titulo" => "Hey!, Bienvenido(a) al Equipo",
            "para" => "Estimado(a) " . $request->input('nombre') . ' ' . $request->input('apellido'),
            "mensaje" => "Se le notifica que el día " . now()->toDateString() . ", fué registrado en el sistema INTRANET CUERPO DE BOMBEROS ATACAMES. Su CLAVE TEMPORAL para ingresar al sistema es: " . $password,
            "posdata" => "NOTA: ES IMPORTANTE QUE AL INGRESAR POR PRIMERA VEZ AL SISTEMA ACTUALICE SU CONTRASEÑA POR SEGURIDAD, Saludos",
            "de" => auth()->user()->nombre . " " . auth()->user()->apellido,
            "rol" => auth()->user()->role->role,
            "miCorreo" => auth()->user()->email,
            "telefono" => auth()->user()->telefono,
            "sistema" => "CUERPO DE BOMBEROS ATACAMES"
        );

        Mail::to($request->input('email'))->send(new MailTrap($body));


        return back()->with('Respuesta', 'Se INGRESO una nueva cuenta de USUARIO correctamente.');
    }

    public function update(Request $request, $id)
    {
        $users = DB::table('users')->select('id', 'email', 'nombre', 'apellido')->where('id', $id)->get();

        $password = '$' . rand(99234276, 799234276) . '$CBA';
        DB::table('users')->where('id', $id)->update([
            'password' => bcrypt($password),
            'updated_at'  => Carbon::now()
        ]);

        $auditoria = new AuditoriaModel();
        $auditoria->user_id = auth()->user()->id;
        $auditoria->role_id  = auth()->user()->role->id;
        $auditoria->modulo = 'Cuentas';
        $auditoria->descripcion = 'Solicita una nueva contraseña para cuenta de correo ' . $users[0]->email;
        $auditoria->accion = 'GENERA NUEVA CLAVE';
        $auditoria->valor = $id;
        $auditoria->created_at = Carbon::now();
        $auditoria->save();

        $body = array(
            "asunto" => "REGISTRADO EN EL SISTEMA",
            "titulo" => "Olvidaste tu contraseña",
            "para" => "Estimado " . $users[0]->nombre . ' ' . $users[0]->apellido,
            "mensaje" => "Se le notifica que el día " . now()->toDateString() . ", fué gerenada su nueva contraseña para el sistema INTRANET CUERPO DE BOMBEROS ATACAMES. Su CLAVE TEMPORAL para ingresar al sistema es: " . $password,
            "posdata" => "NOTA: ES IMPORTANTE QUE AL INGRESAR AL SISTEMA ACTUALICE SU CONTRASEÑA POR SEGURIDAD, Saludos",
            "de" => auth()->user()->nombre . " " . auth()->user()->apellido,
            "rol" => auth()->user()->role->role,
            "miCorreo" => auth()->user()->email,
            "telefono" => auth()->user()->telefono,
            "sistema" => "CUERPO DE BOMBEROS ATACAMES"
        );

        Mail::to($users[0]->email)->send(new MailTrap($body));

        return back()->with('Respuesta', 'La nueva contraseña de ' . strtoupper($users[0]->email) . ' fue generada correctamente.');
    }

    public function destroy(Request $request, $id)
    {
        $client = DB::table('users')->select('id', 'email', 'nombre', 'apellido')->where('id', $id)->get();

        if ($client[0]->id == $id) {

            DB::table('users')->where('id', $id)->delete();

            $auditoria = new AuditoriaModel();
            $auditoria->user_id = auth()->user()->id;
            $auditoria->role_id  = auth()->user()->role->id;
            $auditoria->modulo = 'Cuentas';
            $auditoria->descripcion = 'Elimina la cuenta de usuario con correo ' . $client[0]->email;
            $auditoria->accion = 'ELIMINA USUARIO';
            $auditoria->valor = $id;
            $auditoria->created_at = Carbon::now();
            $auditoria->save();

            $body = array(
                "asunto" => "ELIMINADO DEL SISTEMA",
                "titulo" => "Hey!, Has sido dado de baja",
                "para" => "Estimado " . $client[0]->nombre . ' ' . $client[0]->apellido,
                "mensaje" => "Se le notifica que el día " . now()->toDateString() . ", fué dado de baja del sistema INTRANET CUERPO DE BOMBEROS ATACAMES. Cualquier inquietud comunicarse a las oficinas de administración",
                "posdata" => "Saludos.",
                "de" => auth()->user()->nombre . " " . auth()->user()->apellido,
                "rol" => auth()->user()->role->role,
                "miCorreo" => auth()->user()->email,
                "telefono" => auth()->user()->telefono,
                "sistema" => "CUERPO DE BOMBEROS ATACAMES"
            );

            Mail::to($client[0]->email)->send(new MailTrap($body));


            return back()->with('Respuesta', 'Se ELIMINO la cuenta del usuario ' . strtoupper($client[0]->email) . ' del sistema.');
        }
        return back()->with('Respuesta_erro', 'No se pudo eliminar este registro, Reintente!');
    }
}
