<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entrance;
use App\EntranceItem;
use App\Supply;
use App\Logbook;

use Auth;
use BaconQrCode\Encoder\QrCode;

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
        return view('entrances.create', ['supplies' => $supplies]);
    }

    public function store(Request $request)
    {
        $entrance = new Entrance();
        $entrance->user_id = Auth::user()->id;
        $entrance->delivery_date = $request->delivery;
        $entrance->status = 'Creada';
        $entrance->save();

        $folderPath = public_path('images/entrances/qrcode');
        if (!file_exists($folderPath)) {
            $response = mkdir($folderPath);
            QrCode::size(150)->format('png')->generate(url('ordenes-de-compra/' . $entrance->id), public_path('images/entrances/qrcode/qrcode_' . $entrance->id . '.png'));
        }

        foreach ($request->idItem as $key => $item) {
            if ($request->idItem[$key] != NULL) {
                $entranceItem = new EntranceItem();
                $entranceItem->entrance_id = $entrance->id;
                $entranceItem->supply_id = $request->idItem[$key];
                $entranceItem->quantity = $request->quantityItem[$key];
                $entranceItem->save();
            }
        }

        $logbook = new Logbook();
        $logbook->type_id = 1;
        $logbook->title = 'Orden de Compra Modificada';
        $logbook->content = 'La orden de compra #"'.$entrance->id.'" ha sido creada';
        $logbook->icon = 'fas fa-cart-arrow-down';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('ordenes-de-compra')->with('success', 'Orden creada correctamente');
    }

    public function show($id)
    {
        $entrance = Entrance::find($id);
        $supplies = Supply::all();

        if (Auth::user()->role_id == 3) {
            return view('entrances.show', ['entrance' => $entrance, 'supplies' => $supplies]);
        } else {
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.pdf', ["order" => $order, "product" => $product]);
            return $pdf->download('orden_de_fabricación_' . $order->id . '.pdf');
        }
        //return view('pdfs.pdf', ["order"=>$order, "product"=>$product]);
        //
    }

    public function edit($id)
    {
        $entrance = Entrance::find($id);
        $supplies = Supply::all();
        return view('entrances.edit', ['entrance' => $entrance, 'supplies' => $supplies]);
    }

    public function update(Request $request, $id)
    {
        $entrance = Entrance::find($id);
        $entrance->delivery_date = $request->delivery;
        $entrance->save();

        if ($request->status == NULL) {
            $entrance->items()->delete();

            foreach ($request->idItem as $key => $item) {
                if ($request->idItem[$key] != NULL) {
                    $entranceItem = new EntranceItem();
                    $entranceItem->entrance_id = $entrance->id;
                    $entranceItem->supply_id = $request->idItem[$key];
                    $entranceItem->quantity = $request->quantityItem[$key];
                    $entranceItem->save();
                }
            }
        } else {

            foreach ($request->idItem as $key => $item) {
                    $entranceItem = EntranceItem::find();
                    $entranceItem->quantity = $request->quantityItem[$key];
                    $entranceItem->save();
            }
        }

        $logbook = new Logbook();
        $logbook->type_id = 2;
        $logbook->title = 'Orden de Compra Modificada';
        $logbook->content = 'La orden de compra #"'.$entrance->id.'" ha sido modificada';
        $logbook->icon = 'fas fa-cart-arrow-down';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();



        return redirect('ordenes-de-compra')->with('success', 'Orden modificada correctamente');
    }

    public function destroy($id)
    {
        $entrance = Entrance::find($id);
        $entrance->status = "Cancelada";
        $entrance->save();

        $logbook = new Logbook();
        $logbook->type_id = 3;
        $logbook->title = 'Orden de Compra Cancelada';
        $logbook->content = 'La orden de compra #"'.$entrance->id.'" ha sido cancelada';
        $logbook->icon = 'fas fa-cart-arrow-down';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('ordenes-de-compra')->with('success', 'Orden cancelada correctamente');
    }
}
