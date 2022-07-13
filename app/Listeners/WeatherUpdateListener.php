<?php
 
namespace App\Listeners;
 
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;
use App\Services\City\CityService;
use App\Services\Weather\WeatherService;
use Auth;

class WeatherUpdateListener {

    public $cityService;
    public $weatherService;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CityService $cityService, WeatherService $weatherService){
        //
        $this->cityService    = $cityService;
        $this->weatherService = $weatherService;
    }
 
    /**
     * Handle the event.
     *
     * @param  \App\Events\Login  $event
     * @return void
     */
    public function handle(Login $event){
        $cities = $this->cityService->getAll();
        foreach($cities as $city){
            $weatherData = $this->weatherService->getData(array('latitude' => $city->latitude, 'longitude' => $city->longitude));
            if($weatherData){
                $user = Auth::user();
                $this->weatherService->create(array(
                    'user_id' => $user->id,
                    'city_id' => $city->id,
                    'value'   => $weatherData->current->temp
                ));
            }
        }
    }
}