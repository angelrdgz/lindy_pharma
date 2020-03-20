<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Package;
use App\PackageSupply;
use App\Product;
use App\Client;
use App\Supply;

use Auth;
use PDF;
use QrCode;
use Mail;

class PackingController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('packing.index', ["packages" => $packages]);
    }

    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
        $supplies = Supply::all();
        return view('packing.create', ["clients" => $clients, "products" => $products, "supplies" => $supplies]);
    }

    public function store(Request $request)
    {
        $package = new Package();
        $package->name = $request->name;
        $package->product_id = $request->product;
        $package->quantity = $request->quantity;
        $package->client_id = $request->client;
        $package->lot = $request->lot;
        $package->presentation = $request->presentation;
        $package->date_expire = $request->expire;
        $package->user_id = Auth::user()->id;
        $package->save();

        foreach ($request->idItem as $key => $item) {
            if ($request->idItem[$key] != NULL) {
                $prodSupply = new PackageSupply();
                $prodSupply->package_id = $package->id;
                $prodSupply->supply_id = $request->idItem[$key];
                $prodSupply->quantity = $request->quantityItem[$key];
                $prodSupply->excess = $request->excessItem[$key];
                $prodSupply->save();
            }
        }

        QrCode::size(150)->format('png')->generate(env('APP_URL') . 'ordenes-de-acondicionamiento/' . $package->id . '/escanear', public_path('images/qrcode/packing/qrcode_packing_' . $package->id . '.png'));

        return redirect('ordenes-de-acondicionamiento')->with('success', 'Orden creada correctamente');
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }
}
