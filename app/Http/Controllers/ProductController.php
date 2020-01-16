<?php

namespace App\Http\Controllers;

use App\Product;
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
        return view('products.create');
    }

    public function store(Request $request)
    {

    }

    public function edit($id)
    {
        return view('products.create');
    }

    public function update(Request $request, $id)
    {
        
    }
}
