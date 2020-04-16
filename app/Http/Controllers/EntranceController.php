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
        $entrance = new Entrance();
        $entrance->user_id = Auth::user()->id;
        $entrance->supplier_id = $request->supplier;
        $entrance->cfdi_id = $request->cfdi;
        $entrance->requisition = $request->requisition;
        $entrance->department = $request->department;
        $entrance->owner = $request->owner;
        $entrance->mader = $request->mader;
        $entrance->authorizer = $request->authorizer;
        $entrance->status = 'Creada';
        $entrance->cost_id = $request->costs;
        $entrance->expected_date = $request->expected_date;
        $entrance->save();


        QrCode::size(150)->format('png')->generate(url('ordenes-de-compra/' . $entrance->id), public_path('images/qrcode/entrances/qrcode_entrance_' . $entrance->id . '.png'));


        foreach ($request->idItem as $key => $item) {
            if ($request->idItem[$key] != NULL) {
                $entranceItem = new EntranceItem();
                $entranceItem->entrance_id = $entrance->id;
                $entranceItem->supply_id = $request->idItem[$key];
                $entranceItem->quantity = $request->quantityItem[$key];
                $entranceItem->price = $request->priceItem[$key];
                $entranceItem->currency_id = $request->currencyItem[$key];
                $entranceItem->save();
            }
        }

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
        $buyer = User::where('role_id',4 )->first();

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
        $entrance->supplier_id = $request->supplier;
        $entrance->cfdi_id = $request->cfdi;
        $entrance->requisition = $request->requisition;
        $entrance->department = $request->department;
        $entrance->status = $request->status;
        $entrance->owner = $request->owner;
        $entrance->mader = $request->mader;
        $entrance->authorizer = $request->authorizer;
        $entrance->cost_id = $request->costs;
        $entrance->expected_date = $request->expected_date;

        $entrance->items()->delete();

        foreach ($request->idItem as $key => $item) {
            if ($request->idItem[$key] != NULL) {
                $entranceItem = new EntranceItem();
                $entranceItem->entrance_id = $entrance->id;
                $entranceItem->supply_id = $request->idItem[$key];
                $entranceItem->quantity = $request->quantityItem[$key];
                $entranceItem->price = $request->priceItem[$key];
                $entranceItem->currency_id = $request->currencyItem[$key];
                $entranceItem->save();
            }
        }

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

        if($entrance->status == "Cuarentena" && $request->status == "Aprobada"){
            foreach($entrance->items as $item){

                $supply = Supply::find($item->supply_id);
                $supply->stock = $this->convert($supply->measurement_buy, $supply->measurement_use, $item->quantity);
                $supply->save();
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
        $entrance->status = "Cancelada";
        $entrance->save();

        $logbook = new Logbook();
        $logbook->type_id = 3;
        $logbook->title = 'Orden de Compra Cancelada';
        $logbook->content = 'La orden de compra #"' . $entrance->id . '" ha sido cancelada';
        $logbook->icon = 'fas fa-cart-arrow-down';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('ordenes-de-compra')->with('success', 'Orden cancelada correctamente');
    }

    private function convert($type1, $type2, $quantity)
    {
        $total = 0;

        if ($type1 == 2 && $type2 == 1) {
            $total = $quantity * 1000;             
        }elseif($type1 == 2 && $type2 == 6){
            $total = $quantity * 1000000;
        }elseif($type1 == 4 && $type2 == 3){
            $total = $quantity * 1000;
        }else{
            $total = $quantity;
        }

        return $total;
    }
}
