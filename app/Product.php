<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function supplies(){
        return $this->hasMany('App\ProductSupply');
    }

    public function recipes(){
        return $this->hasMany('App\ProductRecipe');
    }
}
