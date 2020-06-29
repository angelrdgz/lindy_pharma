<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DecreaseSupply extends Model
{
    public $timestamps = false;

    public function decrease(){
        return $this->belongsTo('App\Decrease', 'decrease_id', 'id');
    }

    public function supply(){
        return $this->belongsTo('App\Supply', 'supply_id', 'id');
    }

    public function entrances(){
        return $this->hasMany('App\DecreaseSupplyEntrance', 'decrease_supply_id', 'id')->orderBy("created_at", "ASC");
    }
}
