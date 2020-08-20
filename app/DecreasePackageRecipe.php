<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DecreasePackageRecipe extends Model
{
    public $timestamps = false;

    protected $table = "decrease_package_recipes";

    public function recipe(){
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }

    public function ots(){
        return $this->hasMany('App\DecreasePackageRecipeLot', 'decrease_package_recipe_id', 'id');
    }
}
