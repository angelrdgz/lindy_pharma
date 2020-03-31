<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeSupply extends Model
{
    public function supply(){
        return $this->belongsTo('App\Supply');
    }
}
