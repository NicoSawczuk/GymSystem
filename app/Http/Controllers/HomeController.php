<?php

namespace App\Http\Controllers;

use App\Gimnasio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Gimnasio $gimnasio)
    {   
        if (Gimnasio::where('user_id', Auth::id())->exists()){
            return view('home', compact('gimnasio'));
        }
        
    }

}
