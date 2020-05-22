<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function items()
    {
        return $this->hasMany('App\OrderProduct', 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function comments()
    {
        return $this->hasMany('App\OrderComment', 'order_id', 'id');
    }
}
