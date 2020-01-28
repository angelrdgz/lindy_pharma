<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductSupply;
use App\Supply;
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
        return view('products.create', ['supplies'=>$supplies]);
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->code = $request->code;
        $product->name = $request->name;
        $product->save();

        foreach ($request->idItem as $key => $item) {
            if($request->idItem[$key] != NULL){
                $prodSupply = new ProductSupply();
            $prodSupply->product_id = $product->id;
            $prodSupply->supply_id = $request->idItem[$key];
            $prodSupply->quantity = $request->quantityItem[$key];
            $prodSupply->type = 1;
            $prodSupply->save();
            }
            
        }

        foreach ($request->idItemCover as $key => $item) {
            if($request->idItemCover[$key] != NULL){
                $prodSupply = new ProductSupply();
            $prodSupply->product_id = $product->id;
            $prodSupply->supply_id = $request->idItemCover[$key];
            $prodSupply->quantity = $request->quantityItemCover[$key];
            $prodSupply->type = 2;
            $prodSupply->save();
            }                        
        }

        return redirect('productos')->with('success', 'Producto guardado correctamente');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $supplies = Supply::all();
        $items = ProductSupply::where('product_id', $id)->where('type', 1)->get();
        $itemsCover = ProductSupply::where('product_id', $id)->where('type', 2)->get();
        return view('products.edit', ['product'=>$product, 'supplies'=>$supplies, 'items'=>$items, 'itemsCover'=>$itemsCover]);
    }

    public function update(Request $request, $id)
    {
        $product =  Product::find($id);
        $product->code = $request->code;
        $product->name = $request->name;
        $product->save();

        $product->supplies()->delete();

        foreach ($request->idItem as $key => $item) {
            if($request->idItem[$key] != NULL){
                $prodSupply = new ProductSupply();
            $prodSupply->product_id = $product->id;
            $prodSupply->supply_id = $request->idItem[$key];
            $prodSupply->quantity = $request->quantityItem[$key];
            $prodSupply->type = 1;
            $prodSupply->save();
            }
            
        }

        foreach ($request->idItemCover as $key => $item) {
            if($request->idItemCover[$key] != NULL){
                $prodSupply = new ProductSupply();
            $prodSupply->product_id = $product->id;
            $prodSupply->supply_id = $request->idItemCover[$key];
            $prodSupply->quantity = $request->quantityItemCover[$key];
            $prodSupply->type = 2;
            $prodSupply->save();
            }                        
        }

        return redirect('productos')->with('success', 'Producto guardado correctamente');
        
    }
}
