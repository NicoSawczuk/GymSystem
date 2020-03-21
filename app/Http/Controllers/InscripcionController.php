<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cuota;
use App\Especialidad;
use App\Estado;
use App\Inscripcion;
use DateTime;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Client;

class InscripcionController extends Controller
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
    public function store(Request $request, Cliente $cliente)
    {
        $data = request()->validate([
            'monto' => 'required'
        ]);

        //Creamos la inscripcion
        $inscripcion = new Inscripcion();

        $inscripcion->monto = request()->monto;
        $inscripcion->detalle = request()->detalle;

        $fecha = new DateTime();
        $inscripcion->fecha_inscripcion = $fecha->format('Y-m-d H:i:s');

        $inscripcion->gimnasio_id = request()->gimnasio;
        $inscripcion->especialidad_id = request()->especialidad;
        $inscripcion->cliente_id = request()->cliente;

        $inscripcion->save();

        //Cambiamos el estado del cliente
        $cliente->estado_id = Estado::where('orden',Estado::where('id',$cliente->estado_id)->value('orden')+1)->value('id');
        //Le asociamos la especialidad al cliente
        $cliente->especialidad_id = Especialidad::where('id',request()->especialidad)->value('id');
        
        $cliente->save();

        if (request()->cuota == 1){
            $cuota = new Cuota();
            $cuota->monto_cuota = Especialidad::where('id', $inscripcion->especialidad_id)->value('monto');
            $cuota->monto_pagado = request()->monto;

            //Controlamos si el cliente tiene deudas
            if ($cliente->getDeuda() > 0 ){
                //
            }else{
                //Si lo pagado es menor a lo que debe pagar debo registrar esa deuda
                if (Especialidad::where('id', $inscripcion->especialidad_id)->value('monto') > request()->monto) {
                    $cuota->monto_deuda = (Especialidad::where('id', $inscripcion->especialidad_id)->value('monto')) - (request()->monto);
                    $cliente->estado_id = Estado::where('orden',Estado::where('id',$cliente->estado_id)->value('orden')+2)->value('id');
                    $cliente->save();
                }

                //Deuda saldada
                if (Especialidad::where('id', $inscripcion->especialidad_id)->value('monto') == request()->monto) {
                    $cuota->saldado = 1;
                    //Volvemos a cambiar el estado del cliente a "En regla"
                    $cliente->estado_id = Estado::where('orden',Estado::where('id',$cliente->estado_id)->value('orden')+1)->value('id');
                    $cliente->save();
                }
            }

            $cuota->fecha_pago = $inscripcion->fecha_inscripcion;
            $cuota->fecha_pago_realizado = $fecha->format('Y-m-d H:i:s');

            $cuota->gimnasio_id = request()->gimnasio;
            $cuota->especialidad_id = request()->especialidad;
            $cuota->cliente_id = request()->cliente;

            $cuota->save();

            
        }


        return redirect('/clientes/administrar/'.request()->gimnasio)->with('success','Se completo la inscripción de '.Cliente::where('id', request()->cliente)->value('nombre').' '.Cliente::where('id', request()->cliente)->value('apellido'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function show(Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inscripcion $inscripcion)
    {
        //
    }
}
