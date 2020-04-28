<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\RecipeSupply;
use App\Supply;
use App\Mold;
use App\Logbook;

use Auth;
use Illuminate\Http\Request;


class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipes.index', [
            'recipes' => $recipes
        ]);
    }

    public function create()
    {
        $supplies = Supply::all();
        $molds = Mold::all();
        return view('recipes.create', ['supplies' => $supplies, 'molds' => $molds]);
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'code' => 'required|unique:recipes',
            ],
            [
                'code.unique' => 'El código ya existe',
            ]
        );
        
        $recipe = new Recipe();
        $recipe->code = $request->code;
        $recipe->name = $request->name;
        $recipe->mold_id = $request->mold;
        $recipe->save();

        if(count($request->idItemCoverSecond) > 0){

            foreach ($request->idItemCoverSecond as $key => $item) {
                if ($request->idItemCoverSecond[$key] != NULL) {
                    $prodSupply = new RecipeSupply();
                    $prodSupply->recipe_id = $recipe->id;
                    $prodSupply->supply_id = $request->idItemCoverSecond[$key];
                    $prodSupply->quantity = $request->quantityItemCoverSecond[$key];
                    $prodSupply->excess = $request->excessItemCoverSecond[$key];
                    $prodSupply->type = 3;
                    $prodSupply->save();
                }
            }

        }

        

        foreach ($request->idItemCover as $key => $item) {
            if ($request->idItemCover[$key] != NULL) {
                $prodSupply = new RecipeSupply();
                $prodSupply->recipe_id = $recipe->id;
                $prodSupply->supply_id = $request->idItemCover[$key];
                $prodSupply->quantity = $request->quantityItemCover[$key];
                $prodSupply->excess = $request->excessItemCover[$key];
                $prodSupply->type = 2;
                $prodSupply->save();
            }
        }

        foreach ($request->idItem as $key => $item) {
            if ($request->idItem[$key] != NULL) {
                $prodSupply = new RecipeSupply();
                $prodSupply->recipe_id = $recipe->id;
                $prodSupply->supply_id = $request->idItem[$key];
                $prodSupply->quantity = $request->quantityItem[$key];
                $prodSupply->excess = $request->excessItem[$key];
                $prodSupply->type = 1;
                $prodSupply->save();
            }
        }

        $logbook = new Logbook();
        $logbook->type_id = 1;
        $logbook->title = 'Receta Creada';
        $logbook->content = 'La receta con el código "' . $request->code . '" ha sido creada';
        $logbook->icon = 'fas fa-flask';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('recetas')->with('success', 'Receta guardada correctamente');
    }

    public function edit($id)
    {
        $recipe = Recipe::find($id);
        $supplies = Supply::all();
        $molds = Mold::all();
        $items = RecipeSupply::where('recipe_id', $id)->where('type', 1)->get();
        $itemsCover = RecipeSupply::where('recipe_id', $id)->where('type', 2)->get();
        return view('recipes.edit', ['recipe' => $recipe, 'molds' => $molds, 'supplies' => $supplies, 'items' => $items, 'itemsCover' => $itemsCover]);
    }

    public function update(Request $request, $id)
    {
        $recipe =  Recipe::find($id);
        $recipe->code = $request->code;
        $recipe->name = $request->name;
        $recipe->mold_id = $request->mold;
        $recipe->save();

        $recipe->supplies()->delete();
        $recipe->suppliesCover()->delete();

        foreach ($request->idItem as $key => $item) {
            if ($request->idItem[$key] != NULL) {
                $prodSupply = new RecipeSupply();
                $prodSupply->recipe_id = $recipe->id;
                $prodSupply->supply_id = $request->idItem[$key];
                $prodSupply->quantity = $request->quantityItem[$key];
                $prodSupply->excess = $request->excessItem[$key];
                $prodSupply->type = 1;
                $prodSupply->save();
            }
        }

        foreach ($request->idItemCover as $key => $item) {
            if ($request->idItemCover[$key] != NULL) {
                $prodSupply = new RecipeSupply();
                $prodSupply->recipe_id = $recipe->id;
                $prodSupply->supply_id = $request->idItemCover[$key];
                $prodSupply->quantity = $request->quantityItemCover[$key];
                $prodSupply->excess = $request->excessItemCover[$key];
                $prodSupply->type = 2;
                $prodSupply->save();
            }
        }

        $logbook = new Logbook();
        $logbook->type_id = 2;
        $logbook->title = 'Receta Modificada';
        $logbook->content = 'La receta con el código "' . $request->code . '" ha sido modificada';
        $logbook->icon = 'fas fa-flask';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('recetas')->with('success', 'Receta guardada correctamente');
    }
}
