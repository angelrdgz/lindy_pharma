<?php


use Illuminate\Support\Facades\DB;
namespace App;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    public function supplier(){
        return $this->belongsTo('App\Supplier');
    }

    public function type(){
        return $this->hasOne('App\SupplyType', 'id', 'type_id');
    }

    public function measurementUse(){
        return $this->hasOne('App\SupplyMeasurement', 'id', 'measurement_use');
    }

    public function measurementBuy(){
        return $this->hasOne('App\SupplyMeasurement', 'id', 'measurement_buy');
    }

    public function entrances(){
        return $this->hasMany('App\EntranceItem', 'supply_id', 'id');
    }

    public function entranceNumbers($id){
        $entrances = \DB::select("select entrance_items.* from entrance_items INNER JOIN entrances ON entrance_items.entrance_id = entrances.id WHERE entrance_items.supply_id = :id AND entrance_items.status = 'Aprobada' AND entrance_items.available_quantity > 0", ["id"=>$id]);
        return $entrances;
    }
}
