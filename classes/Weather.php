<?php
// require_once("City.php");
// require_once("Request.php");
class Weather{
    private $city;
    private $description;
    private $windSpeed;
    private $humidity;
    private $isSet;
    private $apikey;
    public function __construct($city,$apikey = "150fa9c0b2a2e7701490832a90cee56f")
    {
        $this->city = $city;
        $this->isSet = false;
        $this->apikey = $apikey;
        $this->getWeather();
    }
    private function getWeather(){
        
        $url = "https://api.openweathermap.org/data/2.5/weather?APPID=".$this->apikey."&q=".$this->city;
        $request = new Request($url);
        $request->send();
        if ($request->isSent() && $request->getCode() == 200){
            $response = $request->getResponse();
            if ($response){
                $response_json = json_decode($response,true);
                if (intval($response_json['cod']) == 200){
                    // echo "<pre>";
                    // var_dump($response_json);
                    // echo "</pre>";
                    $this->description = $response_json['weather'][0]['description'];
                    $this->windSpeed = $response_json['wind']['speed'];
                    $this->humidity = $response_json['main']['humidity'];
                    $this->isSet = true;
                }
            }

        }
    }
    public function getDescription(){
        return $this->description;
    }
    public function getWindSpeed(){
        return $this->windSpeed;
    }
    public function getHumidity(){
        return $this->humidity;
    }
    public function isSet(){
        return $this->isSet;
    }
}