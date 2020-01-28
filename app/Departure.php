<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departure extends Model
{
    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function user(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}