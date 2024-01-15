<?php

use App\Especies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'ControllerProfile@index');


Auth::routes();
Route::get('login', 'SystemController@login');
Route::get('logout', 'Auth\LoginController@logout');
Route::post('login', 'Auth\LoginController@login');
Route::get('config', 'ConfigController@index');

Route::resource('system', 'SystemController');
Route::resource('profile', 'ControllerProfile');

Route::resource('users', 'UserController');
Route::resource('rols', 'RolsController');
Route::resource('clients', 'ClientsController');
Route::resource('client', 'clients_secretariaController');


Route::resource('formulario', 'FormularioController');
Route::resource('clients-edit', 'FormularioController');
Route::get('inspecciones', 'DataController@inspecciones');
Route::resource('formulario-cliente-pdf', 'pdfClientesController');
Route::resource('permisos', 'PerisoFuncionamientoController');
Route::resource('permisos-ordenanza', 'PerisoFuncionamientoOrdenanzaController');

Route::resource('permiso-funcionamiento', 'PerisoFuncionamientoController');

Route::get('permiso/{id}', 'PerisoFuncionamientoController@pdf');

Route::get('permiso-ordenanzas/{id}', 'PerisoFuncionamientoOrdenanzaController@pdf');


Route::resource('payments', 'PaymentsController');
Route::resource('payments-ordenanzas', 'PaymentsOrdenanzaController');
Route::resource('different-payments', 'OtrosPagosController');

Route::get('cobro-ordenanza', 'OtrosPagosController@mostrar_pago_ordenanza');
Route::post('/agregar-cobro-ordenanza', 'OtrosPagosController@agregar_pago_ordenanza');

Route::get('history-payments', 'DataController@historialPagos');
Route::get('history-ordenanzas', 'DataController@historialOrdenanzas');

Route::get('bill-payments/{id}', 'DataController@facturaPago');
Route::get('bill-payments-ordenanzas/{id}', 'DataController@facturaPagoOrdenanzas');

Route::get('exoneraciones_artesano/{id}', 'DataController@exoneracion_artesano');
Route::get('exoneraciones_tercera/{id}', 'DataController@exoneracion_tercera');
Route::get('exoneraciones_discapacidad/{id}', 'DataController@exoneracion_discapacidad');
Route::get('bill-DiferentPayments/{id}', 'DataController@facturaPago2');
Route::get('especiesPayments/{id}', 'DataController@especiesPayments');


Route::resource('moras', 'ControllerMoras');
Route::resource('home', 'HomeController');
Route::resource('especies', 'EspeciesController');




Route::get('denomincacniones/{id}', 'DataController@denomincacniones');
Route::get('verificaRuc/{ruc}', 'DataController@verificaRuc');
Route::get('resumenPago/{id}', 'DataController@resumenPago');

Route::get('resumenPagoOrdenanzas/{id}', 'DataController@resumenPagoOrdenanzas');
Route::get('resumenInfoCliente/{id}', 'DataController@resumenInfoCliente');
Route::get('dashboard', 'DataController@dashboard');;



Route::get('report', 'ReporteController@index');
Route::get('reporte1', 'ReporteController@reporte1'); //ciere de caja diario
Route::get('cierre-caja-excel', 'ReporteController@cierreCajaExcel'); //ciere de caja diario
Route::get('noemitidos', 'ReporteController@noemitidos');

Route::get('reporte2', 'ReporteController@reporte2');
Route::get('reporte3', 'ReporteController@reporte3');
Route::get('reporte4', 'ReporteController@reporte4');
//Route::get('reporte5', 'ReporteController@reporte5'); // permisos
Route::get('reporteParroquias', 'ReporteController@reporteParroquias'); // permisos
Route::get('reportePorFechas', 'ReporteController@reportePorFechas'); // permisos
Route::get('reportePorFechasEspecies', 'ReporteController@reportePorFechasEspecies'); // permisos
Route::get('reportePorFechasTitulos', 'ReporteController@reportePorFechasTitulos'); // permisos


Route::get('report-date', 'ReporteController@reporte6'); // permisos

Route::get('report-date-especies', 'ReporteController@reporte5'); // permisos
Route::get('report-date-titulos', 'ReporteController@reporte8'); // permisos


Route::get('report-date-inspecciones', 'ReporteController@reporte9'); // permisos

Route::get('/report/pdf/{id}', 'ClientsController@pdfcliente');
Route::get('export/', 'ClientsController@export');

Route::get('reporte-general', 'ReporteController@reporte7');
Route::get('reporteContadorDiario/{tipo}/{fecha}', 'ReporteController@reporteContadorDiario'); //ciere de caja diario
Route::get('reporteContadorSemanal/{tipo}/{fechaInicial}/{fechaFinal}', 'ReporteController@reporteContadorSemanal'); //ciere de caja Semanal



