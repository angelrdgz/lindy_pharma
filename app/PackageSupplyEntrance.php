<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageSupplyEntrance extends Model
{
    public $timestamps = false;
    protected $table = "package_supply_entrances";

    public function supply(){
        return $this->belongsTo('App\Supply', 'supply_id', 'id');
    }
}
