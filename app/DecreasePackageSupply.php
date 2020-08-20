<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DecreasePackageSupply extends Model
{
    public $timestamps = false;
    protected $table = "decrease_package_supplies";

    public function supply(){
        return $this->belongsTo('App\Supply', 'supply_id', 'id');
    }

    public function entrances(){
        return $this->hasMany('App\DecreasePackageSupplyEntrance', 'decrease_package_supply_id', 'id')->orderBy("created_at", "ASC");
    }
}
