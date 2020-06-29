<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartureItemEntrance extends Model
{
    public function supply(){
        return $this->belongsTo('App\Supply', 'supply_id', 'id');
    }

    public function entrance(){
        return $this->belongsTo('App\EntranceItem', 'entrance_number', 'id');
    }
}
