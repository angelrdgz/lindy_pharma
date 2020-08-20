<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Decrease;
use App\DecreaseSupply;
use App\DecreaseSupplyEntrance;
use App\Departure;
use App\EntranceItem;
use App\Supply;

use Illuminate\Support\Facades\Auth;
use PDF;

class DecreaseController extends Controller
{
    public function index()
    {
        switch (Auth::user()->role_id) {
            case 1:
                $decreases = Decrease::all();
                break;
            case 2:
                $decreases = Decrease::where('status', 'Creada')->get();
                break;
            case 3:
                $decreases = Decrease::where('status', 'Liberado')->get();
                break;
            default:
            $decreases = Decrease::all();
                break;
        }
        
        return view('decreases.index', ["decreases" => $decreases]);
    }

    public function create()
    {
        $supplies = Supply::all();
        $orderNumbers = Departure::where("status", "!=", "Cancelada")->get();
        return view('decreases.create', ["orderNumbers" => $orderNumbers, "supplies" => $supplies]);
    }

    public function store(Request $request)
    {
        switch (Auth::user()->id) {
            case 1:
            case 2:
                $request->validate(
                    [
                        'idSupply' => 'required|array',
                        'description' => 'required',
                    ],
                    [
                        'idSupply.required' => 'La descarga requiere al menos un insumo',
                        'idSupply.array' => 'La descarga requiere al menos un insumo',
                        'description.required' => 'La descripción es requerida',
                    ]
                );
                break;
            case 6:
                $request->validate(
                    [
                        'order_number' => 'required',
                        'description' => 'required',
                    ],
                    [
                        'order_number.required' => 'La orden de trabajo es requerida.',
                        'description.required' => 'La descripción es requerida',
                    ]
                );
                break;

            default:
                $request->validate(
                    [
                        'idSupply' => 'required|array',
                        'description' => 'required',
                    ],
                    [
                        'idSupply.required' => 'La descarga requiere al menos un insumo',
                        'idSupply.array' => 'La descarga requiere al menos un insumo',
                        'description.required' => 'La descripción es requerida',
                    ]
                );
                break;
        }

        $decrease = new Decrease();
        $decrease->departure_id = $request->order_number;
        $decrease->description = $request->description;
        $decrease->created_by = Auth::user()->id;
        $decrease->status = 'Creada';
        $decrease->save();

        foreach ($request->idSupply as $key => $value) {
            $decreaseSupply = new DecreaseSupply();
            $decreaseSupply->decrease_id = $decrease->id;
            $decreaseSupply->supply_id = $request->idSupply[$key];
            $decreaseSupply->quantity = $request->quantity[$key] / 1000;
            $decreaseSupply->save();

            /*$entranceNumbers = explode(",", $request->quantity[$key]);

                foreach ($entranceNumbers as $kex => $value) {
                    $decreaseEntrance = new DecreaseSupplyEntrance();
                    $decreaseEntrance->decrease_supply_id = $decreaseSupply->id;
                    $decreaseEntrance->quantity = $request->quantity[$key];
                    $decreaseEntrance->entrance_number = $entranceNumbers[$kex];
                    $decreaseEntrance->save();
                }*/
        }

        return redirect('descargas')->with('success', 'Descarga creada correctamente');
    }

    public function show($id)
    {
        $decrease = Decrease::find($id);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.supply_decrease', ["decrease" => $decrease]);
        return $pdf->stream('descarga_de_insumos_' . $decrease->id . '.pdf');
    }

    public function edit($id)
    {
        $orderNumbers = Departure::where("status", "!=", "Cancelada")->get();
        $decrease = Decrease::find($id);
        if (Auth::user()->role_id == 3)
            return view('decreases.edit_ware', ["orderNumbers" => $orderNumbers, "decrease" => $decrease]);
        else
            return view('decreases.edit', ["orderNumbers" => $orderNumbers, "decrease" => $decrease]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'idSupply' => 'required|array',
                'description' => 'required',
            ],
            [
                'idSupply.required' => 'La descarga requiere al menos un insumo',
                'idSupply.array' => 'La descarga requiere al menos un insumo',
                'description.required' => 'La descripción es requerida',
            ]
        );
        $decrease = Decrease::find($id);
        $decrease->departure_id = $request->order_number;
        $decrease->description = $request->description;
        $decrease->status = $request->status == NULL ? $decrease->status:$request->status;
        $decrease->created_by = Auth::user()->id;
        $decrease->save();

        $decrease->supplies()->delete();

