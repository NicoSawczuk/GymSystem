<?php

namespace App\Http\Controllers;

use App\Gimnasio;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($gimnasio, $slug)
    {
        $gimnasio = Gimnasio::where('id',$gimnasio)->first();
        $usuarios = User::all();
        $roles = Role::all();
        $permisos = Permission::all();

        return view('usuarios/administrar', compact('gimnasio','usuarios','roles','permisos'));

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($usuario, $slug1, $gimnasio, $slug2)
    {

        if ($usuario != Auth::id()){
            $roles = Role::all();
            $permisos = Permission::all();
            $usuario = User::where('id', $usuario)->first();
            $gimnasio = Gimnasio::where('id', $gimnasio)->first();
            return view('usuarios/edit', compact('gimnasio','usuario','roles','permisos'));
        }else{
            return redirect(route('usuarios.administrar',[$gimnasio->id,$gimnasio->slug()]));
        }


        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $usuario, $slug)
    {
        $usuario = User::where('id', $usuario)->first();
        $usuario->permissions()->sync($request->permisos);

        $usuario->roles()->sync($request->roles);

        $gimnasio = Gimnasio::where('id',$request->gimnasio)->first();

        return redirect(route('usuarios.administrar',[$gimnasio->id,$gimnasio->slug()]))->with('success','Roles y permisos de '.$usuario->name.' '.$usuario->apellido.' modificados con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
