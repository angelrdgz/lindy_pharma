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

    public function exporter(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function recipes(){
        return $this->hasMany('App\PackageRecipe');
    }

    public function supplies(){
        return $this->hasMany('App\PackageSupply');
    }
}
