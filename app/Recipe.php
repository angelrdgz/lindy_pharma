<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function supplies()
    {
        return $this->hasMany('App\RecipeSupply')->where('type', 1);
    }

    public function suppliesCover()
    {
        return $this->hasMany('App\RecipeSupply')->where('type', 2);
    }

    public function suppliesSecondCover()
    {
        return $this->hasMany('App\RecipeSupply')->where('type', 3);
    }

    public function mold()
    {
        return $this->belongsTo('App\Mold');
    }

    public function lotNumbers($id)
    {
        $entrances = \DB::select("select departures.* from departures WHERE departures.recipe_id = :id AND departures.status = 'Granel' AND departures.production_status = 'Completa' AND departures.quality_status = 'Aprobado' AND departures.available_quantity > 0 AND departures.type = 1", ["id" => $id]);
        return $entrances;
    }
}
