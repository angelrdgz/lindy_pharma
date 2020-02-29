<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    public function type(){
        return $this->hasOne('App\LogbookType', 'id', 'type_id');
    }

    public function user(){
        return $this->hasOne('App\User', 'id', 'created_by');
    }
}
