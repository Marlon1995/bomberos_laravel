<?php

namespace App\Http\Controllers;

use App\AuditoriaModel;
use App\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class clients_secretariaController extends Controller
{
    function __construct() {
        $this->middleware(['authUser','roles:3,1']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $data = System::all()->where('estado', '=','2');
        $sector  = DB::table('parroquias'   ,'p')
                    ->select('p.id'       ,'p.descripcion')
                    ->where('p.estado'     ,2)
                    ->orderBy('p.descripcion'  ,'ASC')->get();
         $categoria  = DB::table('categorias'   , 'cat')
                        ->select('cat.id'     , 'cat.descripcion')
                        ->where('cat.estado'   , 2)
                        ->orderBy('cat.descripcion','ASC')->get();

        $clients = DB::table('client','cli')
            ->join('parroquias','cli.parroquia_id'          ,'parroquias.id')
            /* ->join('denominaciones','cli.denominacion_id'   ,'denominaciones.id') */
            /* ->join('categorias','cli.categoria_id'          ,'categorias.id') */
            ->select(   'cli.id'    ,'cli.ruc'          ,'cli.razonSocial'  ,'cli.representanteLegal'   ,'cli.parroquia_id'
                        ,'cli.telefono'     ,'cli.referencia'   ,'cli.categoria_id' ,'cli.denominacion_id'      ,'cli.tipoFormulario'
                        /* ,'denominaciones.descripcion as denominacion'               ,'categorias.descripcion as categorias' */
                        ,'cli.estado'       ,'parroquias.descripcion as parroquia'
                        
            )
          // ->whereNotIn( 'cli.estado'  , [1])

            ->orderBy('cli.id' ,'desc')->get();


        return view( 'clients_secretaria' , compact('data','sector','categoria','clients') );
    }

    public function destroy( Request $request, $id) {
     
        $id=$request->input('client_id');
        
        $name="";
   
         if ($request->hasFile('respaldo')) {
            $file = $request->file('respaldo');
           
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/dicumentosRespaldo/', $name);
          

        }
    

        $client = DB::table('client')->select(   'id','razonSocial')->where('id', $id)->get();
        

        DB::table('client')->where('id', $id)
            ->update([
                'estado'    => 1,
                'file'      => $name,
                'updated_at'        => Carbon::now()
            ]);

        DB::table('otros_pagos')
            ->where('client_id', $id)
            ->update([
                'estado' => 1,
                'updated_at' => Carbon::now()
            ]);

        DB::table('pagos_tasas')
            ->where('client_id', $id)
            ->update([
                'estado' => 1,
                'updated_at' => Carbon::now()
            ]);
         

        $auditoria = new AuditoriaModel();
        
        $auditoria->user_id = auth()->user()->id;
        $auditoria->role_id  = auth()->user()->role->id;
        $auditoria->modulo = 'Formularios';
        $auditoria->descripcion = 'Desactiva al cliente id '.$id;
        $auditoria->accion = 'desctiva al cliente';
        $auditoria->valor = $id;
        $auditoria->created_at = Carbon::now();
        
        $auditoria->save();
       
        return back()->with('Respuesta','Se DESACTIVO el cliente  del sistema.');
    }


}
