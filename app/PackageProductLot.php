<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageProductLot extends Model
{
    public $timestamps = false;
    protected $table = "package_product_lots";

    public function recipe(){
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }
}
