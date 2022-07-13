<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWeatherEntry extends Model{

    protected $fillable = [
        'user_id',
        'city_id',
        'value'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
}
