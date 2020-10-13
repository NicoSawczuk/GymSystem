<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagoUsuarioController extends Controller
{
    public function index (){
        return view('pagos.index');
    }
}
