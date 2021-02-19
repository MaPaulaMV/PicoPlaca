<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PicoPlacaController extends Controller
{
    /**
     * Index
     * @description show the view with the form to enter the data for the Pico&Placa prediction
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        return view('index');
    }

    public function predictPicoPlaca(request $request){

    }
}
