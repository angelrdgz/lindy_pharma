<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSupply extends Model
{
    public function supply(){
        return $this->belongsTo('App\Supply');
    }
}
