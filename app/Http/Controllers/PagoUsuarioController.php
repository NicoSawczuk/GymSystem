<?php

namespace App\Http\Controllers;

use App\CuotaUsuario;
use App\Descuento;
use App\MontoMensual;
use App\PagoUsuario;
use App\User;
use Carbon\Carbon;
use MercadoPago;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagoUsuarioController extends Controller
{
    public function index (){
        return view('pagos.index');
    }

    public function finalizarPago(Request $request){


        $user = User::where('id',$request->get('user_id'))->first();

        $now = Carbon::now();
        $monto_mensual_sin_procesar = MontoMensual::where(['mes' => $now->month, 'ano' => $now->year])->get('monto');

        if ($request->get('discount_code') != ''){
            //Si es distinto, es porque canjeo un codigo y tengo que disminuir el monto mensual

            //Obtengo el codigo de descuento
            if (Descuento::where('codigo',$request->get('discount_code'))->exists()){
                $descuento = Descuento::where('codigo',$request->get('discount_code'))->first();
                $monto = $monto_mensual_sin_procesar[0]->monto - ( $monto_mensual_sin_procesar[0]->monto / (float)$descuento->porcentaje_descuento);
            }else{
                $descuento = 0;
                $monto = $monto_mensual_sin_procesar[0]->monto;
            }

            
        }else{
            //Si no es distinto, tengo que dejar el monto mensual
            $descuento = 0;
            $monto = $monto_mensual_sin_procesar[0]->monto;
        }


        MercadoPago\SDK::setAccessToken(env('MP_TOKEN_TEST'));

        $payment = new MercadoPago\Payment();
        
        $payment->transaction_amount = $monto;
        $payment->token = $request->get('token');
        $payment->description = "Pago de ".$user->name." ".$user->apellido." de la cuota de ".$now->month."/".$now->year;
        $payment->installments = (int)$request->get('installments');
        $payment->payment_method_id = $request->get('paymentMethodId');
        $payment->issuer_id = (int)$request->get('issuer');

        $payer = new MercadoPago\Payer();
        
        $payer->email = $request->get('email');
        $payer->firstname = $user->name;
        $payer->lastname = $user->apellido;
        $payer->identification = array( 
            "type" => $request->get('docType'),
            "number" => $request->get('docNumber')
        );
        $payer->save();
        $payment->payer = $payer;

        $payment->save();

        //Ahora debo verificar si el pago se realizó correctamente, si así fue debo registrar la cuota y el pago en mi base de datos

        if ($payment->status === "approved"){
            //Registrar la cuota
            $cuota = new CuotaUsuario();
            $fecha = date ( 'Y-m-d');
            
            $nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
            $cuota->fecha_inicio = $fecha;
            $cuota->fecha_vencimiento = $nuevafecha;
            $cuota->monto_cuota = $monto_mensual_sin_procesar;
            $cuota->monto_pagado = $monto;
            $cuota->detalle = "Pago de ".$user->name." ".$user->apellido." de la cuota de ".$now->month."/".$now->year; 
            $cuota->user_id = $user->id;
            if($descuento != 0){
                $cuota->descuento_id = $descuento->id;
            }
            $cuota->save();


            //Registro el pago mensual
            $pago = new PagoUsuario();
            $pago->monto_pago = $monto;
            $pago->tipo_pago = $payment->payment_method_id;
            $pago->detalle = "Pago de ".$user->name." ".$user->apellido." de la cuota de ".$now->month."/".$now->year;
            $pago->user_id = $user->id;
            $pago->cuotas_usuarios_id = $cuota->id;
            $pago->save();

            //Le asigno el rol de Encargado
            //auth()->user()->assignRoles('encargado');

        }


        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        );
        return json_encode($response);

    }
}
