<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntranceItem extends Model
{
    public function supply(){
        return $this->belongsTo('App\Supply', 'supply_id', 'id');
    }

    public function currency(){
        return $this->belongsTo('App\Catalog','currency_id', 'id');
    }
}
