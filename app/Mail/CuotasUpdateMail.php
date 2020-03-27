<?php

namespace App\Mail;

use App\Gimnasio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CuotasUpdateMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    // $data = array(
    //     'remitente'         =>   $gimnasio->email_configuracion->remitente,
    //     'asunto'            =>   $gimnasio->email_configuracion->asunto,
    //     'contenido'         =>   $gimnasio->email_configuracion->contenido,
    //     'nombre_remitente'            =>   $gimnasio->nombre,
    //     'detalle_monto'     =>   $gimnasio->email_configuracion->detalle_monto
    // );

    // Mail::to('nico.290698@gmail.com')->send(new CuotasUpdateMail($data));

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject($this->data['asunto'])->from($this->data['remitente'], $this->data['nombre_remitente'])->view('email_configuracion.email');
    }
}
