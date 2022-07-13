<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Weather\WeatherService;
use App\Services\City\CityService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WeatherService::class, function ($app) {
            return new WeatherService();
        });

        $this->app->singleton(CityService::class, function ($app) {
            return new CityService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
