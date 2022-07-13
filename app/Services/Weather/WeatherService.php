<?php

namespace App\Services\Weather;

use GuzzleHttp\Client;
use App\Models\UserWeatherEntry;
use Illuminate\Support\Facades\Log;

class WeatherService {

    public $client;

    public function __construct(){
       $this->client = new Client(['base_uri' => 'https://api.openweathermap.org/data/2.5/onecall']);
    }

    public function getAll(){
        return UserWeatherEntry::all();
    }

    public function getById($id){
        return UserWeatherEntry::find($id);
    }
    
    public function getByUserId($params){
        $entries = UserWeatherEntry::where('user_id', $params['user_id']);
        if (isset($params['order_by_value']) && !empty($params['order_by_value'])) {
            $entries = $entries->orderBy('value', 'desc');
        }else{
            $entries = $entries->orderBy('id', 'desc'); 
        }
        $entries = $entries->get();
        return $entries;
    }

    public function create($data){
        return UserWeatherEntry::create($data);
    }

    public function update($data, $id){
        $userweatherentry = $this->getById($id);
        return $userweatherentry->update($data);
    }

    public function delete($id){
        $userweatherentry = $this->getById($id);
        return $userweatherentry->delete();
    }

    public function getData($params){
        $context = ['context'=>__CLASS__.'::'.__FUNCTION__];
        try {
            $paramBuilder = [
                'query' => [
                   'lat' => $params['latitude'],
                   'lon' => $params['longitude'],
                   'appid' => config('services.weather.api_key'),
                   'exclude' => 'minutely,hourly,daily',
                   'units' => 'metric'//metric => Celsius,
                ]
             ];
            $response = $this->client->request('GET','', $paramBuilder);
            return json_decode($response->getBody()->getContents()); 
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), $context);
            return null;
        }
    }
}