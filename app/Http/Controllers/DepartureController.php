<?php

namespace App\Http\Controllers;

use App\Client;
use App\Departure;
use App\Recipe;
use App\Supply;
use App\DepartureItem;
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
        $orders = Departure::where('visible', true)->where('status','!=', 'Cancelada')->get();
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
        $order = Departure::find($id);
        $recipe = Recipe::find($order->recipe_id);
        $totals = DB::select('SELECT quantity + (quantity * (excess / 100)) as "Total" FROM recipe_supplies where recipe_id = :id AND type = :type', ["id" => $order->recipe_id, "type" => $order->type]);
        $tt = 0;
        foreach ($totals as $total) {
            $tt += $total->Total;
        }
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.pdf', ["order" => $order, "recipe" => $recipe, "totalSupplies" => $tt]);
        return $pdf->stream('orden_de_fabricación_' . $order->id . '.pdf');
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
        foreach ($request->id as $key => $value) {
            if ($request->orderNumber[$key] !== NULL) {
                DepartureItem::where('id', $request->id[$key])->update(["order_number" => $request->orderNumber[$key]]);
            }
        }
        return redirect('ordenes-de-fabricacion')->with('success', 'Orden actualizada correctamente');
    }

    public function scan($id)
    {
        $departure = Departure::find($id);
        if ($departure->status == 'Granel') {
            return redirect('ordenes-de-fabricacion')->with('success', 'La orden de fabricación ya ha finalizado');
        }
        return view('departures.scan', ["departure" => $departure]);
    }

    public function update(Request $request, $id)
    {
        $departure = Departure::find($id);

        if($request->status != NULL){

            $departure->status = $request->status;

            if ($departure->status == 'Creada' && $request->status == 'Pesado') {
                foreach ($departure->recipe->items as $item) {
                    $supply = Supply::find($item->supply_id);
                    $supply->stock = $supply->stock - (($supply->quantity + ($supply->quantity * ($supply->excess / 100))) * $departure->quantity);
                    $supply->save();
                }
                if ($departure->type == 2) {
                    $departure->visible = false;
                }
            }

        }else{

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
                default:
                    $newStatus = "N/A";
                    break;
            }
    
            if ($newStatus == 'Pesado') {
                foreach ($departure->recipe->items as $item) {
                    $supply = Supply::find($item->supply_id);
                    $supply->stock = $supply->stock - (($supply->quantity + ($supply->quantity * ($supply->excess / 100))) * $departure->quantity);
                    $supply->save();
                }
                if ($departure->type == 2) {
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
        $departure = Departure::where("order_number", $id)->first();
        $departure->status = 'Cancelada';
        $departure->save();

        $logbook = new Logbook();
        $logbook->type_id = 3;
        $logbook->title = 'Orden de Fabricación Cancelada';
        $logbook->content = 'La orden de fabricación #' . $id . ' ha sido cancelada';
        $logbook->icon = 'fas fa-clipboard';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        try {

            Mail::send('emails.departure_cancel', ["order_number" => $departure->order_number, "user_name" => Auth::user()->name], function ($message) {
                $message->from('info@lindypharma.com', 'Lindy Pharma');
                $message->to('angelrodriguez@ucol.mx');
                $message->subject('Orden de Fabricación Cancelada');
            });
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect('ordenes-de-fabricación')->with('success', 'Orden cancelada correctamente');
    }
}
