<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageSupplyEntrance extends Model
{
    protected $table = "package_supply_entrances";

    public function supply(){
        return $this->belongsTo('App\Supply', 'supply_id', 'id');
    }

    public function entrance(){
        return $this->belongsTo('App\EntranceItem', 'entrance_number', 'id');
    }
}
