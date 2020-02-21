<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entrance;
use App\EntranceItem;
use App\Supply;
use Auth;
use BaconQrCode\Encoder\QrCode;

class EntranceController extends Controller
{
    public function index()
    {
        $entrances = Entrance::all();
        return view('entrances.index', ['entrances'=>$entrances]);
    }

    public function create()
    {
        $supplies = Supply::all();
        return view('entrances.create', ['supplies'=>$supplies]);
    }

    public function store(Request $request)
    {
        $entrance = new Entrance();
        $entrance->user_id = Auth::user()->id;
        $entrance->delivery_date = $request->delivery;
        $entrance->status = 'Creada';
        $entrance->save();

        $folderPath = public_path('images/entrances/qrcode');
        if (!file_exists($folderPath))
        {
            $response = mkdir($folderPath);
            QrCode::size(150)->format('png')->generate(url('ordenes-de-compra/'.$entrance->id), public_path('images/entrances/qrcode/qrcode_'.$entrance->id.'.png'));
        }

        foreach ($request->idItem as $key => $item) {
            if($request->idItem[$key] != NULL){
                $entranceItem = new EntranceItem();
            $entranceItem->entrance_id = $entrance->id;
            $entranceItem->supply_id = $request->idItem[$key];
            $entranceItem->quantity = $request->quantityItem[$key];
            $entranceItem->save();
            }
            
        }        

        return redirect('ordenes-de-compra')->with('success', 'Orden creada correctamente');
    }

    public function show($id)
    {
        $entrance = Entrance::find($id);
        //return view('pdfs.pdf', ["order"=>$order, "product"=>$product]);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.pdf', ["order"=>$order, "product"=>$product]);  
        return $pdf->download('orden_de_fabricación_'.$order->id.'.pdf');
    }

    public function edit($id)
    {
        $entrance = Entrance::find($id);
        $supplies = Supply::all();
        return view('entrances.edit', ['entrance'=>$entrance, 'supplies'=>$supplies]);
    }

    public function update(Request $request, $id)
    {
        $entrance = Entrance::find($id);
        $entrance->delivery_date = $request->delivery;
        $entrance->save();

        $entrance->items()->delete();

        foreach ($request->idItem as $key => $item) {
            if($request->idItem[$key] != NULL){
                $entranceItem = new EntranceItem();
            $entranceItem->entrance_id = $entrance->id;
            $entranceItem->supply_id = $request->idItem[$key];
            $entranceItem->quantity = $request->quantityItem[$key];
            $entranceItem->save();
            }
            
        }        

        return redirect('ordenes-de-compra')->with('success', 'Orden modificada correctamente');

    }
}
