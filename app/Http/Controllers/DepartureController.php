<?php

namespace App\Http\Controllers;

use App\Client;
use App\Departure;
use App\Product;
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
        $orders = Departure::all();
        return view('departures.index', ['orders' => $orders]);
    }

    public function create()
    {
        $products = Product::all();
        $clients = Client::all();
        return view('departures.create', ['products' => $products, 'clients' => $clients]);
    }

    public function store(Request $request)
    {
        $product = Product::find($request->product);

        $total = Departure::count();

        $order_number = "OT-" . sprintf("%04s", $total == 0 ? "1" : (($total / 2) + 1));

        $folderPath = public_path('images/qrcode');
        if (!file_exists($folderPath)) {
            $response = mkdir($folderPath);
        }

        if ($product->supplies->count() > 0) {

            $departure = new Departure();
            $departure->order_number = $order_number;
            $departure->product_id = $request->product;
            $departure->client_id = $request->client;
            $departure->lot = $request->lot;
            $departure->line = $request->line;
            $departure->status = "creada";
            $departure->quantity = $request->quantity;
            $departure->created_by = Auth::user()->id;
            $departure->type = 1;
            $departure->save();

            Mail::send('emails.departure', ["order_number" => $order_number, "user_name" => Auth::user()->name, "link" => env("APP_URL").'ordenes-de-fabricación/' . $departure->id], function ($message) {
                $message->from('info@lindypharma.com', 'Lindy Pharma');
                $message->to('angelrodriguez@ucol.mx');
                $message->subject('Orden de Fabricación Creada');
            });

            QrCode::size(150)->format('png')->generate(env('APP_URL').'ordenes-de-fabricacion/' . $departure->id.'/escanear', public_path('images/qrcode/qrcode_' . $departure->id . '.png'));
        }

        if ($product->suppliesCover->count() > 0) {

            $departure = new Departure();
            $departure->order_number = $order_number;
            $departure->product_id = $request->product;
            $departure->client_id = $request->client;
            $departure->lot = $request->lot;
            $departure->line = $request->line;
            $departure->status = "creada";
            $departure->quantity = $request->quantity;
            $departure->created_by = Auth::user()->id;
            $departure->type = 2;
            $departure->save();

            QrCode::size(150)->format('png')->generate(env('APP_URL').'ordenes-de-fabricacion/' . $departure->id.'/escanear', public_path('images/qrcode/qrcode_' . $departure->id . '.png'));
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
        $product = Product::find($order->product_id);
        $totals = DB::select('SELECT quantity + (quantity * (excess / 100)) as "Total" FROM product_supplies where product_id = :id AND type = :type', ["id"=>$order->product_id, "type"=>$order->type]);
        $tt = 0;
        foreach($totals as $total){
            $tt += $total->Total;
        }
        //return view('pdfs.pdf', ["order"=>$order, "product"=>$product, "totalSupplies"=>$tt]);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.pdf', ["order" => $order, "product" => $product, "totalSupplies"=>$tt]);
        return $pdf->download('orden_de_fabricación_' . $order->id . '.pdf');
    }

    public function scan($id)
    {
        $departure = Departure::find($id);
        if($departure->status == 'Finalizada'){
            return redirect('ordenes-de-fabricacion')->with('success', 'La orden de compra ya ha finalizado');
        }
        return view('departures.scan', ["departure"=>$departure]);
    }

    public function update(Request $request, $id)
    {
        $departure = Departure::find($id);

        Departure::where('order_number', $departure->order_number)->update(["status"=>"Finalizada"]);

        Mail::send('emails.departure_update', ["order_number" => $departure->order_number, "user_name" => Auth::user()->name, "status" => "Finalizada"], function ($message) {
            $message->from('info@lindypharma.com', 'Lindy Pharma');
            $message->to('angelrodriguez@ucol.mx');
            $message->subject('Orden de Fabricación Actualizada');
        });

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

        Mail::send('emails.departure_cancel', ["order_number" => $departure->order_number, "user_name" => Auth::user()->name], function ($message) {
            $message->from('info@lindypharma.com', 'Lindy Pharma');
            $message->to('angelrodriguez@ucol.mx');
            $message->subject('Orden de Fabricación Cancelada');
        });

        return redirect('ordenes-de-fabricación')->with('success', 'Orden cancelada correctamente');
    }
}
