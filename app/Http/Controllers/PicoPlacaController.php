<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PicoPlaca;

class PicoPlacaController extends Controller
{
    /**
     * Index
     * @description show the view with the form to enter the data for the Pico&Placa prediction
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * predictPicoPlaca
     * @description Based on the plate number, date and a time the method will return whether or not that car can be on the road
     *
     * @param Request $request
     * @return array
     */
    public function predictPicoPlaca(request $request)
    {
        $validation = Validator::make($request->all(), [
            'plateNumber' => 'required|min:6|max:7',
            'dateTime' => 'required',
        ]);

        if ($validation->passes()) {

            $picoPlaca = new PicoPlaca($request->input('plateNumber'),$request->input('dateTime'));
            $lastNumber = $picoPlaca->get_LastPlateNumber();

            $day = $picoPlaca->get_Day();
            $time = $picoPlaca->get_Time();
            $goOut = true;

            switch ($day){
                case 'Lunes':
                    if($lastNumber === '1' || $lastNumber === '2'){
                        $goOut = $this->compareTimesPicoPlaca($time);
                    }
                    break;
                case 'Martes':
                    if($lastNumber === '3' || $lastNumber === '4'){
                        $goOut = $this->compareTimesPicoPlaca($time);
                    }
                    break;
                case 'Miércoles':
                    if($lastNumber === '5' || $lastNumber === '6'){
                        $goOut = $this->compareTimesPicoPlaca($time);
                    }
                    break;
                case 'Jueves':
                    if($lastNumber === '7' || $lastNumber === '8'){
                        $goOut = $this->compareTimesPicoPlaca($time);
                    }
                    break;
                case 'Viernes':
                    if($lastNumber === '9' || $lastNumber === '0'){
                        $goOut = $this->compareTimesPicoPlaca($time);
                    }
                    break;
                default:
                    break;
            }

            if($goOut){
                return [
                    'status' => 'success',
                    'title' => 'Puede Circular',
                    'message' => 'Su vehículo puede circular en la fecha y hora especificada.'
                ];
            }else{
                return [
                    'status' => 'warning',
                    'title' => 'No Puede Circular',
                    'message' => 'Su vehículo NO puede circular en la fecha y hora especificada.'
                ];
            }

        }else{
            return [
                'status' => 'error',
                'title' => 'Error',
                'message' => $validation->errors()->all()
            ];
        }
    }

    /**
     * CompareTimesPicoPlaca
     * @description compare the specified time with the Pico&Placa time limits
     *
     * @param $time
     * @return bool
     */
    public function compareTimesPicoPlaca($time)
    {
        $result = true;

        //7:00 am
        $time7 = new \DateTime("07:00");
        $time7 = $time7->format('H:i:s');

        //9:30 am
        $time9 = new \DateTime("09:30");
        $time9 = $time9->format('H:i:s');

        //16:00 pm
        $time16 = new \DateTime("16:00");
        $time16 = $time16->format('H:i:s');

        //19:30 pm
        $time19 = new \DateTime("19:30");
        $time19 = $time19->format('H:i:s');

        if(($time >= $time7 && $time <= $time9) || ($time >= $time16 && $time <= $time19)){
            $result = false;
        }

        return $result;
    }
}
