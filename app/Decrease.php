<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decrease extends Model
{
    public function supply(){
        return $this->belongsTo('App\Supply', 'supply_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}
