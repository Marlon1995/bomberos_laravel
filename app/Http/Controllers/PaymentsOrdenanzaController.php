<?php

namespace App\Http\Controllers;

use App\AuditoriaModel;
use App\Mail\MailTrap;
use App\PagosTasasModel;
use App\PagosOrdenanzaModel;
use App\Client;
use App\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade as PDF;


class PaymentsOrdenanzaController extends Controller
{

    function __construct()
    {
        $this->middleware(['authUser', 'roles:3,5,1']);
    }


    public function index()
    {
        $pagos = DB::table('client')
        
          
            ->join('pagos_ordenanza', 'pagos_ordenanza.client_id', 'client.id')
            ->where ('pagos_ordenanza.estado',7)
            ->select('client.id', 'client.ruc', 'client.razonSocial', 'client.representanteLegal',
                'pagos_ordenanza.valor','pagos_ordenanza.estado',
            
                'pagos_ordenanza.tipoPago')
               
                
            ->get();
          
        $clients = DB::table('client', 'cli')
          
            ->Join('pagos_ordenanza', function ($lj) {
                $lj->on('pagos_ordenanza.client_id', '=', 'cli.id');
                   // ->where('pagos_ordenanza.tipoPago', '<>', 3);
            })

            ->select('cli.id'
                , 'cli.ruc'
                , 'cli.razonSocial'
                , 'cli.representanteLegal'
                ,'pagos_ordenanza.descripcion'
                , 'cli.estado'
                , 'pagos_ordenanza.valor'
            )
            ->orderBy('pagos_ordenanza.created_at', 'DESC')
            ->get();
          


            $impuestos = DB::table('client')
            ->join('parroquias', 'parroquias.id', 'client.parroquia_id')
            ->join('pagos_ordenanza', 'pagos_ordenanza.client_id', 'client.id')
            ->select(
                'pagos_ordenanza.id',
                'client.razonSocial',
                'client.representanteLegal',
                'client.ruc',
                'client.barrio',
                'client.telefono',
                'parroquias.descripcion as parroquia',
                'client.referencia',
                'pagos_ordenanza.estado',
                'pagos_ordenanza.valor',
                DB::raw('TRIM(SUBSTRING_INDEX(pagos_ordenanza.descripcion, \'.\', 3)) as descripcion')
                /* , 'categorias.descripcion as categoria' */
                /* , 'denominaciones.descripcion as denominacion' */
            )
            ->whereIn('pagos_ordenanza.estado', [7,4])
            ->get();
           
           
        $formasPago = DB::table('formaspago')
            ->select('id', 'nombre')
            ->whereIn('estado', [2])
            ->orderBy('nombre', 'asc')
            ->get();


        $data = System::all();
        return view('payments-ordenanza', compact('data', 'pagos', 'clients', 'impuestos', 'formasPago'));
    }

    public function update(Request $request)
    {
        
  

                    $valor__tbPagos = $request->input('valor__tbPagos');
                    $id = $request->input('cliend_ida');
                    $numTransaccion = $request->input('numTransaccion');
                    $formaPago_id = $request->input('formaPago');
                
             
                    $numPermisoFuncionamiento = $request->input('numPermisoFuncionamiento');
                    $numTituloAdmin = $request->input('numTituloAdmin');


                    if($formaPago_id != 1 && $numTransaccion == 0 ){
                        return back()->with('Respuesta_wn', 'El número de transaccion es requerida');

                    }



                    DB::table('pagos_ordenanza')
                        ->where('id', $id)
                        ->where('estado', '=', 7)
                        ->update([
                            'estado' => 8, // pago total
                            'numTituloAdmin'=>$numTituloAdmin,
                            'numPermisoFuncionamiento'=>$numPermisoFuncionamiento,
                            'numTransaccion'=>$numTransaccion,
                            'formaPago_id'=>$formaPago_id,
                            'recargo'=> 0,
                            'updated_at' => Carbon::now()
                        ]);


                    $auditoria = new AuditoriaModel();
                    $auditoria->user_id = auth()->user()->id;
                    $auditoria->role_id = auth()->user()->role->id;
                    $auditoria->modulo = 'Pago Total Generado';
                    $auditoria->descripcion = 'Genera el pago Total del impuesto de tasa anual, cliente_id: ' . $id . ' y cambia a estado 8 que es pagado 100%, e inserta el valor pagado  $ ' . ($valor__tbPagos+2+1) . ' en';
                    $auditoria->accion = 'Pago Total';
                    $auditoria->valor = $id;
                    $auditoria->created_at = Carbon::now();
                    $auditoria->save();

                    $formasPago = DB::table('formaspago')
                        ->select('id', 'nombre')
                        ->whereIn('estado', [2])
                        ->whereIn('id', [$formaPago_id])
                        ->get();

                    $info_cli = DB::table('client')->select('*')->where('id', '=', $id)->get();

                    $body = array(
                        "asunto" => "COMPROBANTE DE PAGO",
                        "titulo" => "PAGO TOTAL DE IMPUESTO DE TASA ANUAL",
                        "para" => "Estimado(a). " . strtoupper($info_cli[0]->representanteLegal),
                        "mensaje" => "Ud, a realizado el pago TOTAL DEL IMPUESTO DE TASA ANUAL de la RAZÓN SOCIAL " . strtoupper($info_cli[0]->razonSocial) . ", con RUC: " . $info_cli[0]->ruc . " el valor de $" . $valor__tbPagos . ' en ' . $formasPago[0]->nombre.' y $2.00 del valor de la especie, valido hasta el 31 de diciembre del ', date('Y'),
                        "posdata" => "Saludos cordiales, Atentamente.",
                        "de" => auth()->user()->nombre . ' ' . auth()->user()->apellido,
                        "rol" => auth()->user()->role->role,
                        "miCorreo" => auth()->user()->email,
                        "telefono" => auth()->user()->telefono,
                        "sistema" => "CUERPO DE BOMBEROS ATACAMES"
                    );


                    Mail::to($info_cli[0]->email)->send(new MailTrap($body));


                    return back()->with('Respuesta', 'Se realizo el Pago TOTAL IMPUESTO ANUAL MARLON. (IMPRECIÓN DE COMPROBANTES EN COLA)');
                
    }


     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       

     

