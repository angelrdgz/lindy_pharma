<?php

namespace App\Http\Controllers;

use App\Product;
use App\Recipe;
use App\ProductRecipe;
use App\ProductSupply;
use App\Supply;
use App\Mold;
use App\Logbook;
use App\Package;

use Auth;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $supplies = Supply::all();
        $recipes = Recipe::all();
        return view('products.create', ['recipes' => $recipes, 'supplies' => $supplies]);
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'code' => 'required|unique:products',
            ],
            [
                'code.unique' => 'El código ya existe',
            ]
        );

        $product = new Product();
        $product->code = $request->code;
        $product->name = $request->name;
        $product->save();

        foreach ($request->idItemRecipe as $key => $item) {
            if ($request->idItemRecipe[$key] != NULL) {
                $prodSupply = new ProductRecipe();
                $prodSupply->product_id = $product->id;
                $prodSupply->recipe_id = $request->idItemRecipe[$key];
                $prodSupply->quantity = $request->quantityItemRecipe[$key];
                $prodSupply->excess = $request->excessItemRecipe[$key];
                $prodSupply->save();
            }
        }

        foreach ($request->idItem as $key => $item) {
            if ($request->idItem[$key] != NULL) {
                $prodSupply = new ProductSupply();
                $prodSupply->product_id = $product->id;
                $prodSupply->supply_id = $request->idItem[$key];
                $prodSupply->quantity = $request->quantityItem[$key];
                $prodSupply->excess = $request->excessItem[$key];
                $prodSupply->save();
            }
        }

        $logbook = new Logbook();
        $logbook->type_id = 1;
        $logbook->title = 'Producto Creado';
        $logbook->content = 'El producto con el código "' . $request->code . '" ha sido creado';
        $logbook->icon = 'fas fa-flask';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('productos')->with('success', 'Producto guardado correctamente');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $supplies = Supply::all();
        $recipes = Recipe::all();
        $productRecipes = ProductRecipe::where('product_id', $id)->get();
        $productSupplies = ProductSupply::where('product_id', $id)->get();
        return view('products.edit', ['product' => $product, 'recipes' => $recipes, 'supplies' => $supplies, 'productRecipes' => $productRecipes, 'productSupplies' => $productSupplies]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        foreach ($product->recipes as $key => $item) {
            $item->recipe;
        }

        foreach ($product->supplies as $key => $item) {
            $item->supply;
            $item->supply->measurementUse;
        }

        return response()->json(["data" => $product]);
    }

    public function update(Request $request, $id)
    {
        $product =  Product::find($id);
        $product->code = $request->code;
        $product->name = $request->name;
        $product->save();

        $product->supplies()->delete();
        $product->recipes()->delete();

        foreach ($request->idItemRecipe as $key => $item) {
            if ($request->idItemRecipe[$key] != NULL) {
                $prodSupply = new ProductRecipe();
                $prodSupply->product_id = $product->id;
                $prodSupply->recipe_id = $request->idItemRecipe[$key];
                $prodSupply->quantity = $request->quantityItemRecipe[$key];
                $prodSupply->excess = $request->excessItemRecipe[$key];
                $prodSupply->save();
            }
        }

        foreach ($request->idItem as $key => $item) {
            if ($request->idItem[$key] != NULL) {
                $prodSupply = new ProductSupply();
                $prodSupply->product_id = $product->id;
                $prodSupply->supply_id = $request->idItem[$key];
                $prodSupply->quantity = $request->quantityItem[$key];
                $prodSupply->excess = $request->excessItem[$key];
                $prodSupply->save();
            }
        }

        $logbook = new Logbook();
        $logbook->type_id = 2;
        $logbook->title = 'Producto Modificado';
        $logbook->content = 'El producto con el código "' . $request->code . '" ha sido modificado';
        $logbook->icon = 'fas fa-flask';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('productos')->with('success', 'Producto guardado correctamente');
    }

    public function export()
    {
        $packages = Package::where("status", 'Empacado')->get();
        $csvExporter = new \Laracsv\Export();

        $csvExporter->beforeEach(function ($package) {
            $package->ot = '#' . sprintf("%05s",  $package->id);
            $package->date_expire = $package->date_expire == NULL ? "No definida" : date("d/m/Y", strtotime($package->date_expire));
            $package->name = $package->product->name;
            $package->code = $package->product->code;
        });

        $csvExporter->build($packages, ["ot" => "OT", "code" => "Codigo", "name" => "Nombre", "lot" => "Lote", "quantity" => "Tamano de Lote", "quantity_real" => "Cantidad Real", "available_quantity"=>"Cantidad Disponible",  "date_expire" => "Fecha de Caducidad", "production_status" => "Estatus de Produccion", "quality_status" => "Estatus de Calidad"])->download('inventario_productos_' . date('d_m_Y') . '.csv');
    }

    public function exportProduct($id)
    {
        $package = Package::where("status", 'Finalizada')->where("product_id", $id)->get();
        $csvExporter = new \Laracsv\Export();

        $csvExporter->beforeEach(function ($pack) {
            $pack->id = '#' . sprintf("%05s",  $pack->id);
            $pack->date_expire = $pack->date_expire == NULL ? "No definida" : date("d/m/Y", strtotime($pack->date_expire));
            $pack->name = $pack->product->name;
            $pack->code = $pack->product->code;
        });

        $csvExporter->build($package, ["id" => "OT", "code" => "Codigo", "name" => "Nombre", "lot" => "Lote", "quantity" => "Tamano de Lote", "quantity_real" => "Cantidad Real",  "date_expire" => "Fecha de Caducidad", "production_status" => "Estatus de Produccion", "quality_status" => "Estatus de Calidad"])->download('inventario_' . str_replace("_", "/", $package[0]->product->name) . '_' . date('d_m_Y') . '.csv');
    }

    public function stock()
    {
        if (Auth::user()->role_id == 2)
            $packages = Package::where('status', 'Empacado')->where("production_status", "Completa")->get();
        else
            $packages = Package::where('status', 'Empacado')->get();
        return view('products.stock', ["packages" => $packages]);
    }

    public function stockDetails($id)
    {
        $package = Package::find($id);
        return view('products.stock_details', ["package" => $package]);
    }

    public function updateStock(Request $request, $id)
    {
        $package = Package::find($id);
        Package::where('id', $package->id)->update(["quality_status" => $request->quality_status, "production_status" => $request->production_status, "date_expire" => $request->expired_date, "quantity_real" => $request->quantity_real]);
        return redirect('inventario-recetas')->with('Inventario actualizado correctamente');
    }
}
