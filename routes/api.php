<?php

use Illuminate\Http\Request;
use App\DetalleRequerimiento;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
Route::post('create-form', function(Request $request) {

    $send['client_id']      = $request->input('client_id');
    $detReq['preguntas']    = $request->input('preguntas');

    $longitud = count($detReq['preguntas']);

    for ($i = 0; $i < $longitud; $i++) {
        $data = new DetalleRequerimiento();

        $data->client_id        = $send['client_id'];
        $data->requerimiento_id = $detReq['preguntas'][$i]['requerimiento_id'];
        $data->respuesta        = $detReq['preguntas'][$i]['respuesta'];
        $data->cantidad         = $detReq['preguntas'][$i]['cantidad'];
        $data->observacion      = $detReq['preguntas'][$i]['observacion'];
        $data->estado           = $detReq['preguntas'][$i]['estado'];

        $data->save();
    }
    return response()->json([
        'Respuesta' => 'El registro se inserto correctamente',
        'status' => 200
    ]);

});

*/





