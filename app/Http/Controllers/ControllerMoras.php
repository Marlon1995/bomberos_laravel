<?php

namespace App\Http\Controllers;

use App\ImpuestoTrimestralModel;
use App\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerMoras extends Controller
{

    function __construct() {
        $this->middleware(['authUser','roles:3']);
    }

    public function index(){
        $impuesto_trimestral = ImpuestoTrimestralModel::all()->where('estado','=','2');
        $data = System::all();
        return view('moras', compact('data', 'impuesto_trimestral'));
    }

    public function update(Request $request, $id){

        if($request->input('porcentaje') <  100 ) {

            DB::table('impuesto_trimestral')
                ->where('id', $id)
                ->update([
                    'porcentaje' => $request->input('porcentaje'),
                    'updated_at' => Carbon::now()
                ]);
            return back()->with('Respuesta', 'Se actualizo correctamente el nuevo porcentaje de recargo trimestral');

        }
        return back()->with('Respuesta_erro', 'Reintente, Ingrese un valor valido');

    }

    }
