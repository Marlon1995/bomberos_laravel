<?php

namespace App\Http\Controllers;

use App\AuditoriaModel;
use App\otrosCotrosModel;
use App\OtrosPagosModel;
use App\PagosOrdenanzaModel;
use App\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtrosPagosController extends Controller
{
    function __construct()
    {
        $this->middleware(['authUser', 'roles:3']);
    }

    public function index()
    {


        $impuestos = DB::table('otros_cobros')
            ->select('id', 'razonSocial', 'representanteLegal', 'ruc', 'telefono', 'created_at', 'valor', 'porcenjatetasa', 'year_now')
            ->where('estado', '=', 8)
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

    public function update(Request $request, $id)
    {
        $caso = $request->input('caso');

        if ($caso == 'revertir_permiso') {


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
            $auditoria->descripcion = 'Al revertir permiso de funcionameinto las tablas otros_pagos cambian a estado  anulado id re cliente' . $id;
            $auditoria->accion      = 'MOMDIFICA LOCAL';
            $auditoria->valor       = $id;
            $auditoria->created_at  = Carbon::now();
            $auditoria->save();


            return back()->with('Respuesta', 'El registro fue revertido correctamente!!');
        }
    }

    public function store(Request $request)
    {
        $descuento = 0;
        if ($request->input('tipodescuento') == 'personalizado') {
            //imput oculto
            $descuento = $request->input('porcentajedescuento');
        } else {

            $descuento = $request->input('tipodescuento');
        }


        $valor          = floatval($request->input('valor'));
        $porcentaje     = floatval($request->input('porcenjatetasa'));
        if ($request->input('tipodescuento') == '100') {
            //imput oculto
            $pago_valor = 2;
        } else {


            $total = floatval($valor) + (floatval($valor) * (floatval($porcentaje) / 100));

            $pago_valor             = (floatval($valor) - (floatval($valor) * (floatval($descuento) / 100)));
            $porcentaje_descuento   = $pago_valor * ($porcentaje / 100);
            $total                  = $pago_valor + $porcentaje_descuento;
        }





        //$pago_valor = $request->input('valor') ;
        $data = new otrosCotrosModel();
        $data->razonSocial          = $request->input('nombreLocal');
        $data->representanteLegal   = $request->input('representanteLegal');
        $data->ruc                  = $request->input('ruc');
        $data->direccion            = $request->input('direccion');
        $data->telefono             = $request->input('telefono');
        $data->formaPago_id         = 1; // efectivo
        $data->numTituloAdmin = $request->input('numTituloAdmin');
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
        $auditoria->descripcion     = 'Genera el pago de OTROS COBOS de la razonSocial ' . $request->input('nombreLocal') . ',valor: $ ' . round($total, 2) . ', descrpción ' . $request->input('descripcion');
        $auditoria->accion          = 'Pago de anticipo';
        $auditoria->valor           = (int) $request->input('ruc');
        $auditoria->created_at      = Carbon::now();
        $auditoria->save();

        return back()->with('Respuesta', 'Se genero el PAGO correctamente.(IMPRECIÓN DE COMPROBANTES EN COLA)');
    }

    public function mostrar_pago_ordenanza()
    {

        $impuestos = DB::table('otros_cobros')
            ->select('id', 'razonSocial', 'representanteLegal', 'ruc', 'telefono', 'created_at', 'valor', 'porcenjatetasa', 'year_now')
            ->where('estado', '=', 8)
            ->orderBy('created_at', 'desc')

            ->get();

        $formasPago = DB::table('formaspago')
            ->select('id', 'nombre')
            ->whereIn('estado', [2])
            ->orderBy('nombre', 'asc')
            ->get();


        $data = System::all();
        return view('cobros-ordenanzas', compact('data',  'impuestos', 'formasPago'));
    }


    public function agregar_pago_ordenanza(Request $request)
    {
        $id_cliente = DB::table('client')
            ->select('id')
            ->where('ruc', '=', $request->ruc)
            ->orderBy('created_at', 'desc')

            ->get();
            
        $descripcion='';
        switch ($request->tipoOrdenanza){
            case 1:
                $descripcion='Art. 20. – DE LAS GASOLINERAS. Categorizada como Instalación Especial y de Alto Riesgo, la tasa de prevención de incendios para las Gasolineras, considerando como base para el valor de cobro establecido, los registros históricos de los últimos tres (3) años de recaudación en el Cuerpo de Bomberos de Atacames. ';
                break;
            case 2:
                $descripcion='Art. 21. – DEL TRANSPORTE DE COMBUSTIBLES. La tasa de servicios para el permiso de transporte de combustibles y materiales peligrosos se cobrará anualmente, luego de la inspección de los vehículos dedicados a esta actividad; los mismos que deben contar con la señalética y equipos necesarios de Prevención y Defensa Contra Incendios.';
                break;
            case 3:
                $descripcion='Art. 22. – DE LOS ESPECTÁCULOS O EVENTOS DE CONCENTRACIÓN MASIVA. Para obtener el permiso ocasional para espectáculos o eventos de concentración masiva, es previo a la Autorización que el Cuerpo de Bomberos del Cantón Atacames emite para la realización de actividades no permanentes, para lo cual debe ser solicitada en el término de cinco (5) días previos, su validez será determinada al momento de su emisión, de acuerdo al artículo 353 del Reglamento de Prevención, Mitigación y Protección Contra Incendios.';
                break;
            case 4:
                $descripcion='Art. 23. – DE LA APROBACIÓN DE PLANOS. El cobro de la tasa por la revisión de planos de entidades fabriles, industriales, de concentración de público y de edificaciones, así como todo proyecto urbanístico que deba contar con sistemas de prevención y defensa contra incendios, en la jurisdicción del cantón Atacames, de acuerdo a lo que establece el artículo 53 de la Ley de Defensa Contra Incendios.';
                break;
            case 5:
                $descripcion='Art. 24. – DE LA INFRACCIONES Y MULTAS. Los valores que los ciudadanos deberán cancelar en el caso de cometimiento de infracciones se regirán en base a una tabla';
                break;

            default;
        }

        $data = new PagosOrdenanzaModel();
        $data->client_id                    = $id_cliente[0]->id;
        $data->tipoPago                     = 3;
        $data->formaPago_id                 = $request->input('formaspago');
        $data->year_now                     = $request->input('anio');
        $data->descripcion                  = $descripcion;
        $data->numTransaccion               = $request->input('num_transaccion');
        $data->numPermisoFuncionamiento     = $request->input('num_permiso');
        $data->docRespaldo                  = Null; //pago valor
        $data->valor                        = $request->input('valor'); //porcenta en porcentaje
        $data->estado                       = 7;
        $data->recargo                      = Null;
        $data->timestamps                   = Carbon::now();
        $data->save();

        // $data = new OtrosPagosModel();
        // $data->client_id                    = $id_cliente[0]->id;
        // $data->tipoPago                     = 6;
        // $data->formaPago_id                 = $request->input('formaspago');
        // $data->year_now                     = $request->input('anio');
        // $data->descripcion                  = $descripcion;
        // $data->numTransaccion               = $request->input('num_transaccion');
        // $data->numPermisoFuncionamiento     = $request->input('num_permiso');
        // $data->docRespaldo                  = Null; //pago valor
        // $data->valor                        = $request->input('valor'); //porcenta en porcentaje
        // $data->estado                       = 8;
        // $data->recargo                      = Null;
        // $data->timestamps                   = Carbon::now();
        // $data->save();

    /*    DB::table('client')->where('id', $id_cliente[0]->id)->update([
            'estado' => 7, // Se a generado la solicitud de pago del permiso de funcionamiento correctamente
            'updated_at'  => Carbon::now()
        ]);*/
        return back()->with('Respuesta', 'Se genero el PAGO correctamente.(IMPRECIÓN DE COMPROBANTES EN COLA)');
        // $descuento = 0;
        // if ($request->input('tipodescuento') == 'personalizado') {
        //     //imput oculto
        //     $descuento = $request->input('porcentajedescuento');
        // } else {

        //     $descuento = $request->input('tipodescuento');
        // }


        // $valor          = floatval($request->input('valor'));
        // $porcentaje     = floatval($request->input('porcenjatetasa'));
        // if ($request->input('tipodescuento') == '100') {
        //     //imput oculto
        //     $pago_valor = 2;
        // } else {


        //     $total = floatval($valor) + (floatval($valor) * (floatval($porcentaje) / 100));

        //     $pago_valor             = (floatval($valor) - (floatval($valor) * (floatval($descuento) / 100)));
        //     $porcentaje_descuento   = $pago_valor * ($porcentaje / 100);
        //     $total                  = $pago_valor + $porcentaje_descuento;
        // }





        // //$pago_valor = $request->input('valor') ;
        // $data = new otrosCotrosModel();
        // $data->razonSocial          = $request->input('nombreLocal');
        // $data->representanteLegal   = $request->input('representanteLegal');
        // $data->ruc                  = $request->input('ruc');
        // $data->direccion            = $request->input('direccion');
        // $data->telefono             = $request->input('telefono');
        // $data->formaPago_id         = 1; // efectivo
        // $data->descripcion          = $request->input('decripcion_mp_1');
        // $data->valor                = $pago_valor; //pago valor
        // $data->porcenjatetasa       = $request->input('porcenjatetasa'); //porcenta en porcentaje
        // $data->year_now             = $request->input('anioPago');
        // $data->estado               = 8;
        // $data->timestamps          = Carbon::now();
        // $data->save();

        // $auditoria = new AuditoriaModel();
        // $auditoria->user_id         = auth()->user()->id;
        // $auditoria->role_id         = auth()->user()->role->id;
        // $auditoria->modulo          = 'Otros Cobros';
        // $auditoria->descripcion     = 'Genera el pago de OTROS COBOS de la razonSocial ' . $request->input('nombreLocal') . ',valor: $ ' . round($total, 2) . ', descrpción ' . $request->input('descripcion');
        // $auditoria->accion          = 'Pago de anticipo';
        // $auditoria->valor           = (int) $request->input('ruc');
        // $auditoria->created_at      = Carbon::now();
        // $auditoria->save();

        // return back()->with('Respuesta', 'Se genero el PAGO correctamente.(IMPRECIÓN DE COMPROBANTES EN COLA)');
    }
}
