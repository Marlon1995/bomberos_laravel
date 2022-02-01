<?php

namespace App\Http\Controllers;

class MailController extends Controller
{
    function __construct() {
    $this->middleware(['authUser','roles:1,2,3,4,5']);
}

    public  function mail(){
        $data = array(
            "asunto" => "ASUNTO",
            "titulo" => "SOLICITUD DE MODIFICACION DE FORMULARIO DE INSPECCIÓN",
            "para" => "Sr(a). Secretario(a).",
            "mensaje" => "Solicito la autorización para la modificación del Formulario de Inspección de la Razón Social: XXXXXXXXXXXXXXXXXXX RUC: XXXXXX, para la respectiva corrección de información.",
            "posdata" => "Quedo atendo a su pronta respuesta, Atentamente.",
            "de"      => "Paúl Caguana",
            "rol"     => "Inpector(a)",
            "miCorreo" => "correo@cba.gob.ec",
            "telefono" => "234567890",
            "sistema" => "CUERPO DE BOMBEROS ATACAMES"


        );
        return view('mail', compact('data'));
    }


}
