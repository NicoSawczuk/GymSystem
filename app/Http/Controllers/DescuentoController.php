<?php

namespace App\Http\Controllers;

use App\Descuento;
use Illuminate\Http\Request;

class DescuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codigos = Descuento::all();
        return view('descuentos/administrar', compact('codigos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('descuentos/create');
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
            'codigo' => 'required|unique:descuentos',
            'porcentaje_descuento' => 'required|integer',
            'fecha_expiracion' => 'required|date',
            'detalle' => 'required',
        ]);

        $descuento = new Descuento();
        $descuento->codigo = strtoupper($request->codigo);
        $descuento->porcentaje_descuento = $request->porcentaje_descuento;
        $descuento->fecha_expiracion = $request->fecha_expiracion;
        $descuento->detalle = $request->detalle;

        $descuento->save();

        return redirect(route('descuentos.administrar'))->with('success', 'Código de descuento creado con éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function show(Descuento $descuento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function edit(Descuento $descuento, $slug)
    {
        $codigo = $descuento;
        return view('descuentos/edit', compact('codigo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Descuento $descuento, $slug)
    {
        $data = request()->validate([
            'codigo' => 'required|unique:descuentos,codigo,'.$descuento->id,
            'porcentaje_descuento' => 'required|integer',
            'fecha_expiracion' => 'required|date',
            'detalle' => 'required',
        ]);

        $descuento->update($data);

        return redirect(route('descuentos.administrar'))->with('success', 'Código de descuento '.$descuento->codigo.' modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $descuento = Descuento::where('id',$id)->first();

        if($descuento->delete()){
            return '1';
        }else{
            return '0';
        }
    }

    public function checkCodigo(Request $request){
        if (Descuento::where('codigo',$request->get('codigo'))->exists()){
            $descuento = Descuento::where('codigo',$request->get('codigo'))->first();
        }else{
            $descuento = 0;
        }

        return response()->json($descuento, 200);
    }
}
