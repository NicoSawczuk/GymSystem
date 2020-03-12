<?php

namespace App\Http\Controllers;



use App\Gimnasio;
use App\Especialidad;
use App\Pais;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;


class GimnasioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function index()
    {

        $gimnasios = \App\User::find(1)->gimnasios;

        $estado = '';
        return view('gimnasios/administrarGimnasios')->with(array(
            'gimnasios' => $gimnasios,
            'estado' => $estado
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $paises = Pais::all();
        foreach($paises as $pais){
            $pais->nombre = strtoupper($pais->nombre);
        }
        $especialidades = Especialidad::all();
        return view('gimnasios.create', compact('paises', 'especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {
        $data = request()->validate([
            'nombre' => 'required|unique:gimnasios',
            'calle' => 'required|regex:/^[a-zA-Z\s]*$/',
            'altura' => 'required',
            'pais' => 'required',
            'provincia' => 'required',
            'ciudad' => 'required',
        ]);


        $gym = new Gimnasio();


        $gym->nombre = $request->nombre;
        $gym->calle = $request->calle;
        $gym->altura = $request->altura;
        

        $gym->pais = strtoupper(Pais::where('id', $request->pais)->value('nombre'));
        $gym->provincia = \App\Provincia::where('id', $request->provincia)->value('nombre');
        $gym->ciudad = \App\Ciudad::where('id', $request->ciudad)->value('nombre');
        
        $gym->user_id = $user->id;
        $gym->save();

        
        $gym->especialidades()->sync($request->especialidades);


        return redirect('/gimnasios/administrar')->with('status','Gimnasio cargado con éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gimnasio  $gimnasio
     * @return \Illuminate\Http\Response
     */
    public function show(Gimnasio $gimnasio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gimnasio  $gimnasio
     * @return \Illuminate\Http\Response
     */
    public function edit(Gimnasio $gimnasio)
    {
        $paises = Pais::all();
        foreach($paises as $pais){
            $pais->nombre = strtoupper($pais->nombre);
        }
        $especialidades = Especialidad::all();
        return view('gimnasios.edit', compact('gimnasio','paises','especialidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gimnasio  $gimnasio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gimnasio $gimnasio)
    {
        $data = request()->validate([
            'nombre' => 'required|unique:gimnasios,nombre,'.$gimnasio->id,
            'calle' => 'required|regex:/^[a-zA-Z\s]*$/',
            'altura' => 'required',
            'pais' => 'required',
            'provincia' => 'required',
            'ciudad' => 'required',
        ]);


        $gimnasio->nombre = $request->nombre;
        $gimnasio->calle = $request->calle;
        $gimnasio->altura = $request->altura;
        

        $gimnasio->pais = strtoupper(Pais::where('id', $request->pais)->value('nombre'));
        $gimnasio->provincia = \App\Provincia::where('id', $request->provincia)->value('nombre');
        $gimnasio->ciudad = \App\Ciudad::where('id', $request->ciudad)->value('nombre');
        
        $gimnasio->save();
        $gimnasio->especialidades()->sync($request->especialidades);

        return redirect('/gimnasios/administrar')->with('status','Gimnasio modificado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gimnasio  $gimnasio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gimnasio $gimnasio)
    {
        //
    }

    //funcion ajax que devuelve la lista de provincias al seleccionar un pais
    public function pais(Request $request){

        $id = $request->get('id');

        $provinciasAux = \App\Provincia::where('pais_id', $id)
                                        ->orderBy('nombre', 'asc')
                                        ->get();
        $provincias = [];
        
        $i=0;
        foreach($provinciasAux as $provincia){
            $provincias[$i] = [$provincia->id, $provincia->nombre];
            $i+=1;
        }

        
        return $provincias;
        

    }


    //funcion ajax que devuelve la lista de ciudades al seleccionar una provincia
    public function provincia(Request $request){

        $id = $request->get('id');

        $ciudadesAux = \App\Ciudad::where('provincia_id', $id)
                                    ->orderBy('nombre', 'asc')
                                    ->get();
        $ciudades = [];
        


        $j=0;
        foreach($ciudadesAux as $ciudad){
            $ciudades[$j] = [$ciudad->id, $ciudad->nombre];
            $j+=1;
        }

        
        return $ciudades;
        

    }

}
