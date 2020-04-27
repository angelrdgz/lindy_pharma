<?php

namespace App\Http\Controllers;

use App\Product;
use App\Recipe;
use App\ProductRecipe;
use App\ProductSupply;
use App\Supply;
use App\Mold;
use App\Logbook;

use Auth;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', [
            'products'=>$products
        ]);
    }

    public function create()
    {
        $supplies = Supply::all();
        $recipes = Recipe::all();
        return view('products.create', ['recipes'=>$recipes, 'supplies'=>$supplies]);
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
            if($request->idItemRecipe[$key] != NULL){
                $prodSupply = new ProductRecipe();
            $prodSupply->product_id = $product->id;
            $prodSupply->recipe_id = $request->idItemRecipe[$key];
            $prodSupply->quantity = $request->quantityItemRecipe[$key];
            $prodSupply->excess = $request->excessItemRecipe[$key];
            $prodSupply->save();
            }                        
        }

        foreach ($request->idItem as $key => $item) {
            if($request->idItem[$key] != NULL){
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
        $logbook->content = 'El producto con el código "'.$request->code.'" ha sido creado';
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
        return view('products.edit', ['product'=>$product, 'recipes'=>$recipes, 'supplies'=>$supplies, 'productRecipes'=>$productRecipes, 'productSupplies'=>$productSupplies]);
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
            if($request->idItemRecipe[$key] != NULL){
                $prodSupply = new ProductRecipe();
            $prodSupply->product_id = $product->id;
            $prodSupply->recipe_id = $request->idItemRecipe[$key];
            $prodSupply->quantity = $request->quantityItemRecipe[$key];
            $prodSupply->excess = $request->excessItemRecipe[$key];
            $prodSupply->save();
            }
            
        }

        foreach ($request->idItem as $key => $item) {
            if($request->idItem[$key] != NULL){
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
        $logbook->content = 'El producto con el código "'.$request->code.'" ha sido modificado';
        $logbook->icon = 'fas fa-flask';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('productos')->with('success', 'Producto guardado correctamente');
        
    }
}
