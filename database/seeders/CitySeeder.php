<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = array(
            array(
              'id' => 1,
              'name' => 'Colombo',
              'latitude' => '6.927079',
              'longitude' => '79.861244'
            ),
            array(
              'id' => 2,
              'name' => 'Melbourne',
              'latitude' => '-37.840935',
              'longitude' => '144.946457'
            )
        );

        foreach ($cities as $city){
            try{
                City::create($city);
            }catch (\Exception $exception){

            }
        }
    }
}
