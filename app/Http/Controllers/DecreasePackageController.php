<?php

namespace App\Http\Controllers;

use App\DecreasePackage;
use App\DecreasePackageRecipe;
use App\DecreasePackageRecipeLot;
use App\DecreasePackageSupply;
use App\DecreasePackageSupplyEntrance;
use App\Package;
use App\EntranceItem;
use App\Supply;
use App\Departure;
use App\Recipe;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DecreasePackageController extends Controller
{
    public function index()
    {
        switch (Auth::user()->role_id) {
            case 1:
                $decreases = DecreasePackage::all();
                break;
            case 2:
                $decreases = DecreasePackage::where('status', 'Creada')->get();
                break;
            case 3:
                $decreases = DecreasePackage::where('status', 'Liberado')->get();
                break;
            default:
            $decreases = DecreasePackage::all();
                break;
        }

        return view('decreases_granel.index', ["decreases" => $decreases]);
    }

    public function create()
    {
        $supplies = Supply::all();
        $recipes = Recipe::all();
        $orderNumbers = Package::where("status", "!=", "Cancelada")->get();
        return view('decreases_granel.create', ["orderNumbers" => $orderNumbers, "supplies" => $supplies, "recipes" => $recipes]);
    }

    public function store(Request $request)
    {
        switch (Auth::user()->role_id) {
            case 1:
                $request->validate(
                    [
                        'package_id' => 'required',
                        'description' => 'required',
                    ],
                    [
                        'package_id.required' => 'El número de orden es requerido.',
                        'description.required' => 'La descripción es requerida',
                    ]
                );
                break;
            case 2:
                $request->validate(
                    [
                        'description' => 'required',
                    ],
                    [
                        'description.required' => 'La descripción es requerida',
                    ]
                );
                break;
            default:
                $request->validate(
                    [
                        'package_id' => 'required',
                        'description' => 'required',
                    ],
                    [
                        'package_id.required' => 'El número de orden es requerido.',
                        'description.required' => 'La descripción es requerida.',
                    ]
                );
                break;
        }

        $decrease = new DecreasePackage();
        $decrease->package_id = $request->package_id;
        $decrease->description = $request->description;
        $decrease->created_by = Auth::user()->id;
        $decrease->status = 'Creada';
        $decrease->save();

        if ($request->idRecipe !== NULL) {

            foreach ($request->idRecipe as $key => $value) {
                $decreaseSupply = new DecreasePackageRecipe();
                $decreaseSupply->decrease_package_id = $decrease->id;
                $decreaseSupply->recipe_id = $request->idRecipe[$key];
                $decreaseSupply->quantity = $request->quantityRecipe[$key];
                $decreaseSupply->save();
            }
        }

        if ($request->idSupply !== NULL) {

            foreach ($request->idSupply as $key => $value) {
                $decreaseSupply = new DecreasePackageSupply();
                $decreaseSupply->decrease_package_id = $decrease->id;
                $decreaseSupply->supply_id = $request->idSupply[$key];
                $decreaseSupply->quantity = $request->quantity[$key];
                $decreaseSupply->save();
            }
        }

        return redirect('descargas-granel')->with('success', 'Descarga creada correctamente');
    }

    public function show($id)
    {
        $decrease = DecreasePackage::find($id);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.departure_decrease', ["decrease" => $decrease]);
        return $pdf->stream('descarga_de_granel_' . $decrease->id . '.pdf');
    }

    public function edit($id)
    {
        $orderNumbers = Package::where("status", "!=", "Cancelada")->get();
        $decrease = DecreasePackage::find($id);
        if (Auth::user()->role_id == 3)
            return view('decreases_granel.edit_ware', ["orderNumbers" => $orderNumbers, "decrease" => $decrease]);
        else
            return view('decreases_granel.edit', ["orderNumbers" => $orderNumbers, "decrease" => $decrease]);
    }

    public function update(Request $request, $id)
    {
        switch (Auth::user()->role_id) {
            case 2:
                $request->validate(
                    [
                        'description' => 'required',
                    ],
                    [
                        'description.required' => 'La descripción es requerida',
                    ]
                );
                break;
            default:
                $request->validate(
                    [
                        'package_id' => 'required',
                        'description' => 'required',
                    ],
                    [
                        'package_id.required' => 'El número de orden es requerido.',
                        'description.required' => 'La descripción es requerida.',
                    ]
                );
                break;
        }

        $decrease = DecreasePackage::find($id);
        $decrease->package_id = $request->package_id;
        $decrease->description = $request->description;
        $decrease->created_by = Auth::user()->id;
        $decrease->status = $request->status == NULL ? $decrease->status:$request->status;
        $decrease->save();

        $decrease->recipes()->delete();
        $decrease->supplies()->delete();

        if ($request->idRecipe !== NULL) {

            foreach ($request->idRecipe as $key => $value) {
                $decreaseSupply = new DecreasePackageRecipe();
                $decreaseSupply->decrease_package_id = $decrease->id;
                $decreaseSupply->recipe_id = $request->idRecipe[$key];
                $decreaseSupply->quantity = $request->quantityRecipe[$key];
                $decreaseSupply->save();
            }
        }

        if ($request->idSupply !== NULL) {

            foreach ($request->idSupply as $key => $value) {
                $decreaseSupply = new DecreasePackageSupply();
                $decreaseSupply->decrease_package_id = $decrease->id;
                $decreaseSupply->supply_id = $request->idSupply[$key];
                $decreaseSupply->quantity = $request->quantity[$key];
                $decreaseSupply->save();
            }
        }

        return redirect('descargas-granel')->with('success', 'Descarga modificada correctamente');
    }

    public function updateItems(Request $request, $id)
    {
        $x = 0;

        if ($request->idRowRecipe !== NULL) {

            foreach ($request->idRowRecipe as $key => $value) {

                $departureItem = DecreasePackageRecipe::find($request->idRowRecipe[$key]);
                $departureItem->delivery_date = date('Y-m-d'); // $request->deliverDate[$key];
                $departureItem->delivery_quantity = $request->quantityRecipe[$key];

                $totalNeedIt = $departureItem->quantity;
                if ($request->processedRecipe[$key] == 0 && $request->lotNumbers[$key] !== NULL) {

                    $ids = explode(",", $request->lotNumbers[$key]);

                    $totalForDiscount = $totalNeedIt;

                    foreach ($ids as $idx) {

                        $entrance = Departure::find($idx);
                        $lotQuantity = $entrance->available_quantity;
                        if ($totalForDiscount >= $lotQuantity) {
                            $entrance->available_quantity = 0;
                            $different = $lotQuantity;
                        } else {
                            $entrance->available_quantity = $lotQuantity - $totalForDiscount;
                            $different = $totalForDiscount;
                        }

                        $recipe = Recipe::find($request->idRecipe[$key]);
                        if ($totalForDiscount >= $lotQuantity) {
                            $recipe->stock = $recipe->stock - $lotQuantity;
                        } else {
                            $recipe->stock = $recipe->stock - $totalForDiscount;
                        }

                        $recipe->save();
                        $entrance->save();

                        $totalForDiscount -= $lotQuantity;

                        $die = new DecreasePackageRecipeLot();
                        $die->decrease_package_recipe_id = $departureItem->id;
                        $die->quantity = $totalNeedIt;
                        $die->delivery_quantity = $different;
                        $die->lot_number = $idx;
                        $die->recipe_id = $request->idRecipe[$key];
                        $die->save();

                        if ($totalForDiscount <= 0) {
                            break;
                        }
                    }

                    $departureItem->processed = 1;
                }

                if ($x == 0) {
                    $package =  Package::find($id);
                    $package->user_id = Auth::user()->id;
                    $package->save();
                }
                $x++;

                $departureItem->save();
            }
        }

        if ($request->idRow !== NULL) {

            foreach ($request->idRow as $kex => $value) {

                $departureItem = DecreasePackageSupply::where('id', $request->idRow[$kex])->first();
                $departureItem->delivery_date = date('Y-m-d'); // $request->deliverDate[$kex];
                $departureItem->delivery_quantity = $request->quantity[$kex];

                $totalNeedIt = $departureItem->quantity;
                //echo "Total necesario: " . $totalNeedIt . '<br>';
                if ($request->processed[$kex] == 0 && $request->entranceNumbers[$kex] !== NULL) {

                    $ids = explode(",", $request->entranceNumbers[$kex]);

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

                        $supply = Supply::find($request->idSupply[$kex]);
                        if ($totalForDiscount >= $entranceQuantity) {
                            //echo "ID: ".$request->idSupply[$kex].", Stock actual: " . $supply->stock . ', Cantidad a descontar: ' . $entranceQuantity . ' queda en: ' . ($supply->stock - $entranceQuantity) . '<br>';
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

                        $die = new DecreasePackageSupplyEntrance();
                        $die->decrease_package_supply_id = $departureItem->id;
                        $die->quantity = $totalNeedIt;
                        $die->delivery_quantity = $different;
                        $die->entrance_number = $idx;
                        $die->supply_id = $request->idSupply[$kex];
                        $die->save();

                        $totalForDiscount -= $entranceQuantity;

                        if ($totalForDiscount <= 0) {
                            break;
                        }
                    }

                    $departureItem->processed = 1;
                }

                if ($x == 0) {
                    $departure =  Package::find($departureItem->package_id);
                    $departure->user_id = Auth::user()->id;
                    $departure->save();
                }
                $x++;

                $departureItem->save();
            }
        }

        /*$pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdfs.order_numbers', ["departure" => $departure]);
        return $pdf->stream('numeros_de_entrada' . $departure->id . '.pdf');*/

        return redirect('descargas-granel')->with('success', 'Descarga procesada correctamente');
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
