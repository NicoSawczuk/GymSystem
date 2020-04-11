<?php

namespace App\Http\Controllers;

use App\BajaCliente;
use App\Cliente;
use App\Cuota;
use App\Estado;
use App\Inscripcion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BajaClienteController extends Controller
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
        if ($cliente->activo == 1){

            $baja = new BajaCliente();

            $baja->cliente_id = $cliente->id;
            $baja->fecha_baja = Carbon::now();   
            $baja->monto_deuda = $cliente->getDeuda();
            $baja->detalle = request()->detalle;
            $baja->gimnasio_id = $cliente->gimnasio->id;
            $baja->especialidad_id = $cliente->especialidad->id;
            $baja->estado_id = $cliente->estado->id;

            $baja->save;

            $cliente->activo = 0;
            $cliente->especialidad_id = null;
            $cliente->estado_id = Estado::where('orden', 5)->value('id');
            $cliente->save();

            Cuota::where(['cliente_id' => $cliente->id, 'especialidad_id' => $cliente->especialidad->id, 'gimnasio_id' => $cliente->gimnasio->id])->orderBy('fecha_pago', 'desc')->update(['saldado' => 1]);

            Inscripcion::where(['cliente_id' => $cliente->id, 'especialidad_id' => $cliente->especialidad->id, 'gimnasio_id' => $cliente->gimnasio->id])->orderBy('fecha_inscripcion', 'desc')->update(['activo' => 0]);

            
            return redirect('/clientes/'.$cliente->id.'/perfil')->with('success', 'Cliente '.$cliente->nombre.' '.$cliente->apellido.' dado de baja con éxito');
        }else{
            return redirect('/clientes/'.$cliente->id.'/perfil')->with('error', 'No se pudo dar de baja a '.$cliente->nombre.' '.$cliente->apellido.' debido a que el mismo ya esta dado de baja');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BajaCliente  $bajaCliente
     * @return \Illuminate\Http\Response
     */
    public function show(BajaCliente $bajaCliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BajaCliente  $bajaCliente
     * @return \Illuminate\Http\Response
     */
    public function edit(BajaCliente $bajaCliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BajaCliente  $bajaCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BajaCliente $bajaCliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BajaCliente  $bajaCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(BajaCliente $bajaCliente)
    {
        //
    }
}
