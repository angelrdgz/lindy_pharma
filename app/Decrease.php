<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decrease extends Model
{
    public function departure(){
        return $this->belongsTo('App\Departure', 'departure_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function supplies(){
        return $this->hasMany('App\DecreaseSupply', 'decrease_id', 'id');
    }
}
