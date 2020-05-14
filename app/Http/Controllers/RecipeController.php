<?php

namespace App\Http\Controllers;

use App\Departure;
use App\Recipe;
use App\RecipeSupply;
use App\Supply;
use App\Mold;
use App\Logbook;

use Auth;
use DB;
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

        if (count($request->idItemCoverSecond) > 0) {

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

    public function export()
    {
        $departures = Departure::where("status", 'Inspección')->distinct("order_number")->get();
        $csvExporter = new \Laracsv\Export();

        $csvExporter->beforeEach(function ($departure) {
            $departure->expired_date = $departure->expired_date == NULL ? "No definida" : date("d/m/Y", strtotime($departure->expired_date));
            $departure->name = $departure->recipe->name;
            $departure->code = $departure->recipe->code;
        });

        $csvExporter->build($departures, ["order_number" => "OT", "name" => "Nombre", "code" => "Código", "quantity" => "Cantidad", "quantity_real" => "Cantidad Real", "lot" => "Lote", "expired_date" => "Fecha de Caducidad"])->download('inventario_' . date('d_m_Y') . '.csv');
    }

    public function exportRecipe($id)
    {
        $departures = Departure::where("status", 'Inspección')->where("recipe_id", $id)->distinct("order_number")->get();
        $csvExporter = new \Laracsv\Export();

        $csvExporter->beforeEach(function ($departure) {
            $departure->expired_date = $departure->expired_date == NULL ? "No definida" : date("d/m/Y", strtotime($departure->expired_date));
            $departure->name = $departure->recipe->name;
            $departure->code = $departure->recipe->code;
        });

        $csvExporter->build($departures, ["order_number" => "OT", "name" => "Nombre", "code" => "Código", "quantity" => "Cantidad", "quantity_real" => "Cantidad Real", "lot" => "Lote", "expired_date" => "Fecha de Caducidad"])->download('inventario_' . str_replace("_", "/", $departures[0]->recipe->name) . '_' . date('d_m_Y') . '.csv');
    }

    public function stock()
    {
        if (Auth::user()->role_id == 3)
            $departures = Departure::where("status", 'Inspección')->distinct("order_number")->get();
        else
            $departures = Departure::where("status", 'Inspección')->where("production_status", "Completa")->distinct("order_number")->get();
        return view('recipes.stock', ["departures" => $departures]);
    }

    public function stockDetails($id)
    {
        $departure = Departure::find($id);
        return view('recipes.stock_details', ["departure" => $departure]);
    }

    public function updateStock(Request $request, $id)
    {
        $departure = Departure::find($id);
        Departure::where('order_number', $departure->order_number)->update(["quality_status" => $request->quality_status, "production_status" => $request->production_status, "expired_date" => $request->expired_date, "quantity_real" => $request->quantity_real]);

        return redirect('inventario-recetas')->with('Inventario actualizado correctamente');
    }
}
