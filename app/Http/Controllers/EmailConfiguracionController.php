<?php

namespace App\Http\Controllers;

use App\EmailConfiguracion;
use App\Gimnasio;
use App\Mail\CuotasUpdateMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmailConfiguracion  $emailConfiguracion
     * @return \Illuminate\Http\Response
     */
    public function show(EmailConfiguracion $emailConfiguracion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmailConfiguracion  $emailConfiguracion
     * @return \Illuminate\Http\Response
     */
    public function edit(Gimnasio $gimnasio)
    {
        

        return view('email_configuracion/configurar', compact('gimnasio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmailConfiguracion  $emailConfiguracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gimnasio $gimnasio)
    {
        $data = request()->validate([
            'asunto' => 'required',
            'contenido' => 'required',
            'remitente' => 'required',
        ]);

        if (EmailConfiguracion::where('gimnasio_id', $gimnasio->id)->exists()){
            $email = EmailConfiguracion::where('gimnasio_id', $gimnasio->id)->update($data);
        }else{
            $email = new EmailConfiguracion();

            if (request()->remitente != $gimnasio->email){
                $email->remitente = request()->remitente;
            }else{
                $email->remitente = $gimnasio->email;
            }
            $email->asunto = request()->asunto;
            $email->contenido = request()->contenido;
            $email->gimnasio_id = $gimnasio->id;
            $email->save();
        }
        return redirect('/email_configuracion/'.$gimnasio->id.'/edit/')->with('success','Configración de email automático actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmailConfiguracion  $emailConfiguracion
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailConfiguracion $emailConfiguracion)
    {
        //
    }
}
