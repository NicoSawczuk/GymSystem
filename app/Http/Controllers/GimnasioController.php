<?php

namespace App\Http\Controllers;

use App\Cliente;
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

        $gimnasios = User::findOrFail(1)->gimnasios;
        
        Log::info('HOLA');
        return view('gimnasios/administrarGimnasios')->with(array(
            'gimnasios' => $gimnasios
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
        return view('gimnasios/create', compact('paises', 'especialidades'));
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


        return redirect('/gimnasios/administrar')->with('success','Gimnasio cargado con éxito');

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

        $especGim = []; //Los datos anteriores
        $especReq = $request->especialidades; //Los datos de edicion

        //Cargo el array de gym con los id
        foreach ($gimnasio->especialidades as $espe){
            array_push($especGim, $espe->id);
        }
        foreach ($especGim as $eG){
            if (!in_array($eG, $especReq)){
                if (Cliente::where('especialidad_id', $eG)->exists()){
                    return redirect('gimnasios/'.$gimnasio->id.'/edit')->with('error_espe' , 'La especialidad '.Especialidad::where('id', $eG)->value('nombre').' no se puede quitar del gimnasio porque existen clientes inscriptos a la misma');
                }
            }
        }
        $gimnasio->especialidades()->sync($request->especialidades);


        return redirect('/gimnasios/administrar')->with('success','Gimnasio modificado con éxito');

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

    public function ocultar(Request $request){
        $id = $request->get('id');
        $gimnasio = Gimnasio::where('id', $id)->first();

        if ($gimnasio->getClientes() === 0){
            $gimnasio->estado = 0;
            $gimnasio->save();
            return '1';
        }else{
            return '0';
        }

    }

    public function mostrar(Request $request){
        $id = $request->get('id');
        $gimnasio = Gimnasio::where('id', $id)->first();
        $gimnasio->estado = 1;
        $gimnasio->save();
        return '1';
    }

}