      /*  PagosOrdenanzaModel::where('id','=', $id)
                     //  ->whereIn("tipoPago",[3,6])
                       ->whereIn("estado",[7,8])
                       ->delete();
*/

       PagosOrdenanzaModel::where('id','=', $id)->update([
            'estado' => 4,
            'updated_at'  => Carbon::now()
        ]);




        $auditoria = new AuditoriaModel();
        $auditoria->user_id = auth()->user()->id;
        $auditoria->role_id = auth()->user()->role->id;
        $auditoria->modulo  = 'Pago Solicitud ANULADO';
        $auditoria->descripcion = 'Elimina pago  la SOLICITUD DE ANTICIPO del cliente_id: ' . $id;
        $auditoria->accion      = 'ANULAR PAGO';
        $auditoria->valor       = $id;
        $auditoria->created_at  = Carbon::now();
        $auditoria->save();
        

        return back()->with('Respuesta','EL PAGO FUE ANULADO!!.');
    
    }

    public function facturar(Request $request,$id)
    {


    
        $id = $request->input('cliend_ida');
        $numTransaccion = $request->input('numTransaccion');
        $formaPago_id = $request->input('formaPago');
    
 
        $numPermisoFuncionamiento = $request->input('numPermisoFuncionamiento');
        $numTituloAdmin = $request->input('numTituloAdmin');


        if($formaPago_id != 1 && $numTransaccion == 0 ){
            return back()->with('Respuesta_wn', 'El número de transaccion es requerida');

        }



        DB::table('pagos_ordenanza')
            ->where('id', $id)
            ->where('estado', '=', 7)
            ->update([
                'estado' => 8, // pago total
                'numTituloAdmin'=>$numTituloAdmin,
                'numPermisoFuncionamiento'=>$numPermisoFuncionamiento,
                'numTransaccion'=>$numTransaccion,
                'formaPago_id'=>$formaPago_id,
                'recargo'=> 0,
                'updated_at' => Carbon::now()
            ]);
      
    
      
    
        $auditoria = new AuditoriaModel();
        $auditoria->user_id = auth()->user()->id;
        $auditoria->role_id = auth()->user()->role->id;
        $auditoria->modulo  = 'Pago Facturado...';
        $auditoria->descripcion = 'Facturado cliente_id: ' . $id;
        $auditoria->accion      = 'FACTURAR PAGO';
        $auditoria->valor       = $id;
        $auditoria->created_at  = Carbon::now();
        $auditoria->save();
    
        return back()->with('Respuesta','EL PAGO FUE FACTURADO!!.');
    }


    public function emitir($id)
    {
      
    
        PagosOrdenanzaModel::where('id', '=', $id)->update([
            'estado' => 7,
            'updated_at'  => Carbon::now()
        ]);
    
        $auditoria = new AuditoriaModel();
        $auditoria->user_id = auth()->user()->id;
        $auditoria->role_id = auth()->user()->role->id;
        $auditoria->modulo  = 'Pago Emitido...';
        $auditoria->descripcion = 'Emitir cliente_id: ' . $id;
        $auditoria->accion      = 'EMITIR PAGO';
        $auditoria->valor       = $id;
        $auditoria->created_at  = Carbon::now();
        $auditoria->save();
    
        return back()->with('Respuesta','EL PAGO FUE EMITIDO!!.');
    }
}