Route::get('cajas', function (){

    $reporte = DB::table('otros_pagos')
    ->join('client', 'client.id', 'otros_pagos.client_id')
    ->join('tipos_pago', function ($join) {
        $join->on('tipos_pago.id', 'otros_pagos.tipoPago')
            ->where('tipos_pago.nombre', '<>', 'PAGO TOTAL');
    })
    ->leftJoin('formaspago', 'formaspago.id', 'otros_pagos.formaPago_id')
    ->select(   'ruc',
        'razonSocial',
        'formaspago.nombre as formaspago',
        'tipos_pago.nombre as tipos_pago',
        'valor',
        'year_now',
        'numPermisoFuncionamiento',
        'numTransaccion',
        'otros_pagos.created_at')
    ->whereNotIn('tipos_pago.id', [2])
   ->where('otros_pagos.estado','=', 8)
   ->where('otros_pagos.created_at','like', date("Y-m-d").'%' )
   ->orderBy('otros_pagos.created_at', 'desc')
   ->get();

        //return $cobros;
     $cero = 0;
    foreach( $reporte as $item ){
        $arrayDATA[] = [
        'fechaYHora'         => $item->created_at,
        'anio'               => $item->year_now,
        'numEspecie'         => $item->numPermisoFuncionamiento,
        'ruc'                => $item->ruc,
        'razonSocial'        => strtoupper($item->razonSocial),
        'formaPago'          => strtoupper($item->formaspago),
        'numTransaccion'     => $item->numTransaccion,
        'valorPermiso'       => $item->valor,
        'valorEspecie'       => 2,
        'calfArtesanal'      => $cero,
        'tercEdad'           => $cero,
        'discapacidad'       => $cero,
        '2018'               => $cero,
        '2019'               => $cero,
        'I'                  => $cero,
        'II'                 => $cero,
        'III'                => $cero,
        'IV'                 => $cero,
        'total'              => $item->valor,
        'bandera'            => 'pagos totates'
        ];
    }

    $cobros= DB::table('otros_cobros')
    ->leftJoin('formaspago','formaspago.id','otros_cobros.formaPago_id')
    ->select('ruc',
        'razonSocial',
        'formaspago.nombre as formaspago',
        'valor',
        'year_now',
        'numTransaccion',
        'porcenjatetasa',
        'otros_cobros.created_at')
    ->where('otros_cobros.created_at','like', date("Y-m-d").'%' )
    ->where('otros_cobros.estado','=',8)
    ->get();

    foreach( $cobros as $item ){
        $arrayDATA[] = [
        'fechaYHora'         => $item->created_at,
        'anio'               => $item->year_now,
        'numEspecie'         => '',
        'ruc'                => $item->ruc,
        'razonSocial'        => strtoupper($item->razonSocial),
        'formaPago'          => strtoupper($item->formaspago),
        'numTransaccion'     => $item->numTransaccion,
        'valorPermiso'       => $cero,
        'valorEspecie'       => 2,
        'calfArtesanal'      => $cero,
        'tercEdad'           => $cero,
        'discapacidad'       => $cero,
        '2018'               => ($item->year_now==='2018')?$item->valor:$cero,
        '2019'               => ($item->year_now==='2019')?$item->valor:$cero,
        'I'                  => $cero,
        'II'                 => $cero,
        'III'                => $cero,
        'IV'                 => $cero,
        'total'              => ($item->valor),
        'bandera'            => 'otros cobros'

        ];
    }



    $especie = Especies::where('estado','=','1')
    ->where('created_at','like', date("Y-m-d").'%' )
    ->get();
    foreach( $especie as $item ){
        $arrayDATA[] = [
        'fechaYHora'         => $item->created_at,
        'anio'               => date("Y", strtotime($item->created_at)),
        'numEspecie'         => $item->especie,
        'ruc'                => $item->ruc,
        'razonSocial'        => strtoupper($item->razonSocial),
        'formaPago'          => 'EFECTIVO',
        'numTransaccion'     => '',
        'valorPermiso'       => $cero,
        'valorEspecie'       => ($item->valor * $item->cantidad),
        'calfArtesanal'      => $cero,
        'tercEdad'           => $cero,
        'discapacidad'       => $cero,
        '2018'               => $cero,
        '2019'               => $cero,
        'I'                  => $cero,
        'II'                 => $cero,
        'III'                => $cero,
        'IV'                 => $cero,
        'total'              => ($item->valor * $item->cantidad),
        'bandera'            => 'especies'

        ];
    }

    return view('report/cierreCajaExcel', compact('arrayDATA'));
});




