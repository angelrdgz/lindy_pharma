<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departure extends Model
{
    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function recipe(){
        return $this->belongsTo('App\Recipe');
    }

    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function user(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function exporter(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function items(){
        return $this->hasMany('App\DepartureItem', 'departure_id', 'id');
    }
}
