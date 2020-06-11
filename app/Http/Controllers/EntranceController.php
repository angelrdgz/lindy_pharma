<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entrance;
use App\EntranceItem;
use App\EntranceComment;
use App\Supply;
use App\Supplier;
use App\Logbook;
use App\Catalog;
use App\Cost;
use App\User;

use Auth;
use PDF;
use QrCode;

class EntranceController extends Controller
{
    public function index()
    {
        $entrances = Entrance::all();
        return view('entrances.index', ['entrances' => $entrances]);
    }

    public function create()
    {
        $supplies = Supply::all();
        $suppliers = Supplier::all();
        $costs = Cost::all();
        $codes = Catalog::where('type', 'cfdi')->get();
        $currencies = Catalog::where('type', 'currency')->get();
        return view('entrances.create', ['supplies' => $supplies, "suppliers" => $suppliers, "codes" => $codes, "currencies" => $currencies, "costs" => $costs]);
    }

    public function store(Request $request)
    {
        if ($request->idItem === NULL) {
            return redirect()->back()->with('error', 'No asigno insumos a la orden de compra');
        }

        $entrance = new Entrance();
        $entrance->user_id = Auth::user()->id;
        $entrance->supplier_id = $request->supplier;
        $entrance->cfdi_id = $request->cfdi;
        $entrance->requisition = $request->requisition;
        $entrance->department = $request->department;
        $entrance->owner = $request->owner;
        $entrance->mader = $request->mader;
        $entrance->authorizer = $request->authorizer;
        $entrance->cost_id = $request->costs;
        $entrance->expected_date = $request->expected_date;
        $entrance->save();


        QrCode::size(150)->format('png')->generate(url('ordenes-de-compra/' . $entrance->id), public_path('images/qrcode/entrances/qrcode_entrance_' . $entrance->id . '.png'));


        foreach ($request->idItem as $key => $item) {
            if ($request->idItem[$key] !== NULL) {
                $entranceItem = new EntranceItem();
                $entranceItem->entrance_id = $entrance->id;
                $entranceItem->supply_id = $request->idItem[$key];
                $entranceItem->quantity = $request->quantityItem[$key];
                $entranceItem->available_quantity = $request->quantityItem[$key];
                $entranceItem->price = $request->priceItem[$key];
                $entranceItem->currency_id = $request->currencyItem[$key];
                $entranceItem->status = 'Creada';
                $entranceItem->save();
            }
        }

        if ($request->comments !== NULL) {
            foreach ($request->comments as $key => $comment) {
                if ($comment != NULL) {
                    $entranceComment = new EntranceComment();
                    $entranceComment->entrance_id = $entrance->id;
                    $entranceComment->comment = $comment;
                    $entranceComment->save();
                }
            }
        }

        $logbook = new Logbook();
        $logbook->type_id = 1;
        $logbook->title = 'Orden de Compra Modificada';
        $logbook->content = 'La orden de compra #"' . $entrance->id . '" ha sido creada';
        $logbook->icon = 'fas fa-cart-arrow-down';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('ordenes-de-compra')->with('success', 'Orden creada correctamente');
    }

    public function show($id)
    {
        $entrance = Entrance::find($id);
        $supplies = Supply::all();
        $buyer = User::where('role_id', 4)->first();

        if (Auth::user()->role_id == 3) {
            return view('entrances.show', ['entrance' => $entrance, 'supplies' => $supplies]);
        } else {
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.entrance', ["entrance" => $entrance, 'buyer' => $buyer]);
            return $pdf->stream('orden_de_compra_' . $entrance->id . '.pdf');
            //return view('pdfs.entrance', ["entrance"=>$entrance]);
        }
        //return view('pdfs.pdf', ["order"=>$order, "product"=>$product]);
        //
    }

    public function edit($id)
    {
        $entrance = Entrance::find($id);
        $supplies = Supply::all();
        $costs = Cost::all();
        $suppliers = Supplier::all();
        $codes = Catalog::where('type', 'cfdi')->get();
        $currencies = Catalog::where('type', 'currency')->get();
        return view('entrances.edit', ['entrance' => $entrance, 'supplies' => $supplies, 'suppliers' => $suppliers, 'codes' => $codes, 'currencies' => $currencies, 'costs' => $costs]);
    }

