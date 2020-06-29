<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DecreaseSupplyEntrance extends Model
{
    public $timestamps = false;

    public function entrance(){
        return $this->belongsTo('App\EntranceItem', 'entrance_number', 'id');
    }
}
