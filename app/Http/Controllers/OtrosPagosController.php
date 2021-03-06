<?php

namespace App\Http\Controllers;

use App\AuditoriaModel;
use App\otrosCotrosModel;
use App\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtrosPagosController extends Controller
{
    function __construct() {
        $this->middleware(['authUser','roles:3']);
    }

    public function index()    {


        $impuestos = DB::table('otros_cobros')
             ->select('id', 'razonSocial', 'representanteLegal', 'ruc','telefono','created_at','valor','porcenjatetasa','year_now')
            ->where('estado','=',8)
            ->orderBy('created_at', 'desc')

            ->get();

        $formasPago = DB::table('formaspago')
            ->select('id', 'nombre')
            ->whereIn('estado', [2])
            ->orderBy('nombre', 'asc')
            ->get();


        $data = System::all();
        return view('otros-cobros', compact('data',  'impuestos', 'formasPago'));
    }

    public function update(Request $request, $id){
        $caso = $request->input('caso');
     
        if($caso == 'revertir_permiso'){


            DB::table('otros_cobros')
                ->where('id', $id)
                ->update([
                    'estado'        => 1,
                    'updated_at'    => Carbon::now()
                ]);


         

            $auditoria = new AuditoriaModel();
            $auditoria->user_id     = auth()->user()->id;
            $auditoria->role_id     = auth()->user()->role->id;
            $auditoria->modulo      = 'Revertir Permiso';
            $auditoria->descripcion = 'Al revertir permiso de funcionameinto las tablas otros_pagos cambian a estado  anulado id re cliente'.$id;
            $auditoria->accion      = 'MOMDIFICA LOCAL';
            $auditoria->valor       = $id;
            $auditoria->created_at  = Carbon::now();
            $auditoria->save();


            return back()->with('Respuesta','El registro fue revertido correctamente!!');




        }
    }

    public function store(Request $request){





        $descuento = 0;
        if($request->input('tipodescuento')=='personalizado') {
            //imput oculto
            $descuento = $request->input('porcentajedescuento');
        }else{

            $descuento = $request->input('tipodescuento');

        }


        $valor          = floatval($request->input('valor'));
        $porcentaje     = floatval($request->input('porcenjatetasa'));
        if($request->input('tipodescuento')=='100') {
            //imput oculto
            $pago_valor=2;
        }else{


            $total= floatval($valor)+(floatval($valor)*(floatval($porcentaje)/100));

            $pago_valor             = (floatval($valor)-(floatval($valor)*(floatval($descuento)/100)));
            $porcentaje_descuento   = $pago_valor*($porcentaje/100);
            $total                  = $pago_valor+$porcentaje_descuento;

        }

        



        //$pago_valor = $request->input('valor') ;
        $data = new otrosCotrosModel();
        $data->razonSocial          = $request->input('nombreLocal');
        $data->representanteLegal   = $request->input('representanteLegal');
        $data->ruc                  = $request->input('ruc');
        $data->direccion            = $request->input('direccion');
        $data->telefono             = $request->input('telefono');
        $data->formaPago_id         = 1; // efectivo
        $data->descripcion          = $request->input('decripcion_mp_1');
        $data->valor                = $pago_valor; //pago valor
        $data->porcenjatetasa       = $request->input('porcenjatetasa'); //porcenta en porcentaje
        $data->year_now             = $request->input('anioPago');
        $data->estado               = 8;
        $data->timestamps          = Carbon::now();
        $data->save();

        $auditoria = new AuditoriaModel();
        $auditoria->user_id         = auth()->user()->id;
        $auditoria->role_id         = auth()->user()->role->id;
        $auditoria->modulo          = 'Otros Cobros';
        $auditoria->descripcion     = 'Genera el pago de OTROS COBOS de la razonSocial ' . $request->input('nombreLocal'). ',valor: $ '. round($total ,2).', descrpci??n ' . $request->input('descripcion');
        $auditoria->accion          = 'Pago de anticipo';
        $auditoria->valor           = (int) $request->input('ruc');
        $auditoria->created_at      = Carbon::now();
        $auditoria->save();

        return back()->with('Respuesta', 'Se genero el PAGO correctamente.(IMPRECI??N DE COMPROBANTES EN COLA)');
    }




}
