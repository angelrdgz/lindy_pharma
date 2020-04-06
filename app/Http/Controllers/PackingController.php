<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Package;
use App\PackageSupply;
use App\Product;
use App\Client;
use App\Supply;
use App\Recipe;

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
        $package->product_id = $request->product;
        $package->quantity = $request->quantity;
        $package->client_id = $request->client;
        $package->lot = $request->lot;
        $package->form = $request->form;
        $package->price = $request->price;
        $package->presentation = $request->presentation;
        $package->date_expire = $request->expire;
        $package->status = $request->status;
        $package->user_id = Auth::user()->id;
        $package->save();

        QrCode::size(150)->format('png')->generate(env('APP_URL') . 'ordenes-de-acondicionamiento/' . $package->id . '/escanear', public_path('images/qrcode/packing/qrcode_packing_' . $package->id . '.png'));

        return redirect('ordenes-de-acondicionamiento')->with('success', 'Orden creada correctamente');
    }

    public function show($id)
    {
        $order = Package::find($id);
        /*$totals = DB::select('SELECT quantity + (quantity * (excess / 100)) as "Total" FROM recipe_supplies where recipe_id = :id AND type = :type', ["id" => $order->recipe_id, "type" => $order->type]);
        $tt = 0;
        foreach ($totals as $total) {
            $tt += $total->Total;
        }*/
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.conditioning', ["order" => $order]);
        return $pdf->stream('orden_de_acondicionamiento_' . $order->id . '.pdf');
    }

    public function edit($id)
    {
        $clients = Client::all();
        $products = Product::all();
        $supplies = Supply::all();
        $package = Package::find($id);
        return view('packing.edit', ["package" => $package, "clients" => $clients, "products" => $products, "supplies" => $supplies]);
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role_id == 3) {
            if (count($request->orderNumber) > 0) {
                $package = Package::find($id);
                $package->supplies()->delete();
                for ($i = 0; $i < count($request->orderNumber); $i++) {
                    if ($request->orderNumber[$i] !== NULL) {
                        $packageSupply = new PackageSupply();
                        $packageSupply->package_id = $id;
                        $packageSupply->supply_id = $request->supplyId[$i];
                        $packageSupply->entrance_number = $request->orderNumber[$i];
                        $packageSupply->save();
                    }
                }
            }
        } else {
            $package = Package::find($id);
            $package->product_id = $request->product;
            $package->quantity = $request->quantity;
            $package->client_id = $request->client;
            $package->lot = $request->lot;
            $package->form = $request->form;
            $package->price = $request->price;
            $package->presentation = $request->presentation;
            $package->date_expire = $request->expire;

            $package->user_id = Auth::user()->id;

            if ($package->status == 'Creada' && $request->status == 'Surtido de Insumos') {
                foreach ($package->product->recipes as $item) {
                    $recipe = Recipe::find($item->recipe_id);
                    $recipe->stock = $recipe->stock - (($item->quantity + ($item->quantity * ($item->excess / 100))) * $package->quantity);
                    $recipe->save();
                }

                /*foreach ($package->product->supplies as $item) {
                $supply = Supply::find($item->supply_id);
                $supply->stock = $supply->stock - (($item->quantity + ($item->quantity * ($item->excess / 100))) * $package->quantity);
                $supply->save();
            }*/
            }
            $package->status = $request->status;
            $package->save();
        }

        //QrCode::size(150)->format('png')->generate(env('APP_URL') . 'ordenes-de-acondicionamiento/' . $package->id . '/escanear', public_path('images/qrcode/packing/qrcode_packing_' . $package->id . '.png'));

        return redirect('ordenes-de-acondicionamiento')->with('success', 'Orden modificada correctamente');
    }
}
