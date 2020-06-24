<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DecreaseSupply extends Model
{
    public $timestamps = false;

    public function supply(){
        return $this->belongsTo('App\Supply', 'supply_id', 'id');
    }
}
