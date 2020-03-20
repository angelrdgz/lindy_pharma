<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartureItem extends Model
{
    public $timestamps = false;

    public function supply(){
        return $this->belongsTo('App\Supply', 'supplie_id', 'id');
    }
}
