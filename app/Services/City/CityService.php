<?php

namespace App\Services\City;

use App\Models\City;

class CityService {

    public function getAll(){
        return City::all();
    }

    public function getById($id){
        return City::find($id);
    }
    
    public function getByName($name){
        return City::where('name', $name)->get();
    }

    public function create($data){
        return City::create($data);
    }

    public function update($data, $id){
        $city = $this->getById($id);
        return $city->update($data);
    }

    public function delete($id){
        $city = $this->getById($id);
        return $city->delete();
    }
}