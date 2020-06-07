<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cuota;
use App\Estado;
use App\Gimnasio;
use App\User;
use DateTime;
use Illuminate\Http\Request;

class CuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Gimnasio $gimnasio, $slug)
    {
        
        $cuotas = [];

        foreach ($gimnasio->user->gimnasios as $gym){
            foreach ($gym->cuotas as $cuota){
                array_push($cuotas, $cuota);
            }
        }
        

        return view('cuotas/administrar', compact("cuotas", "gimnasio"));
    }

    public function indexMisCuotas(Gimnasio $gimnasio, $slug)
    {
        $cuotas = $gimnasio->cuotas;
        return view('cuotas/administrarMisCuotas', compact('cuotas', 'gimnasio'));
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
                return redirect()->back()->with('error','No se pudo registrar el pago de la cuota, debido a que el monto ingresado es mayor que el monto que el cliente debe pagar');
            }else{
                //Puedo pagar cuanto sea
                $cuota = new Cuota();
                $cuota->monto_cuota = $cliente->especialidad->monto + $cliente->getDeuda();
                $cuota->monto_pagado = request()->monto;

                
                $fecha = date ( 'Y-m-d');

                //Le sumamos un mes
                $nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
                $nuevafecha = date ( 'Y-m-d' , $nuevafecha );

                $cuota->fecha_pago = $fecha;

                $cuota->fecha_pago_realizado = $fecha;

                $cuota->inscripcion_id = $cliente->getUltimaInscripcion()->id;

                if (request()->monto == ($cliente->especialidad->monto + $cliente->getDeuda())){
                    //Saldado
                    $cuota->saldado = 1;
                    $cuota->monto_deuda = 0;

                    $cliente->update(['estado_id'=> Estado::where('orden', 3)->value('id')]);

                    $cuota->gimnasio_id = request()->gimnasio;
                    $cuota->especialidad_id = $cliente->especialidad->id;
                    $cuota->cliente_id = $cliente->id;

                    $cuota->save();
                    
                    return redirect('/clientes/administrar/en_regla/'.request()->gimnasio)->with('success','Pago de '.$cliente->nombre.' '.$cliente->apellido.' registrado con éxito');

                }elseif(request()->monto < ($cliente->especialidad->monto + $cliente->getDeuda())){
                    //No saldado
                    $cuota->saldado = 0;
                    $cuota->monto_deuda = ($cliente->especialidad->monto + $cliente->getDeuda()) - request()->monto;
                    $cliente->update(['estado_id'=> Estado::where('orden', 4)->value('id')]);

                    $cuota->gimnasio_id = request()->gimnasio;
                    $cuota->especialidad_id = $cliente->especialidad->id;
                    $cuota->cliente_id = $cliente->id;

                    $cuota->save();
                    
                    return redirect('/clientes/administrar/en_deuda/'.request()->gimnasio)->with('success','Pago de '.$cliente->nombre.' '.$cliente->apellido.' registrado con éxito');
                }

            }
        }
        else{
            //No tiene deudas
            if (request()->monto > $cliente->especialidad->monto){
                //No puede pagar mas que lo que esta la especialidad
                return redirect()->back()->with('error','No se pudo registrar el pago de la cuota, debido a que el monto ingresado es mayor que el monto de la especialidad');
            }else{
                //Puedo pagar cuanto sea
                $cuota = new Cuota();
                $cuota->monto_cuota = $cliente->especialidad->monto + $cliente->getDeuda();
                $cuota->monto_pagado = request()->monto;

                
                $fecha = date ( 'Y-m-d');

                //Le sumamos un mes
                $nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
                $nuevafecha = date ( 'Y-m-d' , $nuevafecha );

                $cuota->fecha_pago = $fecha;

                $cuota->fecha_pago_realizado = $fecha;

                $cuota->inscripcion_id = $cliente->getUltimaInscripcion()->id;

                if (request()->monto == ($cliente->especialidad->monto + $cliente->getDeuda())){
                    //Saldado
                    $cuota->saldado = 1;
                    $cuota->monto_deuda = 0;
                    $cliente->update(['estado_id'=> Estado::where('orden',3)->value('id')]);

                    $cuota->gimnasio_id = request()->gimnasio;
                    $cuota->especialidad_id = $cliente->especialidad->id;
                    $cuota->cliente_id = $cliente->id;

                    $cuota->save();
                    
                    return redirect('/clientes/administrar/en_regla/'.request()->gimnasio)->with('success','Pago de '.$cliente->nombre.' '.$cliente->apellido.' registrado con éxito');

                }elseif(request()->monto < ($cliente->especialidad->monto + $cliente->getDeuda())){
                    //No saldado
                    $cuota->saldado = 0;
                    $cuota->monto_deuda = ($cliente->especialidad->monto + $cliente->getDeuda()) - request()->monto;
                    $cliente->update(['estado_id'=> Estado::where('orden', 4)->value('id')]);

                    $cuota->gimnasio_id = request()->gimnasio;
                    $cuota->especialidad_id = $cliente->especialidad->id;
                    $cuota->cliente_id = $cliente->id;

                    $cuota->save();
                    
                    return redirect('/clientes/administrar/en_deuda/'.request()->gimnasio)->with('success','Pago de '.$cliente->nombre.' '.$cliente->apellido.' registrado con éxito');
                }

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
        if ($cliente->getCuotaVencida() === 0){
            //Si la cuota no esta vencida quiere decir que el cliente tiene una deuda que no es una deuda del vencimiento de una cuota
            if (request()->monto > $cliente->getDeuda()){
                //Tiene deuda, pero no debe pagar mas que la deuda
                return redirect()->back()->with('error','No se pudo registrar el pago de la deuda, debido a que el monto ingresado es mayor que la deuda del cliente');
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
                    $cuota->save();
                    
                    return redirect('/clientes/administrar/en_regla/'.request()->gimnasio)->with('success','Pago de '.$cliente->nombre.' '.$cliente->apellido.' registrado con éxito');
                    
                }elseif(request()->monto < $cliente->getDeuda()){
                    //No saldado
                    $cuota->saldado = 0;
                    $cuota->monto_deuda -= request()->monto;
                    $cliente->update(['estado_id'=> Estado::where('orden', 4)->value('id')]);
                    $cuota->save();

                    return redirect('/clientes/administrar/en_deuda/'.request()->gimnasio)->with('success','Pago de '.$cliente->nombre.' '.$cliente->apellido.' registrado con éxito');
                }
    
            }
        }else{
            //El cliente tiene una deuda porque paso el mes y debe crearse una cuota nueva
            
            //Primero controlo que no pueda pagar mas que la deuda
            if (request()->monto > $cliente->getDeuda()){
                //Tiene deuda, pero no debe pagar mas que la deuda
                return redirect()->back()->with('error','No se pudo registrar el pago de la deuda, debido a que el monto ingresado es mayor que la deuda del cliente');
            }else{
                $cuota = new Cuota();

                $cuota->monto_cuota = $cliente->especialidad->monto;
                $cuota->monto_pagado = request()->monto;

                
                $fecha = date ( 'Y-m-d');
                $fecha_pago = Cuota::where('cliente_id', $cliente->id)->orderBy('fecha_pago', 'desc')->first()->value('fecha_pago');

                //Le sumamos un mes
                $nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha_pago ) ) ;
                $nuevafecha = date ( 'Y-m-d' , $nuevafecha );

                $cuota->fecha_pago = $nuevafecha;

                $cuota->fecha_pago_realizado = $fecha;

                $cuota->inscripcion_id = $cliente->getUltimaInscripcion()->id;

                if (request()->monto == $cliente->getDeuda()){
                    //Saldado
                    $cuota->saldado = 1;
                    $cuota->monto_deuda = request()->monto - $cliente->getDeuda();
                    $fecha = date ( 'Y-m-d');
                    $cuota->fecha_pago_deuda = $fecha;
                    $cliente->update(['estado_id'=> Estado::where('orden', 3)->value('id')]);

                    $cuota->gimnasio_id = request()->gimnasio;
                    $cuota->especialidad_id = $cliente->especialidad->id;
                    $cuota->cliente_id = $cliente->id;
                    $cuota->save();
                    
                    return redirect('/clientes/administrar/en_regla/'.request()->gimnasio)->with('success','Pago de '.$cliente->nombre.' '.$cliente->apellido.' registrado con éxito');
                    
                }elseif(request()->monto < $cliente->getDeuda()){
                    //No saldado
                    $cuota->saldado = 0;
                    $cuota->monto_deuda = $cliente->getDeuda() - request()->monto;
                    $cliente->update(['estado_id'=> Estado::where('orden', 4)->value('id')]);

                    $cuota->gimnasio_id = request()->gimnasio;
                    $cuota->especialidad_id = $cliente->especialidad->id;
                    $cuota->cliente_id = $cliente->id;
                    $cuota->save();

                    return redirect('/clientes/administrar/en_deuda/'.request()->gimnasio)->with('success','Pago de '.$cliente->nombre.' '.$cliente->apellido.' registrado con éxito');
                }
            }

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
