<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartureItem extends Model
{
    public $timestamps = false;

    public function supply(){
        return $this->belongsTo('App\Supply', 'supplie_id', 'id');
    }

    public function departure(){
        return $this->belongsTo('App\Departure', 'departure_id', 'id');
    }

    public function entrances(){
        return $this->hasMany('App\DepartureItemEntrance', 'departure_item_id', 'id')->orderBy("created_at", "ASC");
    }
}
