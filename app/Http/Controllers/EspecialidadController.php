<?php

namespace App\Http\Controllers;

use App\Especialidad;
use App\Gimnasio;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Gimnasio $gimnasio)
    {
        $especialidades = Especialidad::all();
        return view('/especialidades/administrar', compact('especialidades', 'gimnasio'));
    }

    public function indexMisEspecialidades(Gimnasio $gimnasio)
    {
        $especialidades = $gimnasio->especialidades;
        return view('/especialidades/administrarMisEspecialidades', compact('especialidades', 'gimnasio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Gimnasio $gimnasio)
    {
        return view('especialidades.create', compact('gimnasio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'nombre' => 'required|unique:especialidades',
            'descripcion' => 'required',
            'monto' => 'required',
        ]);

        Especialidad::create($data);
        return redirect('/especialidades/'.request()->gimnasio.'/administrar')->with('success','Especialidad agregada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function show(Especialidad $especialidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Gimnasio $gimnasio, Especialidad $especialidad)
    {
        return view('especialidades/edit', compact('especialidad', 'gimnasio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Especialidad $especialidad)
    {
        $data = request()->validate([
            'nombre' => 'required|unique:especialidades,nombre,'.$especialidad->id,
            'descripcion' => 'required',
            'monto' => 'required',
        ]);

        $especialidad->update($data);

        return redirect('/especialidades/'.request()->gimnasio.'/administrar')->with('success', 'Especialidad modificada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $especialidad = Especialidad::where('id', $id)->first();

        if ($especialidad->gimnasios->count() > 0){
            return '0';
        }else{
            $especialidad->delete();
            return '1';
        }
    }
}
