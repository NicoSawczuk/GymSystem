<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cuota;
use App\Estado;
use DateTime;
use Illuminate\Http\Request;

class CuotaController extends Controller
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
    public function create(Cliente $cliente)
    {

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

        //Si el cliente no tiene deudas controlo que no puedan ingresar mas de lo necesario
        if ($cliente->getDeuda() > 0){
            if (request()->monto > ($cliente->especialidad->monto + $cliente->getDeuda())){
                //Tiene deuda, pero no debe excederse del monto + la deduda
                return redirect('clientes/administrar/'.$cliente->gimnasio_id)->with('error','No se pudo registrar el pago de la cuota, debido a que el monto ingresado es mayor que el monto que el cliente debe pagar');
            }else{
                //Puedo pagar cuanto sea
                $cuota = new Cuota();
                $cuota->monto_cuota = $cliente->especialidad->monto;
                $cuota->monto_pagado = request()->monto;

                
                $fecha = date ( 'Y-m-d');

                //Le sumamos un mes
                $nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
                $nuevafecha = date ( 'Y-m-d' , $nuevafecha );

                $cuota->fecha_pago = $nuevafecha;

                $cuota->fecha_pago_realizado = $fecha;

                if (request()->monto == ($cliente->especialidad->monto + $cliente->getDeuda())){
                    //Saldado
                    $cuota->saldado = 1;
                    $cuota->monto_deuda = request()->monto - $cliente->getDeuda();
                    $cliente->update(['estado_id'=> Estado::where('orden', 3)->value('id')]);

                }elseif(request()->monto < ($cliente->especialidad->monto + $cliente->getDeuda())){
                    //No saldado
                    $cuota->saldado = 0;
                    $cuota->monto_deuda += $cliente->especialidad->monto - request()->monto;
                    $cliente->update(['estado_id'=> Estado::where('orden', 4)->value('id')]);
                }

                $cuota->gimnasio_id = request()->gimnasio;
                $cuota->especialidad_id = $cliente->especialidad->id;
                $cuota->cliente_id = $cliente->id;

                $cuota->save();
                return redirect('clientes/administrar/'.$cliente->gimnasio_id)->with('succes','Pago registrado con éxito');
            }
        }
        else{
            //No tiene deudas
            if (request()->monto > $cliente->especialidad->monto){
                //No puede pagar mas que lo que esta la especialidad
                return redirect('clientes/administrar/'.$cliente->gimnasio_id)->with('error','No se pudo registrar el pago de la cuota, debido a que el monto ingresado es mayor que el monto de la especialidad');
            }else{
                //Puedo pagar cuanto sea
                $cuota = new Cuota();
                $cuota->monto_cuota = $cliente->especialidad->monto;
                $cuota->monto_pagado = request()->monto;

                
                $fecha = date ( 'Y-m-d');

                //Le sumamos un mes
                $nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
                $nuevafecha = date ( 'Y-m-d' , $nuevafecha );

                $cuota->fecha_pago = $nuevafecha;

                $cuota->fecha_pago_realizado = $fecha;

                if (request()->monto == ($cliente->especialidad->monto + $cliente->getDeuda())){
                    //Saldado
                    $cuota->saldado = 1;
                    $cuota->monto_deuda = request()->monto - $cliente->getDeuda();
                    $cliente->update(['estado_id'=> Estado::where('orden',3)->value('id')]);

                }elseif(request()->monto < ($cliente->especialidad->monto + $cliente->getDeuda())){
                    //No saldado
                    $cuota->saldado = 0;
                    $cuota->monto_deuda += $cliente->especialidad->monto - request()->monto;
                    $cliente->update(['estado_id'=> Estado::where('orden', 4)->value('id')]);
                }

                $cuota->gimnasio_id = request()->gimnasio;
                $cuota->especialidad_id = $cliente->especialidad->id;
                $cuota->cliente_id = $cliente->id;

                $cuota->save();
                return redirect('clientes/administrar/'.$cliente->gimnasio_id)->with('succes','Pago registrado con éxito');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function show(Cuota $cuota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuota $cuota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $data = request()->validate([
            'monto' => 'required'
        ]);

        if (request()->monto > $cliente->getDeuda()){
            //Tiene deuda, pero no debe pagar mas que la deuda
            return redirect('clientes/administrar/'.$cliente->gimnasio_id)->with('error','No se pudo registrar el pago de la deuda, debido a que el monto ingresado es mayor que la deuda del cliente');
        }else{
            //Puedo pagar cuanto sea
            $cuota = Cuota::where('cliente_id', $cliente->id)->orderBy('fecha_pago_realizado', 'desc')->first();

            if (request()->monto == $cliente->getDeuda()){
                //Saldado
                $cuota->saldado = 1;
                $cuota->monto_deuda = request()->monto - $cliente->getDeuda();
                $fecha = date ( 'Y-m-d');
                $cuota->fecha_pago_deuda = $fecha;
                $cliente->update(['estado_id'=> Estado::where('orden', 3)->value('id')]);
                
            }elseif(request()->monto < $cliente->getDeuda()){
                //No saldado
                $cuota->saldado = 0;
                $cuota->monto_deuda -= request()->monto;
                $cliente->update(['estado_id'=> Estado::where('orden', 4)->value('id')]);
            }

            $cuota->save();
            return redirect('clientes/administrar/'.$cliente->gimnasio_id)->with('succes','Pago registrado con éxito');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuota $cuota)
    {
        //
    }
}
