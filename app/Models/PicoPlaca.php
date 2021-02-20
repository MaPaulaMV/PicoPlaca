<?php

namespace App\Models;

class PicoPlaca
{
    //Properties
    public $plateNumber;
    public $date;

    //Construct
    public function __construct($plateNumber,$date)
    {
        $this->plateNumber = $plateNumber;
        $this->date = $date;
    }

    /**
     * @param mixed $plateNumber
     */
    public function setPlateNumber($plateNumber): void
    {
        $this->plateNumber = $plateNumber;
    }

    /**
     * @return mixed
     */
    public function getPlateNumber()
    {
        return $this->plateNumber;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    //Methods
    public function get_LastPlateNumber()
    {
        return substr($this->plateNumber,-1);
    }

    public function get_Day()
    {
        $strDate = explode(" ",$this->date);
        return $strDate[0];
    }

    /**
     * @return string
     */
    public function get_Time()
    {
        $strDate = explode(" ",$this->date);
        $strTime = $strDate[5];

        $newDate = new \DateTime($strTime);
        $time = $newDate->format('H:i:s');

        return $time;
    }


}
