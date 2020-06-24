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
}
