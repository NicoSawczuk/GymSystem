<?php

namespace App\Http\Controllers;

use App\Gimnasio;
use App\ReporteConfiguracion;
use Illuminate\Http\Request;

class ReporteConfiguracionController extends Controller
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
     * @param  \App\ReporteConfiguracion  $reporteConfiguracion
     * @return \Illuminate\Http\Response
     */
    public function show(ReporteConfiguracion $reporteConfiguracion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReporteConfiguracion  $reporteConfiguracion
     * @return \Illuminate\Http\Response
     */
    public function edit(Gimnasio $gimnasio)
    {
        return view('reporte_configuracion/configurar', compact('gimnasio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReporteConfiguracion  $reporteConfiguracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gimnasio $gimnasio)
    {
        $data = request()->validate([
            'titulo'    => 'required',
            'calle'     => 'required|regex:/^[a-zA-Z\s]*$/',
            'altura'    => 'required|numeric',
            'ciudad'    => 'required',
            'provincia' => 'required',
            'pais'      => 'required',
            'telefono'  => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);

        if (request()->hasFile('logo')){
            request()->validate([
                'logo'  => 'required|file|image|max:3000',
            ]);
        }

        $configuracion = new ReporteConfiguracion();
        $configuracion->titulo = $request->titulo;
        $configuracion->calle = $request->calle;
        $configuracion->altura = $request->altura;
        $configuracion->ciudad = $request->ciudad;
        $configuracion->provincia = $request->provincia;
        $configuracion->pais = $request->pais;
        $configuracion->telefono = $request->telefono;

        $configuracion->gimnasio_id = $gimnasio->id;
        $configuracion->save();

        if (request()->has('logo')){
            $configuracion->update([
                'logo' => request()->logo->store('logos_reporte_configuracion', 'public'),
            ]);
        }
        return redirect('/reporte_configuracion/'.$gimnasio->id.'/edit')->with('success', 'Cabecera actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReporteConfiguracion  $reporteConfiguracion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReporteConfiguracion $reporteConfiguracion)
    {
        //
    }
}
