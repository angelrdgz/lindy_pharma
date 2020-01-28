<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function supplies(){
        return $this->hasMany('App\ProductSupply')->where('type', 1);
    }

    public function suppliesCover(){
        return $this->hasMany('App\ProductSupply')->where('type', 2);
    }
}
