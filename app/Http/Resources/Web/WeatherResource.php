<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class WeatherResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request){
        return [
            'id' => $this->id,
            'date' => Carbon::parse($this->created_at)->format('l d M, Y h:i A'),
            'celsius' => $this->value .'°C',
            'fahrenheit' => $this->CelsiusToFahrenheit($this->value) . '°F',
        ];
    }

    private function CelsiusToFahrenheit($given_value){
	   $fahrenheit = $given_value*9/5+32;
	   return round($fahrenheit, 1) ;
    }
}