        foreach ($request->idSupply as $key => $value) {
            $decreaseSupply = new DecreaseSupply();
            $decreaseSupply->decrease_id = $decrease->id;
            $decreaseSupply->supply_id = $request->idSupply[$key];
            $decreaseSupply->quantity = $request->quantity[$key] / 1000;
            $decreaseSupply->save();

            /*$entranceNumbers = explode(",", $request->quantity[$key]);

                foreach ($entranceNumbers as $kex => $value) {
                    $decreaseEntrance = new DecreaseSupplyEntrance();
                    $decreaseEntrance->decrease_supply_id = $decreaseSupply->id;
                    $decreaseEntrance->quantity = $request->quantity[$key];
                    $decreaseEntrance->entrance_number = $entranceNumbers[$kex];
                    $decreaseEntrance->save();
                }*/
        }

        return redirect('descargas')->with('success', 'Descarga modificada correctamente');
    }

    public function updateItems(Request $request, $id)
    {
        $x = 0;
        foreach ($request->idRow as $key => $value) {

            $departureItem = DecreaseSupply::where('id', $request->idRow[$key])->first();
            $departureItem->delivery_date = date('Y-m-d'); // $request->deliverDate[$key];
            $departureItem->delivery_quantity = $request->quantity[$key] / 1000;

            $totalNeedIt = $this->convert($departureItem->supply->measurement_buy, $departureItem->supply->measurement_use, $departureItem->quantity);
            //echo "Total necesario: " . $totalNeedIt . '<br>';
            if ($request->processed[$key] == 0 && $request->entranceNumbers[$key] !== NULL) {

                $ids = explode(",", $request->entranceNumbers[$key]);

                $totalForDiscount = $totalNeedIt; //convert($departureItem->supply->measurement_buy, $departureItem->supply->measurement_use, ($departureItem->quantity + ($departureItem->quantity * ($departureItem->excess / 100)) * $departureItem->departure->quantity));

                //echo "Total a descontar: " . $totalForDiscount . '<br>';

                foreach ($ids as $idx) {

                    $entrance = EntranceItem::find($idx);
                    $entranceQuantity = $this->convert($entrance->supply->measurement_buy, $entrance->supply->measurement_use, $entrance->available_quantity);
                    //echo "Disponible en entra #" . $entrance->id . ": " . $entranceQuantity . '<br>';
                    if ($totalForDiscount >= $entranceQuantity) {
                        $entrance->available_quantity = 0;
                        //echo "El total a descontar es mayor a la cantidad disponible en la entrada<br>";
                    } else {
                        //echo "El total a descontar es menor a la cantidad disponible en la entrada<br>";
                        $entrance->available_quantity = $this->reverse($entrance->supply->measurement_buy, $entrance->supply->measurement_use, ($entranceQuantity - $totalForDiscount));
                        //echo "Cantidad a actualizar:" . $entrance->available_quantity . "<br>";
                    }

                    $entrance->save();

                    $supply = Supply::find($request->idSupply[$key]);
                    if ($totalForDiscount >= $entranceQuantity) {
                        //echo "ID: ".$request->idSupply[$key].", Stock actual: " . $supply->stock . ', Cantidad a descontar: ' . $entranceQuantity . ' queda en: ' . ($supply->stock - $entranceQuantity) . '<br>';
                        $supply->stock = $supply->stock - $entranceQuantity;
                        $different = $entranceQuantity;
                    } else {
                        //echo "Stock actual: " . $supply->stock . ', Cantidad a descontar: ' . $totalForDiscount . ' queda en: ' . ($supply->stock - $totalForDiscount) . '<br>';
                        $supply->stock = $supply->stock - $totalForDiscount;
                        $different = $totalForDiscount;
                    }

                    $supply->save();

                    //echo "Se ocupaba: " . $totalNeedIt . ' y se pago: ' . $different . '<br>';
                    //echo "=======================================<br><br>";

                    $die = new DecreaseSupplyEntrance();
                    $die->decrease_supply_id = $departureItem->id;
                    $die->quantity = $totalNeedIt;
                    $die->delivery_quantity = $different;
                    $die->entrance_number = $idx;
                    $die->supply_id = $request->idSupply[$key];
                    $die->save();

                    $totalForDiscount -= $entranceQuantity;

                    if ($totalForDiscount <= 0) {
                        break;
                    }
                }

                $departureItem->processed = 1;
            }

            if ($x == 0) {
                $departure =  Decrease::find($departureItem->decrease_id);
                $departure->user_id = Auth::user()->id;
                $departure->save();
            }
            $x++;

            $departureItem->save();
        }

        /*$pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.order_numbers', ["departure" => $departure]);
        return $pdf->stream('numeros_de_entrada' . $departure->id . '.pdf');*/

        return redirect('descargas')->with('success', 'Descarga procesada correctamente');
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
