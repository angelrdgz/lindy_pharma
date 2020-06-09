<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageSupply extends Model
{
    protected $table = "package_supplies";
    public $timestamps = false;

    public function supply(){
        return $this->belongsTo('App\Supply', 'supply_id', 'id');
    }

    public function package(){
        return $this->belongsTo('App\Package', 'package_id', 'id');
    }

    public function entrances(){
        return $this->hasMany('App\PackageSupplyEntrance', 'package_supply_id', 'id');
    }
}
