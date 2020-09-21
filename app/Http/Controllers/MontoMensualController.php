<?php

namespace App\Http\Controllers;

use App\MontoMensual;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MontoMensualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $montos = MontoMensual::where('mes', '>', $now->month)->where('ano', '>=', $now->year)->get();

        return view('montos_mensuales/administrar', compact('montos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('montos_mensuales/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $request->year;

        for ($i = $month ; $i <= 12 ; $i++) { 
            if (!(MontoMensual::where(['mes'=> $i, 'ano'=>$year])->exists())){
                $montoMensual = new MontoMensual();
                $montoMensual->monto = $request->$i;
                $montoMensual->mes = $i;
                $montoMensual->ano = $year;
                $montoMensual->save();
            }else{
                return redirect(route('montosMensuales.administrar'))->with('error', 'No se pueden crear los montos mensuales porque ya existen');
            }
        }

        return redirect(route('montosMensuales.administrar'))->with('success', 'Montos mensuales cargados con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MontoMensual  $montoMensual
     * @return \Illuminate\Http\Response
     */
    public function show(MontoMensual $montoMensual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MontoMensual  $montoMensual
     * @return \Illuminate\Http\Response
     */
    public function edit(MontoMensual $montoMensual, $slug)
    {
        return view('montos_mensuales/edit', compact('montoMensual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MontoMensual  $montoMensual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MontoMensual $montoMensual, $slug)
    {
        $data = [
            'mes'   => $request->mes,
            'ano'   => $request->ano,
            'monto' => $request->monto
        ];
        $montoMensual->update($data);
        return redirect(route('montosMensuales.administrar'))->with('success', 'Monto mensual modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MontoMensual  $montoMensual
     * @return \Illuminate\Http\Response
     */
    public function destroy(MontoMensual $montoMensual)
    {
        //
    }

    //API

    public function getMonto(Request $request){
        $now = Carbon::now();
        $monto = MontoMensual::where(['mes' => $now->month, 'ano' => $now->year])->get('monto');

        return response()->json($monto, 200);
    }
}
