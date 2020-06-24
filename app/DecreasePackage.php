<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DecreasePackage extends Model
{
    protected $table = "decreases_packages";

    public function package(){
        return $this->belongsTo('App\Package', 'package_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function recipes(){
        return $this->hasMany('App\DecreasePackageRecipe', 'decrease_package_id', 'id');
    }

    public function supplies(){
        return $this->hasMany('App\DecreasePackageSupply', 'decrease_package_id', 'id');
    }
}
