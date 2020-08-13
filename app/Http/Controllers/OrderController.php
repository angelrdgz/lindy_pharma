<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\OrderProduct;
use App\OrderComment;
use App\Product;
use App\Client;
use App\Catalog;
use App\Entrance;
use App\Logbook;
use App\Package;
use Auth;
use PDF;
use QrCode;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', ["orders" => $orders]);
    }

    public function create()
    {
        $products = Product::all();
        $entrances = Entrance::all();
        $clients = Client::all();
        $currencies = Catalog::where('type', 'currency')->get();
        return view('orders.create', ['products' => $products, 'clients' => $clients, 'currencies' => $currencies, 'entrances' => $entrances]);
    }

    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->client_id = $request->client_id;
        $order->order_number = $request->order_number;
        $order->mader = $request->mader;
        $order->authorizer = $request->authorizer;
        $order->commitment_date = $request->commitment_date;
        $order->save();


        QrCode::size(150)->format('png')->generate(url('pedidos/' . $order->id), public_path('images/qrcode/orders/qrcode_order_' . $order->id . '.png'));


        foreach ($request->idItem as $key => $item) {
            if ($request->idItem[$key] !== NULL) {
                $orderItem = new OrderProduct();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $request->idItem[$key];
                $orderItem->quantity = $request->quantityItem[$key];
                $orderItem->save();
            }
        }

        if ($request->comments !== NULL) {
            if (count($request->comments) > 0) {
                foreach ($request->comments as $key => $comment) {
                    if ($comment != NULL) {
                        $orderComment = new OrderComment();
                        $orderComment->order_id = $order->id;
                        $orderComment->comment = $comment;
                        $orderComment->save();
                    }
                }
            }
        }

        $logbook = new Logbook();
        $logbook->type_id = 1;
        $logbook->title = 'Pedido Creado';
        $logbook->content = 'El número de pedido #"' . $order->id . '" ha sido creada';
        $logbook->icon = 'fas fa-file-invoice-dollar';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('pedidos')->with('success', 'Pedido creado correctamente');
    }

    public function edit($id)
    {
        $order = Order::find($id);
        $products = Product::all();
        $entrances = Entrance::all();
        $clients = Client::all();
        $currencies = Catalog::where('type', 'currency')->get();
        return view('orders.edit', ['order' => $order, 'products' => $products, 'clients' => $clients, 'currencies' => $currencies, 'entrances' => $entrances]);
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role_id == 3) {
            $order = Order::find($id);
            $order->delivery = $request->delivery;
            $order->receiver = $request->receiver;
            $order->box_type = $request->box_type;
            $order->clean_box = $request->clean_box;
            $order->observations = $request->observations;
            $order->fumigation = $request->fumigation;
            $order->fumigation_date = $request->fumigation_date;
            $order->own_delivery = $request->own_delivery;
            $order->company = $request->company;
            $order->plates = $request->plates;
            $order->save();

            foreach ($request->idItem as $key => $item) {
                if ($request->idItem[$key] !== NULL) {
                    $orderItem = OrderProduct::find($request->idItem[$key]);
                    if ($orderItem->processed == 0) {
                        $orderItem->quantity_real = $request->realQuantityItem[$key];
                        $orderItem->lot = $request->lotItem[$key];
                        $orderItem->pieces = $request->piecesItem[$key];
                        $orderItem->boxes = $request->boxesItem[$key];
                        $orderItem->partial = $request->partialItem[$key];
                        $orderItem->total = $request->totalItem[$key];
                        $orderItem->processed = 1;
                        $orderItem->save();

                        $prod = Product::find($orderItem->product_id);
                        $prod->stock = $prod->stock - $request->totalItem[$key];
                        $prod->save();

                        $pack = Package::where('lot', $request->lotItem[$key])->first();
                        $pack->available_quantity = $pack->available_quantity - $request->totalItem[$key];
                        $pack->save();
                    }
                }
            }
        } else {
            $order = Order::find($id);
            $order->delivery = $request->delivery;
            $order->mader = $request->mader;
            $order->authorizer = $request->authorizer;
            $order->commitment_date = $request->commitment_date;
            $order->save();


            //QrCode::size(150)->format('png')->generate(url('pedidos/' . $order->id), public_path('images/qrcode/orders/qrcode_order_' . $order->id . '.png'));

            $order->items()->delete();
            $order->comments()->delete();

            foreach ($request->idItem as $key => $item) {
                if ($request->idItem[$key] !== NULL) {
                    $orderItem = new OrderProduct();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $request->idItem[$key];
                    $orderItem->quantity = $request->quantityItem[$key];
                    $orderItem->save();
                }
            }

            if (count($request->comments) > 0) {
                foreach ($request->comments as $key => $comment) {
                    if ($comment != NULL) {
                        $orderComment = new OrderComment();
                        $orderComment->order_id = $order->id;
                        $orderComment->comment = $comment;
                        $orderComment->save();
                    }
                }
            }

            $logbook = new Logbook();
            $logbook->type_id = 2;
            $logbook->title = 'Pedido modificado';
            $logbook->content = 'El número de pedido #"' . $order->id . '" ha sido modificado';
            $logbook->icon = 'fas fa-file-invoice-dollar';
            $logbook->created_by = Auth::user()->id;
            $logbook->save();
        }

        return redirect('pedidos')->with('success', 'Pedido modificado correctamente');
    }

    public function show($id)
    {
        $order = Order::find($id);

        if (Auth::user()->role_id == 3) {
            return view('orders.edit_ware', ['order' => $order]);
        } else {
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.order', ["order" => $order]);
            return $pdf->stream('pedido_' . $order->id . '.pdf');
            //return view('pdfs.entrance', ["entrance"=>$entrance]);
        }
        //return view('pdfs.pdf', ["order"=>$order, "product"=>$product]);
        //
    }

    public function destroy($id)
    {
    }

    public function remitionNote($id)
    {
        $order = Order::find($id);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.note', ["order" => $order]);
        return $pdf->stream('note_de_remision_' . $order->id . '.pdf');
    }
}
