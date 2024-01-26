<?php

namespace App\Http\Controllers;

use App\Especies;
use App\System;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EspeciesController extends Controller
{
    function __construct()
    {
        $this->middleware(['authUser','roles:3,1']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = System::all();
       $especie = Especies::get();

        return view( 'Especies' ,compact('data','especie'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request);
       $especies = new Especies();
     
       $especies->ruc = $request->ruc;
       $especies->razonSocial = $request->razonSocial;
       $especies->representanteLegal = $request->representanteLegal;
       $especies->direccion = $request->direccion;
       $especies->telefono = $request->telefono;
       $especies->especie = $request->especie;
       $especies->descripcion = $request->descripcion;
       $especies->cantidad = $request->cantidad;
       $especies->valor = $request->valor;
       $especies->estado = 1;
       $especies->created_at      = Carbon::now();
       $especies->save();





        return back()->with('Respuesta','Se ingreso un pago de especie');
    }

    public function destroy($id)
    {
        $ree = DB::table('especies')->where('id','=',$id)
          ->update([
                'estado' => 0,
              'updated_at'  => Carbon::now()

          ]);
        return back()->with('Respuesta','Se Anulo el pago de especie');
    }

}
