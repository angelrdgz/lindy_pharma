<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrance extends Model
{
    public function items(){
        return $this->hasMany('App\EntranceItem', 'entrance_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
