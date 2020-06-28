<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cuota;
use App\Especialidad;
use App\Estado;
use App\Gimnasio;
use App\Mail\EnviarMailCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Client;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Gimnasio $gimnasio, $slug)
    {
        $clientes = Cliente::where('gimnasio_id', $gimnasio->id)->get();

        return view('/clientes/administrar', compact('clientes', 'gimnasio'));
    }

    public function indexEnDeuda(Gimnasio $gimnasio, $slug)
    {
        $clientes = Cliente::where([
                                    'gimnasio_id'=> $gimnasio->id,
                                    'estado_id' =>Estado::where('orden', 4)->value('id')
                                    ])->get();

        return view('/clientes/administrarEnDeuda', compact('clientes', 'gimnasio'));
    }

    public function indexEnRegla(Gimnasio $gimnasio, $slug)
    {
        $clientes = Cliente::where([
                                    'gimnasio_id'=> $gimnasio->id,
                                    'estado_id' =>Estado::where('orden', 3)->value('id')
                                    ])->get();

        return view('/clientes/administrarEnRegla', compact('clientes', 'gimnasio'));
    }

    public function indexNoInscripto(Gimnasio $gimnasio, $slug)
    {
        $clientes = Cliente::where([
                                    'gimnasio_id'=> $gimnasio->id,
                                    'estado_id' =>Estado::where('orden', 1)->value('id')
                                    ])->get();

        return view('/clientes/administrarNoInscripto', compact('clientes', 'gimnasio'));
    }

    public function indexInscripto(Gimnasio $gimnasio, $slug)
    {
        $clientes = Cliente::where([
                                    'gimnasio_id'=> $gimnasio->id,
                                    'estado_id' =>Estado::where('orden', 2)->value('id')
                                    ])->get();

        return view('/clientes/administrarInscripto', compact('clientes', 'gimnasio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Gimnasio $gimnasio, $slug)
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
    public function store(Request $request, Gimnasio $gimnasio, $slug)
    {
        $data = request()->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'sexo' => 'required',
            'cuil' => 'required|unique:clientes',
            'ocupacion' => 'required',
            'email' => 'required|email|unique:clientes',
            'telefono' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'fecha_nacimiento' => 'required|date',
            'altura' => 'required|numeric',
            'peso' => 'required|numeric',
        ]);

        $cliente = new Cliente();
        
        $cliente->nombre = request()->nombre;
        $cliente->apellido = request()->apellido;
        $cliente->cuil = request()->cuil;
        $cliente->email = request()->email;
        $cliente->telefono = request()->telefono;
        $cliente->fecha_nacimiento = request()->fecha_nacimiento;
        $cliente->altura = request()->altura;
        $cliente->peso = request()->peso;
        $cliente->sexo = request()->sexo;
        $cliente->ocupacion = request()->ocupacion;

        $cliente->estado_id = Estado::where('orden', 1)->value('id');

        //$cliente->especialidad_id = Especialidad::where('id',request()->especialidad)->value('id');

        $cliente->gimnasio_id = $gimnasio->id;

        $cliente->save();

        return redirect(route('clientes.administrar',[$gimnasio->id,$slug]))->with('success','Cliente '.$cliente->nombre.' '.$cliente->apellido.' creado con éxito');
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
    public function edit(Cliente $cliente, $slug1, Gimnasio $gimnasio, $slug2)
    {
        return view('/clientes/edit', compact('gimnasio', 'cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente, $slug)
    {
        $data = request()->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'sexo' => 'required',
            'cuil' => 'required|unique:clientes,cuil,'.$cliente->id,
            'ocupacion' => 'required',
            'email' => 'required|email|unique:clientes,email,'.$cliente->id,
            'telefono' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'fecha_nacimiento' => 'required|date',
            'altura' => 'required|numeric',
            'peso' => 'required|numeric',
        ]);

        $cliente->update($data);
        return redirect(route('clientes.administrar',[$cliente->gimnasio->id,$cliente->gimnasio->slug()]))->with('success','Información del cliente '.$cliente->nombre.' '.$cliente->apellido.' modificada con éxito');
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

    public function consultarDeuda(Request $request){
        $id = $request->get('id');
        $monto = Cuota::where('cliente_id', $id)->orderBy('fecha_pago_realizado', 'desc')->value('monto_deuda');
        return $monto;
    }

    public function perfil(Cliente $cliente, $slug){
        $gimnasio = $cliente->gimnasio;
        return view('clientes/perfil', compact('cliente', 'gimnasio'));
    }

    public function email(Cliente $cliente, $slug){
        $gimnasio = $cliente->gimnasio;
        return view('clientes/enviarEmail', compact('cliente', 'gimnasio'));
    }

    public function sendEmail(Request $request, Cliente $cliente, $slug){
        $gimnasio = $cliente->gimnasio;

        $data = request()->validate([
            'asunto'      => 'required',
            'contenido'      => 'required',

        ]);


        $dataMail = array(
        'remitente'         =>   $gimnasio->email_configuracion->remitente,
        'asunto'            =>   $data['asunto'],
        'contenido'         =>   $data['contenido'],
        'nombre_remitente'  =>   $gimnasio->nombre
        );


        Mail::to($cliente->email)->send(new EnviarMailCliente($dataMail));

        return redirect(route('clientes.perfil',[$cliente->id,$slug]))->with('success', 'Correo electrónico enviado con éxito');
    }

    public function getCliente(Request $request){

        $clieId = $request->get('clieId');
        $cliente = Cliente::where('id', $clieId)->first();
        if ($cliente->getCuotaVencida() == 1){
            return array($cliente,
                        ['espe'  => $cliente->especialidad->monto,
                        'deuda' =>$cliente->getDeuda() - $cliente->especialidad->monto,
                        'total' =>$cliente->getDeuda(),
                        'cuotaVencida' => $cliente->getCuotaVencida()]);
        }else{
            return array($cliente,
                        ['espe'  => $cliente->especialidad->monto,
                        'deuda' =>$cliente->getDeuda(),
                        'total' =>$cliente->getDeuda(),
                        'cuotaVencida' => $cliente->getCuotaVencida()]);
        }
            
    }
}
