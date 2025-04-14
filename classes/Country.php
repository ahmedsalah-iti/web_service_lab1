<?php
require_once("City.php");
// require_once("Request.php");
class Country{
    private $name;
    private $cities = [];
    public function __construct($countryName)
    {
        $this->name = $countryName;
    }
    public function __toString(): string {
        return $this->name;
    }
    public function getName(){
        return $this->name;
    }
    public function getCities(){
        if (!$this->cities){
            $this->getCitiesByApi();
        }
        return $this->cities;
    }
    public function getCity($cityName){
        $citiesNames = $this->getCitiesNamesByApi();
        if (is_array($citiesNames) && count($citiesNames) > 1 && in_array($cityName,$citiesNames)){
            $city = new City($cityName);
            return $city;
        }else{
            return '';
        }
    }
    private function getCitiesByApi(){
        $cities_api_url = "https://countriesnow.space/api/v0.1/countries/cities/q?country=".$this->name;
        $request = new Request($cities_api_url);
        $request->send();
        if ($request->isSent() && $request->getCode() == 200){
            $response = $request->getResponse();
            if ($response){
                $response_json = json_decode($response,true);
                if (!$response_json['error']){
                    $citiesNames = $response_json['data'];
                    foreach ($citiesNames as $cityName){
                        $city = new City($cityName);
                        $this->cities[] = $city;
                    }
                }
            }
        }
    }
    private function getCitiesNamesByApi(){
        $cities_api_url = "https://countriesnow.space/api/v0.1/countries/cities/q?country=".$this->name;
        $request = new Request($cities_api_url);
        $request->send();
        if ($request->isSent() && $request->getCode() == 200){
            $response = $request->getResponse();
            if ($response){
                $response_json = json_decode($response,true);
                if (!$response_json['error']){
                    $citiesNames = $response_json['data'];
                    return $citiesNames;
                }
            }
        }
    }
}