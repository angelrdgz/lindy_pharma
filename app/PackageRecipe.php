<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageRecipe extends Model
{
    public $timestamps = false;
    protected $table = "package_recipes";

    public function recipe(){
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }

    public function package(){
        return $this->belongsTo('App\Package', 'package_id', 'id');
    }

    public function lots(){
        return $this->hasMany('App\PackageProductLot', 'package_recipe_id', 'id');
    }
}
