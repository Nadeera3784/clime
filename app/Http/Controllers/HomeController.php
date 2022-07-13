<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Weather\WeatherService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function wt(WeatherService $weatherService){
       $x = $weatherService->getData(array('latitude' => '6.927079', 'longitude' => '79.861244'));
       dd($x);
    }
}
