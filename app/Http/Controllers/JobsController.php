<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
     public function recargoTrimestralBCE(){
        Log::info( "Igualación de data   hoy a las  ". date('h:i') );
        $res = DB::statement("INSERT INTO otros_pagos (client_id, tipoPago,formaPago_id, year_now, descripcion, valor, estado, created_at) 
                SELECT  	c.id 				AS client_id,
                            4 					AS tipoPago, 
                            1 					AS formaPago_id, 
                            YEAR(NOW())  	AS year_now,
                            CONCAT('Recargo del trimestre ',quarter(DATE_ADD(NOW(),INTERVAL -1 MONTH)),' por $',	CAST( ((it.porcentaje/100)*ta.valTasaAnual)  AS DECIMAL(10,3)))		AS descripcion,			
                            CAST( ((it.porcentaje/100)*ta.valTasaAnual)  AS DECIMAL(10,3)) AS valor,
                            7 					AS estado,
                            NOW()				AS created_at
                            
                            
                FROM pagos_tasas    					AS pt
                INNER JOIN client 					AS c 		ON c.id=pt.client_id
                INNER JOIN tasa_anual 				AS ta 	ON ta.id=pt.tasa_anual_id
                INNER JOIN impuesto_trimestral 	AS it 	ON quarter(DATE_ADD(pt.created_at,INTERVAL -0 MONTH))=it.trimestre
                
                WHERE pt.estado = 7 
                AND quarter(DATE_ADD(pt.created_at,INTERVAL -0 MONTH)) = quarter(DATE_ADD(NOW(),INTERVAL -1 MONTH))");


        return $res;

    }
}