    public function update(Request $request, $id)
    {

        $entrance = Entrance::find($id);

        $oldStatus = $entrance->status;

        $entrance->supplier_id = $request->supplier;
        $entrance->cfdi_id = $request->cfdi;
        $entrance->requisition = $request->requisition;
        $entrance->department = $request->department;
        $entrance->owner = $request->owner;
        $entrance->mader = $request->mader;
        $entrance->authorizer = $request->authorizer;
        $entrance->cost_id = $request->costs;
        $entrance->expected_date = $request->expected_date;

        if ($request->idSupplyItem !== NULL) {
            if (count($request->idSupplyItem) > 0) {
                //$entrance->items()->delete();

                foreach ($request->idSupplyItem as $key => $item) {
                    if ($request->idSupplyItem[$key] != NULL) {
                        if ($request->idItem[$key] == NULL) {

                            if ($request->updated[$key] == -1) {
                                $entranceItem = new EntranceItem();
                                $entranceItem->entrance_id = $entrance->id;
                                $entranceItem->supply_id = $request->idSupplyItem[$key];
                                $entranceItem->quantity = $request->quantityItem[$key];
                                $entranceItem->available_quantity = $request->quantityItem[$key];
                                $entranceItem->price = $request->priceItem[$key];
                                $entranceItem->status = $request->statusItem[$key];
                                $entranceItem->comments = $request->commentsItem[$key];
                                $entranceItem->splitted = $request->splittedItem[$key];
                                $entranceItem->status = $request->statusItem[$key] !== NULL ? $request->statusItem[$key] : 'Creada';
                                $entranceItem->save();
                            } else {
                                $entranceItem = new EntranceItem();
                                $entranceItem->entrance_id = $entrance->id;
                                $entranceItem->supply_id = $request->idSupplyItem[$key];
                                $entranceItem->quantity = $request->quantityItem[$key];
                                $entranceItem->available_quantity = $request->quantityItem[$key];
                                $entranceItem->price = $request->priceItem[$key];
                                $entranceItem->currency_id = $request->currencyItem[$key];
                                $entranceItem->splitted = $request->splittedItem[$key];
                                $entranceItem->status = 'Creada';
                                $entranceItem->save();
                            }
                        } else {

                            if ($request->deletedItem[$key] == 1) {
                                $entranceItem = EntranceItem::find($request->idItem[$key]);
                                $entranceItem->delete();
                            } else {

                                $entranceItem = EntranceItem::find($request->idItem[$key]);
                                if ($entrance->status == "Creada" || $entrance->status == "Cuarentena") {
                                    $entranceItem->supply_id = $request->idSupplyItem[$key];
                                    $entranceItem->quantity = $request->quantityItem[$key];
                                    $entranceItem->available_quantity = $request->quantityItem[$key];
                                    $entranceItem->price = $request->priceItem[$key];
                                    $entranceItem->currency_id = $request->currencyItem[$key];
                                    $entranceItem->splitted = $request->splittedItem[$key];
                                    $entranceItem->status = $request->statusItem[$key] !== NULL ? $request->statusItem[$key] : 'Creada';
                                    $entranceItem->save();

                                    if ($request->statusItem[$key] == 'Aprobada' && $request->updated[$key] == 0) {
                                        $supply = Supply::find($request->idSupplyItem[$key]);
                                        $supply->stock = $supply->stock + convert($supply->measurement_buy, $supply->measurement_use, $request->quantityItem[$key]);
                                        $supply->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($request->comments !== NULL) {

            $entrance->comments()->delete();

            if (count($request->comments) > 0) {
                foreach ($request->comments as $key => $comment) {
                    if ($comment != NULL) {
                        $entranceComment = new EntranceComment();
                        $entranceComment->entrance_id = $entrance->id;
                        $entranceComment->comment = $comment;
                        $entranceComment->save();
                    }
                }
            }
        }

        $entrance->save();


        $logbook = new Logbook();
        $logbook->type_id = 2;
        $logbook->title = 'Orden de Compra Modificada';
        $logbook->content = 'La orden de compra #"' . $entrance->id . '" ha sido modificada';
        $logbook->icon = 'fas fa-cart-arrow-down';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();



        return redirect('ordenes-de-compra')->with('success', 'Orden modificada correctamente');
    }

    public function destroy($id)
    {
        $entrance = Entrance::find($id);

        $entrance->items()->delete();
        $entrance->comments()->delete();



        $logbook = new Logbook();
        $logbook->type_id = 3;
        $logbook->title = 'Orden de Compra Cancelada';
        $logbook->content = 'La orden de compra #"' . $entrance->id . '" ha sido cancelada';
        $logbook->icon = 'fas fa-cart-arrow-down';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        $entrance->delete();

        return redirect('ordenes-de-compra')->with('success', 'Orden cancelada correctamente');
    }
}
