<?php

namespace App\Http\Controllers;

use App\Client;
use App\Departure;
use App\Recipe;
use App\Supply;
use App\DepartureItem;
use App\DepartureItemEntrance;
use App\EntranceItem;
use Illuminate\Http\Request;
use App\Logbook;

use Auth;
use PDF;
use QrCode;
use Mail;

use Illuminate\Support\Facades\DB;

class DepartureController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 3)
            $orders = Departure::where('status', 'Liberado')->get();
        else
            $orders = Departure::where('visible', true)->where('status', '!=', 'Cancelada')->get();
        return view('departures.index', ['orders' => $orders]);
    }

    public function create()
    {
        $recipes = Recipe::all();
        $clients = Client::all();
        return view('departures.create', ['recipes' => $recipes, 'clients' => $clients]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'recipe' => 'required',
                'client' => 'required',
                'lot' => 'required|unique:departures',
                'line' => 'required',
                'quantity' => 'required',
            ],
            [
                'recipe.required' => 'La receta es requerida',
                'client.required' => 'El cliente es requerido',
                'lot.required' => 'El lote es requerido',
                'line.required' => 'La linea es requerida',
                'quantity.required' => 'La cantidad es requerida',
                'lot.unique' => 'Este lote ya existe',
            ]
        );

        $recipe = Recipe::find($request->recipe);

        $total = Departure::count();

        $order_number = "OT-" . sprintf("%04s", $total == 0 ? "1" : (($total / 2) + 1));

        $folderPath = public_path('images/qrcode');
        if (!file_exists($folderPath)) {
            $response = mkdir($folderPath);
        }

        if ($recipe->supplies->count() > 0) {

            $departure = new Departure();
            $departure->order_number = $order_number;
            $departure->recipe_id = $request->recipe;
            $departure->client_id = $request->client;
            $departure->lot = $request->lot;
            $departure->line = $request->line;
            $departure->status = "Creada";
            $departure->quantity = $request->quantity;
            $departure->created_by = Auth::user()->id;
            $departure->type = 1;
            $departure->save();

            foreach ($recipe->supplies as $supplie) {
                $item = new DepartureItem();
                $item->departure_id = $departure->id;
                $item->supplie_id = $supplie->supply_id;
                $item->quantity = $supplie->quantity;
                $item->excess = $supplie->excess;
                $item->save();
            }

            try {
                Mail::send('emails.departure', ["order_number" => $order_number, "user_name" => Auth::user()->name, "link" => env("APP_URL") . 'ordenes-de-fabricación/' . $departure->id], function ($message) {
                    $message->from('info@lindypharma.com', 'Lindy Pharma');
                    $message->to('angelrodriguez@ucol.mx');
                    $message->subject('Orden de Fabricación Creada');
                });
            } catch (\Throwable $th) {
                //throw $th;
            }

            QrCode::size(150)->format('png')->generate(env('APP_URL') . 'ordenes-de-fabricacion/' . $departure->id . '/escanear', public_path('images/qrcode/qrcode_' . $departure->id . '.png'));
        }

        if ($recipe->suppliesCover->count() > 0) {

            $departure = new Departure();
            $departure->order_number = $order_number;
            $departure->recipe_id = $request->recipe;
            $departure->client_id = $request->client;
            $departure->lot = $request->lot;
            $departure->line = $request->line;
            $departure->status = "Creada";
            $departure->quantity = $request->quantity;
            $departure->created_by = Auth::user()->id;
            $departure->type = 2;
            $departure->save();

            foreach ($recipe->suppliesCover as $supplie) {
                $item = new DepartureItem();
                $item->departure_id = $departure->id;
                $item->supplie_id = $supplie->supply_id;
                $item->quantity = $supplie->quantity;
                $item->excess = $supplie->excess;
                $item->save();
            }

            QrCode::size(150)->format('png')->generate(env('APP_URL') . 'ordenes-de-fabricacion/' . $departure->id . '/escanear', public_path('images/qrcode/qrcode_' . $departure->id . '.png'));
        }

        if ($recipe->suppliesSecondCover->count() > 0) {

            $departure = new Departure();
            $departure->order_number = $order_number;
            $departure->recipe_id = $request->recipe;
            $departure->client_id = $request->client;
            $departure->lot = $request->lot;
            $departure->line = $request->line;
            $departure->status = "Creada";
            $departure->quantity = $request->quantity;
            $departure->created_by = Auth::user()->id;
            $departure->type = 3;
            $departure->save();

            foreach ($recipe->suppliesSecondCover as $supplie) {
                $item = new DepartureItem();
                $item->departure_id = $departure->id;
                $item->supplie_id = $supplie->supply_id;
                $item->quantity = $supplie->quantity;
                $item->excess = $supplie->excess;
                $item->save();
            }

            QrCode::size(150)->format('png')->generate(env('APP_URL') . 'ordenes-de-fabricacion/' . $departure->id . '/escanear', public_path('images/qrcode/qrcode_' . $departure->id . '.png'));
        }

        $logbook = new Logbook();
        $logbook->type_id = 1;
        $logbook->title = 'Orden de Fabricació Creada';
        $logbook->content = 'La orden de fabricación "' . $order_number . '" ha sido creado';
        $logbook->icon = 'fas fa-clipboard';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('ordenes-de-fabricacion')->with('success', 'Orden creada correctamente');
    }

    public function show($id)
    {
        if (Auth::user()->role_id == 3) {
            $order = Departure::find($id);
            $recipe = Recipe::find($order->recipe_id);
            $totals = DB::select('SELECT quantity + (quantity * (excess / 100)) as "Total" FROM recipe_supplies where recipe_id = :id AND type = 1', ["id" => $order->recipe_id]);
            $tt = 0;
            foreach ($totals as $total) {
                $tt += $total->Total;
            }
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.order_numbers', ["departure" => $order, "recipe" => $recipe, "totalSupplies" => $tt]);
            return $pdf->stream('listado_de_mp_' . $order->id . '.pdf');
        } else {
            $order = Departure::find($id);
            $recipe = Recipe::find($order->recipe_id);
            $totals = DB::select('SELECT quantity + (quantity * (excess / 100)) as "Total" FROM recipe_supplies where recipe_id = :id AND type = 1', ["id" => $order->recipe_id]);
            $tt = 0;
            foreach ($totals as $total) {
                $tt += $total->Total;
            }
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.pdf', ["order" => $order, "recipe" => $recipe, "totalSupplies" => $tt]);
            return $pdf->stream('orden_de_fabricación_' . $order->id . '.pdf');
        }
    }

    public function edit($id)
    {
        $recipes = Recipe::all();
        $clients = Client::all();
        $departure = Departure::find($id);

        if (Auth::user()->role_id == 3) {
            return view('departures.edit_ware', ['departure' => $departure, 'recipes' => $recipes, 'clients' => $clients]);
        } else {
            return view('departures.edit', ['departure' => $departure, 'recipes' => $recipes, 'clients' => $clients]);
        }
    }

    public function updateItems(Request $request, $id)
    {

        $x = 0;

        foreach ($request->id as $key => $value) {

            $departureItem = DepartureItem::where('id', $request->id[$key])->first();
            $departureItem->deliver_date = date('Y-m-d');// $request->deliverDate[$key];
            $departureItem->deliver_quantity = $request->deliverQuantity[$key];

            $totalQuantity = $this->convert($departureItem->supply->measurement_buy, $departureItem->supply->measurement_use, ($departureItem->quantity + ($departureItem->quantity * ($departureItem->excess / 100)) * $departureItem->departure->quantity));
            if ($request->processed[$key] == 0 && $request->orderNumber[$key] !== NULL) {

                $ids = explode(",", $request->orderNumber[$key]);

                $total = $this->convert($departureItem->supply->measurement_buy, $departureItem->supply->measurement_use, ($departureItem->quantity + ($departureItem->quantity * ($departureItem->excess / 100)) * $departureItem->departure->quantity));

                foreach ($ids as $idx) {

                    $entrance = EntranceItem::find($idx);
                    $realQuantity = $this->convert($entrance->supply->measurement_buy, $entrance->supply->measurement_use, $entrance->quantity);
                    if ($total >= $realQuantity) {
                        $entrance->quantity = 0;
                        $different = $realQuantity;
                    } else {
                        $entrance->quantity = $this->reverse($entrance->supply->measurement_buy, $entrance->supply->measurement_use, ($realQuantity - $total));
                        $different = $total;
                    }

                    $entrance->save();

                    $supply = Supply::find($request->supplyId[$key]);
                    if ($total >= $realQuantity) {
                        $supply->stock = $supply->stock - $realQuantity;
                    } else {
                        $supply->stock = 0;
                    }

                    $supply->save();

                    $total -= $realQuantity;

                    $die = new DepartureItemEntrance();
                    $die->departure_item_id = $departureItem->id;
                    $die->quantity = $this->reverse($entrance->supply->measurement_buy, $entrance->supply->measurement_use, $totalQuantity);
                    $die->delivery_quantity = $this->reverse($entrance->supply->measurement_buy, $entrance->supply->measurement_use, $different);
                    $die->entrance_number = $idx;
                    $die->supply_id = $request->supplyId[$key];
                    $die->save();

                    if ($total <= 0) {
                        break;
                    }
                }

                $departureItem->processed = 1;
            }

            if ($x == 0) {
                $departure =  Departure::find($departureItem->departure_id);
                $departure->user_id = Auth::user()->id;
                $departure->save();
            }
            $x++;

            $departureItem->save();
        }

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.order_numbers', ["departure" => $departure]);
        return $pdf->stream('numeros_de_entrada' . $departure->id . '.pdf');

        return redirect('ordenes-de-fabricacion')->with('success', 'Orden actualizada correctamente');
    }

    public function scan($id)
    {
        $departure = Departure::find($id);
        if ($departure->status == 'Inspección') {
            return redirect('ordenes-de-fabricacion')->with('success', 'La orden de fabricación ya ha finalizado');
        }
        return view('departures.scan', ["departure" => $departure]);
    }

    public function update(Request $request, $id)
    {
        $departure = Departure::find($id);

        if ($request->way !== NULL) {


            if ($departure->status == 'Creada' && $request->status == 'Pesado') {

                /*if(DepartureItem::where('departure_id', $id)->where("order_number", NULL)->count() > 0){
                    return redirect('ordenes-de-fabricacion')->with('error', 'No se pudo actualizar el estatus, algunos insumos de la orden aun no tiene número de entrada asignado.');
                }*/

                /*foreach ($departure->items as $item) {
                    $supply = Supply::find($item->supplie_id);
                    $supply->stock = $supply->stock - (($item->quantity + ($item->quantity * ($item->excess / 100))) * $departure->quantity);
                    $supply->save();
                }*/

                if ($departure->type == 2 || $departure->type == 3) {
                    $departure->visible = false;
                }
            }

            $departure->recipe_id = $request->recipe;
            $departure->client_id = $request->client;
            $departure->lot = $request->lot;
            $departure->line = $request->line;
            $departure->quantity = $request->quantity;

            $departure->status = $request->status == NULL ? 'Creada' : $request->status;
        } else {

            switch ($departure->status) {
                case "Creada":
                    $newStatus = "Pesado";
                    break;
                case "Pesado":
                    $newStatus = "Preparación";
                    break;
                case "Preparación":
                    $newStatus = "Encapsulado";
                    break;
                case "Encapsulado":
                    $newStatus = "Secado";
                    break;
                case "Secado":
                    $newStatus = "Granel";
                    break;
                case "Granel":
                    $newStatus = "Inspección";
                    break;
                default:
                    $newStatus = "N/A";
                    break;
            }

            if ($newStatus == 'Inspección') {
                Departure::where('order_number', $departure->order_number)->update(["quantity_real" => $request->total]);
            }

            if ($newStatus == 'Pesado') {

                /*foreach ($departure->items as $item) {
                    $supply = Supply::find($item->supplie_id);
                    $supply->stock = $supply->stock - (($item->quantity + ($item->quantity * ($item->excess / 100))) * $departure->quantity);
                    $supply->save();
                }*/

                if ($departure->type == 2 || $departure->type == 3) {
                    $departure->visible = false;
                }
            }

            $departure->status = $newStatus;
        }


        $departure->save();

        try {
            Mail::send('emails.departure_update', ["order_number" => $departure->order_number, "type" => $departure->type, "user_name" => Auth::user()->name, "status" => $newStatus], function ($message) {
                $message->from('info@lindypharma.com', 'Lindy Pharma');
                $message->to('angelrodriguez@ucol.mx');
                $message->subject('Orden de Fabricación Actualizada');
            });
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect('ordenes-de-fabricacion')->with('success', 'Orden actualizada correctamente');
    }

    public function destroy($id)
    {
        $departure = Departure::where("order_number", $id)->update(['status' => 'Cancelada']);

        $logbook = new Logbook();
        $logbook->type_id = 3;
        $logbook->title = 'Orden de Fabricación Cancelada';
        $logbook->content = 'La orden de fabricación #' . $id . ' ha sido cancelada';
        $logbook->icon = 'fas fa-clipboard';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        try {

            Mail::send('emails.departure_cancel', ["order_number" => $id, "user_name" => Auth::user()->name], function ($message) {
                $message->from('info@lindypharma.com', 'Lindy Pharma');
                $message->to('angelrodriguez@ucol.mx');
                $message->subject('Orden de Fabricación Cancelada');
            });
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect('ordenes-de-fabricacion')->with('success', 'Orden cancelada correctamente');
    }

    private function convert($type1, $type2, $quantity)
    {
        $total = 0;

        if ($type1 == 2 && $type2 == 1) {
            $total = $quantity * 1000;
        } elseif ($type1 == 2 && $type2 == 6) {
            $total = $quantity * 1000000;
        } elseif ($type1 == 4 && $type2 == 6) {
            $total = $quantity * 1000;
        } elseif ($type1 == 4 && $type2 == 3) {
            $total = $quantity * 1000;
        } else {
            $total = $quantity;
        }

        return $total;
    }

    private function reverse($type1, $type2, $quantity)
    {
        $total = 0;

        if ($type1 == 2 && $type2 == 1) {
            $total = $quantity / 1000;
        } elseif ($type1 == 2 && $type2 == 6) {
            $total = $quantity / 1000000;
        } elseif ($type1 == 4 && $type2 == 6) {
            $total = $quantity / 1000;
        } elseif ($type1 == 4 && $type2 == 3) {
            $total = $quantity / 1000;
        } else {
            $total = $quantity;
        }

        return $total;
    }
}
