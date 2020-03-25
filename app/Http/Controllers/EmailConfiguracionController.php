<?php

namespace App\Http\Controllers;

use App\EmailConfiguracion;
use App\Gimnasio;
use Illuminate\Http\Request;

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
    public function update(Request $request, EmailConfiguracion $emailConfiguracion)
    {
        //
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
