<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Package;
use App\Departure;
use App\PackageRecipe;
use App\PackageSupply;
use App\PackageProductLot;
use App\PackageSupplyEntrance;
use App\EntranceItem;
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
        if (Auth::user()->role_id == 3)
            $packages = Package::where("status", "Liberado")->orWhere("status", "Empacado")->get();
        else
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

        $request->validate(
            [
                'product' => 'required',
                'client' => 'required',
                'lot' => 'required|unique:packages',
                'form' => 'required',
                'quantity' => 'required',
                'price' => 'required',
                'expire' => 'required',
                'presentation' => 'required',
            ],
            [
                'product.required' => 'El producto es requerido',
                'client.required' => 'El cliente es requerido',
                'lot.required' => 'El lote es requerido',
                'form.required' => 'La formula es requerida',
                'quantity.required' => 'La cantidad es requerida',
                'price.required' => 'El precio es requerido',
                'expire.required' => 'La fecha de caducidad es requerida',
                'presentation.required' => 'La presentación es requerida',
                'lot.unique' => 'Este lote ya existe',
            ]
        );

        $lastRecipe = Departure::latest()->first();
        $lastPackage = Package::latest()->first();

        if($lastRecipe !== NULL && $lastPackage !== NULL)
        {
            if(intval(str_replace("OT-", "", $lastRecipe->order_number)) ==  $lastPackage->id){
                $nextid = ($lastRecipe !== NULL ? intval(str_replace("OT-", "", $lastRecipe->order_number)):0) + ($lastPackage !== NULL ? $lastPackage->id:0) +1;
            }elseif(intval(str_replace("OT-", "", $lastRecipe->order_number)) >  $lastPackage->id){
                $nextid = ($lastRecipe !== NULL ? intval(str_replace("OT-", "", $lastRecipe->order_number)):0) + ($lastPackage !== NULL ? $lastPackage->id:0);
            }elseif(intval(str_replace("OT-", "", $lastRecipe->order_number)) <  $lastPackage->id){
                $nextid = ($lastRecipe !== NULL ? intval(str_replace("OT-", "", $lastRecipe->order_number)):0) + ($lastPackage !== NULL ? $lastPackage->id:0);
            }
        }else
        {
            $nextid = ($lastRecipe !== NULL ? intval(str_replace("OT-", "", $lastRecipe->order_number)):0) + ($lastPackage !== NULL ? $lastPackage->id:0) + 1;
        }

        $order_number = $nextid;

        $package = new Package();
        $package->id = $order_number;
        $package->product_id = $request->product;
        $package->quantity = $request->quantity;
        $package->client_id = $request->client;
        $package->lot = $request->lot;
        $package->form = $request->form;
        $package->price = $request->price;
        $package->presentation = $request->presentation;
        $package->date_expire = $request->expire;
        $package->status = "Creada";
        $package->user_id = Auth::user()->id;
        $package->save();

        $product = Product::find($request->product);

        foreach ($product->recipes as $recipe) {
            $packageRecipe = new PackageRecipe();
            $packageRecipe->package_id = $package->id;
            $packageRecipe->recipe_id = $recipe->recipe_id;
            $packageRecipe->quantity = $recipe->quantity;
            $packageRecipe->excess = $recipe->excess;
            $packageRecipe->save();
        }

        foreach ($product->supplies as $supply) {
            $packageSupply = new PackageSupply();
            $packageSupply->package_id = $package->id;
            $packageSupply->supply_id = $supply->supply_id;
            $packageSupply->quantity = $supply->quantity;
            $packageSupply->excess = $supply->excess;
            $packageSupply->save();
        }

        QrCode::size(150)->format('png')->generate(env('APP_URL') . 'ordenes-de-acondicionamiento/' . $package->id . '/escanear', public_path('images/qrcode/packing/qrcode_packing_' . $package->id . '.png'));

        return redirect('ordenes-de-acondicionamiento')->with('success', 'Orden creada correctamente');
    }

    public function show($id)
    {
        $order = Package::find($id);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.conditioning', ["order" => $order]);
        return $pdf->stream('orden_de_acondicionamiento_' . $order->id . '.pdf');
    }

    public function edit($id)
    {
        $clients = Client::all();
        $products = Product::all();
        $supplies = Supply::all();
        $package = Package::find($id);

        if (Auth::user()->role_id == 3)
            return view('packing.edit_ware', ["package" => $package, "clients" => $clients, "products" => $products, "supplies" => $supplies]);
        else
            return view('packing.edit', ["package" => $package, "clients" => $clients, "products" => $products, "supplies" => $supplies]);
    }

    public function update(Request $request, $id)
    {
        if (in_array(Auth::user()->role_id, [3,6])) {
            $package = Package::find($id);
            if ($package->status == 'Liberado' && $request->status == 'Empacado') {
                $package->quantity_real = $request->total;
                $package->status = $request->status;
                $package->available_quantity = $request->total;
                $package->save();

                Product::where('id', $package->product)->update(['stock' => ($package->product->stock + $request->total)]);
            }
            /*if (count($request->orderNumber) > 0) {
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
            }*/
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

            if ($package->status == 'Creada' && $request->status == 'Liberado') {

                $supplies = [];
                $recipes = [];

                foreach ($package->recipes as $recipe) {
                    $total = ($recipe->quantity + ($recipe->quantity * ($recipe->excess / 100))) * $package->quantity;
                    $enable = intval(Departure::where('recipe_id', $recipe->recipe_id)->where("status", "Granel")->where("type", 1)->sum("available_quantity"));

                    if ($total > $enable) {
                        $tag = number_format(($total - $enable), 2) . ' pza';
                        array_push($recipes, $recipe->recipe->name . ' (' . $tag . ')');
                    }
                }

                foreach ($package->supplies as $item) {
                    $total = ($item->quantity + ($item->quantity * ($item->excess / 100))) * $package->quantity;
                    $enable = floatval(EntranceItem::where('supply_id', $item->supply_id)->where("status", "Aprobada")->sum("available_quantity"));
                    if ($total > $enable) {
                        switch ($item->supply->measurement_use) {
                            case 6:
                            case 3:
                                $tag = number_format((($total - $enable) / 1000), 2) . ' gr';
                                break;
                            case 1:
                                $tag = number_format(($total - $enable), 2) . ' gr';
                                break;
                            case 5:
                                $tag = number_format(($total - $enable), 2) . ' pza';
                                break;
                            default:
                                $tag = number_format(($total - $enable), 2) . ' pza';
                                break;
                        }
                        array_push($supplies, $item->supply->name . ' (' . $tag . ')');
                    }
                }

                if (count($supplies) > 0 || count($recipes)) {
                    return redirect('ordenes-de-acondicionamiento')->with('error', 'Estas recetas no cuentan consuficientes capsulas: ' . implode(", ", $recipes) . '. Estos insumos no cuentan con suficiente stock disponible: ' . implode(", ", $supplies));
                }
                /*foreach ($package->product->recipes as $item) {
                    $recipe = Recipe::find($item->recipe_id);
                    $recipe->stock = $recipe->stock - (($item->quantity + ($item->quantity * ($item->excess / 100))) * $package->quantity);
                    $recipe->save();
                }

                foreach ($package->product->supplies as $item) {
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

    public function updateItems(Request $request, $id)
    {

        $x = 0;

        foreach ($request->idRecipeRow as $key => $value) {

            $departureItem = PackageRecipe::find($request->idRecipeRow[$key]);
            $departureItem->deliver_date = date('Y-m-d'); // $request->deliverDate[$key];
            $departureItem->deliver_quantity = $request->deliverQuantityRecipe[$key];

            $totalNeedIt = $departureItem->quantity  * $departureItem->package->quantity;
            if ($request->processedRecipe[$key] == 0 && $request->lotNumber[$key] !== NULL) {

                $ids = explode(",", $request->lotNumber[$key]);

                $totalForDiscount = $totalNeedIt;

                foreach ($ids as $idx) {

                    $entrance = Departure::find($idx);
                    $lotQuantity = $entrance->available_quantity;
                    if ($totalForDiscount >= $lotQuantity) {
                        $entrance->available_quantity = 0;
                        $different = $lotQuantity;
                    } else {
                        $entrance->available_quantity = $lotQuantity - $totalForDiscount;
                        $different = $totalForDiscount;
                    }

                    $recipe = Recipe::find($request->recipeId[$key]);
                    if ($totalForDiscount >= $lotQuantity) {
                        $recipe->stock = $recipe->stock - $lotQuantity;
                    } else {
                        $recipe->stock = $recipe->stock - $totalForDiscount;
                    }

                    $recipe->save();
                    $entrance->save();

                    $totalForDiscount -= $lotQuantity;

                    $die = new PackageProductLot();
                    $die->package_recipe_id = $departureItem->id;
                    $die->quantity = $totalNeedIt;
                    $die->delivery_quantity = $different;
                    $die->lot_number = $entrance->lot;
                    $die->recipe_id = $request->recipeId[$key];
                    $die->save();

                    if ($totalForDiscount <= 0) {
                        break;
                    }
                }

                $departureItem->processed = 1;
            }

            if ($x == 0) {
                $package =  Package::find($id);
                $package->user_id = Auth::user()->id;
                $package->save();
            }
            $x++;

            $departureItem->save();
        }

        foreach ($request->idSupplyRow as $key => $value) {

            $departureItem = PackageSupply::where('id', $request->idSupplyRow[$key])->first();
            $departureItem->deliver_date = date('Y-m-d'); // $request->deliverDate[$key];
            $departureItem->deliver_quantity = $request->deliverQuantity[$key];

            $totalNeedIt = ($departureItem->quantity + ($departureItem->quantity * ($departureItem->excess / 100))) * $departureItem->package->quantity;
            if ($request->processed[$key] == 0 && $request->orderNumber[$key] !== NULL) {

                $ids = explode(",", $request->orderNumber[$key]);

                $totalForDiscount = $totalNeedIt;

                foreach ($ids as $idx) {

                    $entrance = EntranceItem::find($idx);
                    $entranceQuantity = $entrance->available_quantity;
                    if ($totalForDiscount >= $entranceQuantity) {
                        $entrance->available_quantity = 0;
                    } else {
                        $entrance->available_quantity = $entranceQuantity - $totalForDiscount;
                    }

                    $entrance->save();

                    $supply = Supply::find($request->supplyId[$key]);
                    if ($totalForDiscount >= $entranceQuantity) {
                        $supply->stock = $supply->stock - $entranceQuantity;
                        $different = $entranceQuantity;
                    } else {
                        $supply->stock = $supply->stock - $totalForDiscount;
                        $different = $totalForDiscount;
                    }

                    $supply->save();

                    $totalForDiscount -= $entranceQuantity;

                    $die = new PackageSupplyEntrance();
                    $die->package_supply_id = $departureItem->id;
                    $die->quantity = $totalNeedIt;
                    $die->delivery_quantity = $different;
                    $die->entrance_number = $idx;
                    $die->supply_id = $request->supplyId[$key];
                    $die->save();

                    if ($totalForDiscount <= 0) {
                        break;
                    }
                }

                $departureItem->processed = 1;
            }

            $departureItem->save();
        }

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.lot_numbers', ["package" => $package]);
        return $pdf->stream('numeros_de_lote_' . $package->id . '.pdf');

        //return redirect('ordenes-de-acondicionamiento')->with('success', 'Orden actualizada correctamente');
    }

    public function scan($id)
    {
        $package = Package::findOrFail($id);
        if ($package->status == 'Empacado') {
            return redirect('ordenes-de-acondicionamiento')->with('success', 'La orden de acondicionamiento ya ha finalizado');
        }
        return view('packing.scan', ["package" => $package]);
    }

    public function revision($id)
    {
        $package = Package::find($id);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.lot_numbers', ["package" => $package]);
        return $pdf->stream('numeros_de_lote_' . $package->id . '.pdf');
    }

    public function destroy(Request $request, $id){
        $package = Package::find($id);
        $package->delete();        
        return redirect('ordenes-de-acondicionamiento')->with('success', 'Orden eliminada correctamente');
    }
}
