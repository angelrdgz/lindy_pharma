<?php

use Illuminate\Support\Facades\DB;
namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSupply extends Model
{
    public function supply(){
        return $this->belongsTo('App\Supply');
    }

    public function entranceNumber($package, $supply){
        $number = \DB::select("select * from packages_supplies WHERE supply_id = :supply AND package_id = :package", ["supply"=>$supply, "package"=>$package]);
        return $number;
    }
}
