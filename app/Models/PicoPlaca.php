<?php

namespace App\Models;

class PicoPlaca
{
    public $plateNumber;
    public $date;

    /**
     * PicoPlaca constructor.
     * @description constructor of the class PicoPlaca.
     *
     * @param $plateNumber
     * @param $date
     */
    public function __construct($plateNumber,$date)
    {
        $this->plateNumber = $plateNumber;
        $this->date = $date;
    }

    /**
     * setPlateNumber
     * @description set value of the plateNumber attribute.
     *
     * @param mixed $plateNumber
     */
    public function setPlateNumber($plateNumber): void
    {
        $this->plateNumber = $plateNumber;
    }

    /**
     * getPlateNumber
     * @description get the value of the plateNumber attribute.
     *
     * @return mixed
     */
    public function getPlateNumber()
    {
        return $this->plateNumber;
    }

    /**
     * setDate
     * @description set value of the date attribute.
     *
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * getDate
     * @description get the value of the date attribute.
     *
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * get_LastPlateNumber
     * @description get the las number of the PlateNumber attribute.
     *
     * @return false|string
     */
    public function get_LastPlateNumber()
    {
        return substr($this->plateNumber,-1);
    }

    /**
     * get_Day
     * @description get the Day of the date attribute.
     *
     * @return mixed|string
     */
    public function get_Day()
    {
        $strDate = explode(" ",$this->date);
        return $strDate[0];
    }

    /**
     * get_Time
     * @description get the time('H:i:s') of the date attribute.
     *
     * @return string
     * @throws \Exception
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
