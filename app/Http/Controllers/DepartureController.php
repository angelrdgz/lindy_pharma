<?php

namespace App\Http\Controllers;


use App\Departure;
use App\Product;
use Illuminate\Http\Request;

use Auth;
use PDF;
use QrCode;

class DepartureController extends Controller
{
    public function index()
    {
        $orders = Departure::all();
        return view('departures.index', ['orders'=>$orders]);
    }

    public function create()
    {
        $products = Product::all();
        return view('departures.create', ['products'=>$products]);
    }

    public function store(Request $request)
    {
        $product = Product::find($request->product);

        $folderPath = public_path('images/qrcode');
        if (!file_exists($folderPath))
        {
            $response = mkdir($folderPath);
        }

        if($product->supplies->count() > 0){

            $departure = new Departure();
            $departure->product_id = $request->product;
            $departure->client = $request->client;
            $departure->mold = $request->mold;
            $departure->line = $request->line;
            $departure->status = "creada";
            $departure->quantity = $request->quantity;
            $departure->created_by = Auth::user()->id;
            $departure->type = 1;
            $departure->save();

            QrCode::size(150)->format('png')->generate(url('ordenes-de-fabricacion/'.$departure->id), public_path('images/qrcode/qrcode_'.$departure->id.'.png'));

        }

        if($product->suppliesCover->count() > 0){

            $departure = new Departure();
            $departure->product_id = $request->product;
            $departure->client = $request->client;
            $departure->mold = $request->mold;
            $departure->line = $request->line;
            $departure->status = "creada";
            $departure->quantity = $request->quantity;
            $departure->created_by = Auth::user()->id;
            $departure->type = 2;
            $departure->save();

            QrCode::size(150)->format('png')->generate(url('ordenes-de-fabricacion/'.$departure->id), public_path('images/qrcode/qrcode_'.$departure->id.'.png'));

        }

        

        return redirect('ordenes-de-fabricacion')->with('success', 'Orden creada correctamente');
    }

    public function show($id)
    {
        $order = Departure::find($id);
        $product = Product::find($order->product_id);
        //return view('pdfs.pdf', ["order"=>$order, "product"=>$product]);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.pdf', ["order"=>$order, "product"=>$product]);  
        return $pdf->download('orden_de_fabricación_'.$order->id.'.pdf');
    }
}
