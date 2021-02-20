<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    /**
     * predictPicoPlaca
     * @description Based on the plate number, date and a time the method will return whether or not that car can be on the road
     *
     * @param Request $request
     * @return array
     */
    public function predictPicoPlaca(request $request){
        $validation = Validator::make($request->all(), [
            'plateNumber' => 'required|min:6|max:7',
            'dateTime' => 'required',
        ]);

        if ($validation->passes()) {

        }else{
            return [
                'status' => 'error',
                'title' => 'Error',
                'message' => $validation->errors()->all()
            ];
        }
    }
}
