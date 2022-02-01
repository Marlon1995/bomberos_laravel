<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailTrap extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data) {
        $this->asunto = $data['asunto'];
        $this->titulo = $data['titulo'];
        $this->para = $data['para'];
        $this->mensaje = $data['mensaje'];
        $this->posdata = $data['posdata'];
        $this->de = $data['de'];
        $this->rol = $data['rol'];
        $this->miCorreo = $data['miCorreo'];
        $this->telefono = $data['telefono'];
        $this->sistema = $data['sistema'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
         $data = array(
            "asunto" => $this->asunto,
            "titulo" => $this->titulo,
             "para" => $this->para,
             "mensaje" => $this->mensaje,
             "posdata" => $this->posdata,
             "de" => $this->de,
             "rol" => $this->rol,
             "miCorreo" => $this->miCorreo,
             "telefono" => $this->telefono,
             "sistema" => $this->sistema
        );
        return $this->view('mail',compact('data'));
    }
}
