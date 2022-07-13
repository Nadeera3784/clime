<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\Weather\WeatherService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\WeatherResource;

/**
 * @group Weather
 * 
 * Weather data or actions
 * 
 * @package clime
 * @subpackage Laravel
 * @version 1.0
 * 
 * @authenticated
 */ 
class WeatherController extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }

    /** 
     * Weather list 
     *
     * @urlParam order_by string  order_by. Example: value
     * @response {
     * status: success,
     * message: null,
     * data: []
     * }
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function index(Request $request, WeatherService $weatherService){
        $orderBy = null;
        if(!empty($request->order_by)){
            $orderBy = $request->order_by;
        }
        $weatherData = $weatherService->getByUserId(array('user_id' => auth()->user()->id, 'order_by_value' => $orderBy));
        $data = array();
        foreach($weatherData as $key => $value){
            $data[$value->city->name][] = new WeatherResource($value);
        }
        return response()->json(['type' => 'success', 'message' => null, 'data' => $data], 200);
    }

}
