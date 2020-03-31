<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrance extends Model
{
    public function items(){
        return $this->hasMany('App\EntranceItem', 'entrance_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function cost()
    {
        return $this->belongsTo('App\Cost');
    }

    public function supplier(){
        return $this->belongsTo('App\Supplier', 'supplier_id','id');
    }

    public function CFDI(){
        return $this->belongsTo('App\Catalog','cfdi_id', 'id');
    }

    public function comments(){
        return $this->hasMany('App\EntranceComment', 'entrance_id', 'id');
    }
}
