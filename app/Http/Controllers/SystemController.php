<?php

namespace App\Http\Controllers;

use App\System;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SystemController extends Controller
{

    function __construct() {
        $this->middleware('authUser', [ 'except' => [ 'login'] ]);
    }


    //login pantalla principal
    public function login() {
        $data = System::all();
        return view( 'login' , compact('data') );
    }

    ///luego del login correcto
    public function index() {
        $data = System::all();
        return view( 'index' , compact('data') );
    }

    public function update(Request $request, $id)  {
        $this->validate($request , [
            'icono' => "image|nullable|max:1999"
        ]);
         $path = Storage::putFile('app/public/assets/img/icons', $request->file('icono'));

         DB::table('system')->where('id', $id)->update([
            'nombre' => $request->nombre,
            'icono' => $path,
            'terminos' => $request->terminos,
            'condiciones' => $request->condiciones,
            'updated_at'  => Carbon::now()
        ]);

         return back()->with('Respuesta','La informacion fue actualizada correctamente!!');
    }

}
