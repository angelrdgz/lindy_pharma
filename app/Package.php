<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}