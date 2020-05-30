<?php

namespace App\Http\Controllers;

use App\Especialidad;
use App\Gimnasio;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Gimnasio $gimnasio, $slug)
    {
        $especialidades = $gimnasio->user->especialidades;
        return view('/especialidades/administrar', compact('especialidades', 'gimnasio'));
    }

    public function indexMisEspecialidades(Gimnasio $gimnasio, $slug)
    {
        $especialidades = $gimnasio->especialidades;
        return view('/especialidades/administrarMisEspecialidades', compact('especialidades', 'gimnasio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Gimnasio $gimnasio, $slug)
    {
        return view('especialidades.create', compact('gimnasio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Gimnasio $gimnasio,  $slug)
    {
        $data = request()->validate(array(
            'nombre' => Rule::unique('especialidades')->where(function ($query) {
                return $query->where('user_id', Auth::id());
            }),
            'descripcion' => 'required',
            'monto' => 'required',
        ));

        $espe = new Especialidad();
        $espe->nombre = $request->nombre;
        $espe->descripcion = $request->descripcion;
        $espe->monto = $request->monto;
        $espe->user_id = Auth::id();
        $espe->save();

        return redirect('/especialidades/' . $gimnasio->id .'-'.$slug.'/administrar')->with('success', 'Especialidad agregada con éxito');
    }

    public function storeAjax(Request $request)
    {
        if (request()->ajax()){
            $validator = Validator::make(
                array(
                    'nombre' => $request->get('nombre'),
                    'monto' => $request->get('monto'),
                    'descripcion' => $request->get('descripcion')
                ),
                array(
                    'nombre' => Rule::unique('especialidades')->where(function ($query) {
                        return $query->where('user_id', Auth::id());
                    }),
                    'monto' => 'required',
                    'descripcion' => 'required',
                )
            );
    
            if ($validator->fails()) {
                return $validator->errors()->all();
            } else {
                $data = [
                    'nombre' => $request->get('nombre'),
                    'monto' => $request->get('monto'),
                    'descripcion' => $request->get('descripcion'),
                    'user_id' => Auth::id()
                ];
                Especialidad::create($data);
                return '1';
            }
        }
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
    public function edit(Gimnasio $gimnasio, $slug1, Especialidad $especialidad, $slug2)
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
    public function update(Request $request, Especialidad $especialidad, $slug)
    {
        $data = request()->validate([
            'nombre' => [ 
                'required', 
                Rule::unique('especialidades', 'user_id')->ignore($especialidad->user_id), 
            ],
            'descripcion' => 'required',
            'monto' => 'required',
        ]);

        $especialidad->update($data);
        $gimnasio = Gimnasio::where('id', $request->gimnasio)->first();

        return redirect('/especialidades/' . $gimnasio->id . '-'.$gimnasio->slug().'/administrar')->with('success', 'Especialidad modificada con éxito');
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

        if ($especialidad->gimnasios->count() > 0) {
            return '0';
        } else {
            $especialidad->delete();
            return '1';
        }
    }

    public function estadistica(Gimnasio $gimnasio, $slug)
    {


        return view('especialidades/estadistica');
    }
}
