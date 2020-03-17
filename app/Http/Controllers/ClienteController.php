<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Especialidad;
use App\Estado;
use App\Gimnasio;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Client;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Gimnasio $gimnasio)
    {
        $clientes = Cliente::where('gimnasio_id', $gimnasio->id)->get();

        return view('/clientes/administrar', compact('clientes', 'gimnasio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Gimnasio $gimnasio)
    {
        $especialidades = $gimnasio->especialidades();
        return view('/clientes/create', compact('especialidades', 'gimnasio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Gimnasio $gimnasio)
    {
        $data = request()->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'telefono' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'fecha_nacimiento' => 'required|date',
            'altura' => 'required|numeric',
            'peso' => 'required|numeric',
            'especialidad' => 'required',
        ]);

        $cliente = new Cliente();
        
        $cliente->nombre = request()->nombre;
        $cliente->apellido = request()->apellido;
        $cliente->email = request()->email;
        $cliente->telefono = request()->telefono;
        $cliente->fecha_nacimiento = request()->fecha_nacimiento;
        $cliente->altura = request()->altura;
        $cliente->peso = request()->peso;

        $cliente->estado_id = Estado::where('orden', 1)->value('id');

        $cliente->especialidad_id = Especialidad::where('id',request()->especialidad)->value('id');

        $cliente->gimnasio_id = $gimnasio->id;

        $cliente->save();

        return redirect('clientes/administrar/'.$gimnasio->id)->with('success','Cliente creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
