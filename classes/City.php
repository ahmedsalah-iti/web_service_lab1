<?php
require_once("Weather.php");
class City{
    private $name;
    private $weather;
    public function __construct($name)
    {
        $this->name = $name;
        // $this->getWeather();
    }
    public function __toString(): string {
        return $this->name;
    }
    public function checkWeather(){
        $weather = new Weather($this);
        if ($weather->isSet()){
            $this->weather = $weather;
        }else{
            $this->weather = null;
        }
    }
    public function hasWeather(){
        return $this->weather != null;
    }
    public function getWeather(){
        return $this->weather;
    }

}