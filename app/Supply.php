<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    public function type(){
        return $this->hasOne('App\SupplyType', 'id', 'type_id');
    }

    public function measurementUse(){
        return $this->hasOne('App\SupplyMeasurement', 'id', 'measurement_use');
    }

    public function measurementBuy(){
        return $this->hasOne('App\SupplyMeasurement', 'id', 'measurement_buy');
    }
}
