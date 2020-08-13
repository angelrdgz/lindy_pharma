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
use App\DecreaseSupply;
use App\DecreasePackageSupply;
use App\DepartureItem;
use App\PackageSupply;
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
        if ($request->idItem === NULL) {
            return redirect()->back()->with('error', 'No asigno insumos a la orden de compra');
        }

        $entrance = new Entrance();
        $entrance->user_id = Auth::user()->id;
        $entrance->supplier_id = $request->supplier;
        $entrance->cfdi_id = $request->cfdi;
        $entrance->requisition = $request->requisition;
        $entrance->department = $request->department;
        $entrance->owner = $request->owner;
        $entrance->mader = $request->mader;
        $entrance->authorizer = $request->authorizer;
        $entrance->cost_id = $request->costs;
        $entrance->expected_date = $request->expected_date;
        $entrance->save();


        QrCode::size(150)->format('png')->generate(url('ordenes-de-compra/' . $entrance->id), public_path('images/qrcode/entrances/qrcode_entrance_' . $entrance->id . '.png'));


        foreach ($request->idItem as $key => $item) {
            if ($request->idItem[$key] !== NULL) {
                $entranceItem = new EntranceItem();
                $entranceItem->entrance_id = $entrance->id;
                $entranceItem->supply_id = $request->idItem[$key];
                $entranceItem->quantity = $request->quantityItem[$key];
                $entranceItem->available_quantity = $request->quantityItem[$key];
                $entranceItem->price = $request->priceItem[$key];
                $entranceItem->currency_id = $request->currencyItem[$key];
                $entranceItem->status = 'Creada';
                $entranceItem->save();
            }
        }

        if ($request->comments !== NULL) {
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
        $buyer = User::where('role_id', 4)->first();

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

        $oldStatus = $entrance->status;

        $entrance->supplier_id = $request->supplier;
        $entrance->cfdi_id = $request->cfdi;
        $entrance->requisition = $request->requisition;
        $entrance->department = $request->department;
        $entrance->owner = $request->owner;
        $entrance->mader = $request->mader;
        $entrance->authorizer = $request->authorizer;
        $entrance->cost_id = $request->costs;
        $entrance->expected_date = $request->expected_date;

        if ($request->idSupplyItem !== NULL) {
            if (count($request->idSupplyItem) > 0) {
                //$entrance->items()->delete();

                foreach ($request->idSupplyItem as $key => $item) {
                    if ($request->idSupplyItem[$key] != NULL) {
                        if ($request->idItem[$key] == NULL) {

                            if ($request->updated[$key] == -1) {
                                $entranceItem = new EntranceItem();
                                $entranceItem->entrance_id = $entrance->id;
                                $entranceItem->supply_id = $request->idSupplyItem[$key];
                                $entranceItem->quantity = $request->quantityItem[$key];
                                $entranceItem->available_quantity = $request->quantityItem[$key];
                                $entranceItem->price = $request->priceItem[$key];
                                $entranceItem->status = $request->statusItem[$key];
                                $entranceItem->comments = $request->commentsItem[$key];
                                $entranceItem->splitted = $request->splittedItem[$key];
                                $entranceItem->status = $request->statusItem[$key] !== NULL ? $request->statusItem[$key] : 'Creada';
                                $entranceItem->save();
                            } else {
                                $entranceItem = new EntranceItem();
                                $entranceItem->entrance_id = $entrance->id;
                                $entranceItem->supply_id = $request->idSupplyItem[$key];
                                $entranceItem->quantity = $request->quantityItem[$key];
                                $entranceItem->available_quantity = $request->quantityItem[$key];
                                $entranceItem->price = $request->priceItem[$key];
                                $entranceItem->currency_id = $request->currencyItem[$key];
                                $entranceItem->splitted = $request->splittedItem[$key];
                                $entranceItem->status = 'Creada';
                                $entranceItem->save();
                            }
                        } else {

                            if ($request->deletedItem[$key] == 1) {
                                $entranceItem = EntranceItem::find($request->idItem[$key]);
                                $entranceItem->delete();
                            } else {

                                $entranceItem = EntranceItem::find($request->idItem[$key]);
                                $entranceItem->supply_id = $request->idSupplyItem[$key];
                                $entranceItem->quantity = $request->quantityItem[$key];
                                $entranceItem->available_quantity = $request->quantityItem[$key];
                                $entranceItem->price = $request->priceItem[$key];
                                $entranceItem->currency_id = $request->currencyItem[$key];
                                $entranceItem->splitted = $request->splittedItem[$key];
                                $entranceItem->status = $request->statusItem[$key] !== NULL ? $request->statusItem[$key] : 'Creada';
                                $entranceItem->save();

                                if ($request->statusItem[$key] == 'Aprobada' && $request->updated[$key] == 0) {
                                    $supply = Supply::find($request->idSupplyItem[$key]);
                                    $supply->stock = $supply->stock + $this->convert($supply->measurement_buy, $supply->measurement_use, $request->quantityItem[$key]);
                                    $supply->save();
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($request->comments !== NULL) {

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

        $entrance->items()->delete();
        $entrance->comments()->delete();



        $logbook = new Logbook();
        $logbook->type_id = 3;
        $logbook->title = 'Orden de Compra Cancelada';
        $logbook->content = 'La orden de compra #"' . $entrance->id . '" ha sido cancelada';
        $logbook->icon = 'fas fa-cart-arrow-down';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        $entrance->delete();

        return redirect('ordenes-de-compra')->with('success', 'Orden cancelada correctamente');
    }

    public function exportLogbook()
    {
        $items = [];
        $ids = Supply::where('measurement_buy', 2)->pluck("id")->toArray();
        $csvExporter = new \Laracsv\Export();

        $totals = [];

        $departures = DepartureItem::where("deliver_date", "!=", NULL)->whereIn("supplie_id", $ids)->get();

        foreach ($departures as $departure) {
            if ($departure->entrances != NULL) {
                foreach ($departure->entrances as $entrance) {
                    if (!array_key_exists($entrance->entrance_number, $totals)) {
                        $totals[$entrance->entrance_number] = $entrance->entrance->quantity;
                    }

                    $newdata =  array(
                        'Fecha' => date("d/m/Y H:i", strtotime($departure->deliver_date)),
                        'Codigo de MP/MAT' => $departure->supply->code,
                        'Nombre' => $departure->supply->name,
                        'No. Entrada' => "#" . sprintf("%05s", $entrance->entrance_number),
                        'entrance' => $entrance->entrance_number,
                        'Cantidad Entrada (kg)' => $entrance->entrance->quantity,
                        'Cantidad Surtida (kg)' => number_format($this->reverse($departure->supply->measurement_buy, $departure->supply->measurement_use, $entrance->delivery_quantity), 4),
                        'Cantidad Remanente (kg)' => number_format(($totals[$entrance->entrance_number] - $this->reverse($departure->supply->measurement_buy, $departure->supply->measurement_use, $entrance->delivery_quantity)), 4),
                        'Tipo' => 'Producción',
                        'OT' => $departure->departure->order_number,
                        'Producto' => $departure->departure->recipe->name,
                        'Lote' => $departure->departure->lot,
                    );
                    //echo "ID del insumo: ".$departure->supply->id." ID de entrada: ".$entrance->entrance_number." ID de descargar: ".$departure->id." Actual: ".$totals[$entrance->entrance_number].' a descargar: '.$this->reverse($departure->supply->measurement_buy, $departure->supply->measurement_use, $entrance->delivery_quantity).'<br>';
                    $totals[$entrance->entrance_number] -=  $this->reverse($departure->supply->measurement_buy, $departure->supply->measurement_use, $entrance->delivery_quantity);
                    $items[] = $newdata;
                }
            }
        }

        $decreases = DecreaseSupply::where("delivery_date", "!=", NULL)->whereIn("supply_id", $ids)->get();

        foreach ($decreases as $decrease) {
            if ($decrease->entrances != NULL) {
                foreach ($decrease->entrances as $entrance) {
                    if (!array_key_exists($entrance->entrance_number, $totals)) {
                        $totals[$entrance->entrance_number] = $entrance->entrance->quantity;
                    }

                    $newdata =  array(
                        'Fecha' => date("d/m/Y H:i", strtotime($decrease->delivery_date)),
                        'Codigo de MP/MAT' => $decrease->supply->code,
                        'Nombre' => $decrease->supply->name,
                        'No. Entrada' => "#" . sprintf("%05s", $entrance->entrance_number),
                        'entrance' => $entrance->entrance_number,
                        'Cantidad Entrada (kg)' => $entrance->entrance->quantity,
                        'Cantidad Surtida (kg)' => number_format(($entrance->delivery_quantity / 1000), 4),
                        'Cantidad Remanente (kg)' => number_format(($totals[$entrance->entrance_number] - ($entrance->delivery_quantity / 1000)), 4),
                        'Tipo' => 'Descarga',
                        'OT' => $decrease->decrease->departure->order_number,
                        'Producto' => $decrease->decrease->departure->recipe->name,
                        'Lote' => $decrease->decrease->departure->lot,
                    );

                    $totals[$entrance->entrance_number] -= ($entrance->delivery_quantity / 1000);
                    $items[] = $newdata;
                }
            }
        }

        $decreases = DecreasePackageSupply::where("delivery_date", "!=", NULL)->whereIn("supply_id", $ids)->get();

        foreach ($decreases as $decrease) {
            if ($decrease->entrances != NULL) {
                foreach ($decrease->entrances as $entrance) {
                    if (!array_key_exists($entrance->entrance_number, $totals)) {
                        $totals[$entrance->entrance_number] = $entrance->entrance->quantity;
                    }

                    $newdata =  array(
                        'Fecha' => date("d/m/Y H:i", strtotime($decrease->delivery_date)),
                        'Codigo de MP/MAT' => $decrease->supply->code,
                        'Nombre' => $decrease->supply->name,
                        'No. Entrada' => "#" . sprintf("%05s", $entrance->entrance_number),
                        'entrance' => $entrance->entrance_number,
                        'Cantidad Entrada (kg)' => $entrance->entrance->quantity,
                        'Cantidad Surtida (kg)' => number_format(($entrance->delivery_quantity / 1000), 4),
                        'Cantidad Remanente (kg)' => number_format(($totals[$entrance->entrance_number] - ($entrance->delivery_quantity / 1000)), 4),
                        'Tipo' => 'Descarga Paquete',
                        'OT' => $decrease->decrease->departure->order_number,
                        'Producto' => $decrease->decrease->departure->recipe->name,
                        'Lote' => $decrease->decrease->departure->lot,
                    );

                    $totals[$entrance->entrance_number] -= ($entrance->delivery_quantity / 1000);
                    $items[] = $newdata;
                }
            }
        }

        usort($items, function ($a, $b) {
            return $a["entrance"] - $b["entrance"];
        });

        $csvExporter->build($this->r_collect($items), ['Fecha', 'Codigo de MP/MAT', 'Nombre', 'No. Entrada', 'Cantidad Entrada (kg)', 'Cantidad Surtida (kg)', 'Cantidad Remanente (kg)', 'Tipo', 'OT', 'Producto', 'Lote'])->download('inventario_de_materias_primas_' . date('d_m_Y') . '.csv');
    }

    public function exportLogbookMaterial()
    {
        $items = [];
        $ids = Supply::where('measurement_buy', '!=', 2)->pluck("id")->toArray();
        $csvExporter = new \Laracsv\Export();

        $totals = [];

        $departures = DepartureItem::where("deliver_date", "!=", NULL)->whereIn("supplie_id", $ids)->get();

        foreach ($departures as $departure) {
            if ($departure->entrances) {
                foreach ($departure->entrances as $entrance) {
                    if (!array_key_exists($entrance->entrance_number, $totals)) {
                        $totals[$entrance->entrance_number] = $entrance->entrance->quantity;
                    }

                    $newdata =  array(
                        'Fecha' => date("d/m/Y H:i", strtotime($departure->deliver_date)),
                        'Codigo de MP/MAT' => $departure->supply->code,
                        'Nombre' => $departure->supply->name,
                        'No. Entrada' => "#" . sprintf("%05s", $entrance->entrance_number),
                        'entrance' => $entrance->entrance_number,
                        'Cantidad Entrada (pza)' => $entrance->entrance->quantity,
                        'Cantidad Surtida (pza)' => number_format($this->reverse($departure->supply->measurement_buy, $departure->supply->measurement_use, $entrance->delivery_quantity), 4),
                        'Cantidad Remanente (pza)' => number_format(($totals[$entrance->entrance_number] - $this->reverse($departure->supply->measurement_buy, $departure->supply->measurement_use, $entrance->delivery_quantity)), 4),
                        'Tipo' => 'Producción',
                        'OT' => $departure->departure->order_number,
                        'Producto' => $departure->departure->recipe->name,
                        'Lote' => $departure->departure->lot,
                    );
                    //echo "ID del insumo: ".$departure->supply->id." ID de entrada: ".$entrance->entrance_number." ID de descargar: ".$departure->id." Actual: ".$totals[$entrance->entrance_number].' a descargar: '.$this->reverse($departure->supply->measurement_buy, $departure->supply->measurement_use, $entrance->delivery_quantity).'<br>';
                    $totals[$entrance->entrance_number] -=  $this->reverse($departure->supply->measurement_buy, $departure->supply->measurement_use, $entrance->delivery_quantity);
                    $items[] = $newdata;
                }
            }
        }

        $decreases = DecreaseSupply::where("delivery_date", "!=", NULL)->whereIn("supply_id", $ids)->get();

        foreach ($decreases as $decrease) {
            if ($decrease->entrances != NULL) {
                foreach ($decrease->entrances as $entrance) {
                    if (!array_key_exists($entrance->entrance_number, $totals)) {
                        $totals[$entrance->entrance_number] = $entrance->entrance->quantity;
                    }

                    $newdata =  array(
                        'Fecha' => date("d/m/Y H:i", strtotime($decrease->delivery_date)),
                        'Codigo de MP/MAT' => $decrease->supply->code,
                        'Nombre' => $decrease->supply->name,
                        'No. Entrada' => "#" . sprintf("%05s", $entrance->entrance_number),
                        'entrance' => $entrance->entrance_number,
                        'Cantidad Entrada (pza)' => $entrance->entrance->quantity,
                        'Cantidad Surtida (pza)' => number_format(($entrance->delivery_quantity), 4),
                        'Cantidad Remanente (pza)' => number_format(($totals[$entrance->entrance_number] - ($entrance->delivery_quantity)), 4),
                        'Tipo' => 'Descarga',
                        'OT' => $decrease->decrease->departure->order_number,
                        'Producto' => $decrease->decrease->departure->recipe->name,
                        'Lote' => $decrease->decrease->departure->lot,
                    );

                    $totals[$entrance->entrance_number] -= ($entrance->delivery_quantity);
                    $items[] = $newdata;
                }
            }
        }

        $decreases = DecreasePackageSupply::where("delivery_date", "!=", NULL)->whereIn("supply_id", $ids)->get();

        foreach ($decreases as $decrease) {
            if ($decrease->entrances != NULL) {
                foreach ($decrease->entrances as $entrance) {
                    if (!array_key_exists($entrance->entrance_number, $totals)) {
                        $totals[$entrance->entrance_number] = $entrance->entrance->quantity;
                    }

                    $newdata =  array(
                        'Fecha' => date("d/m/Y H:i", strtotime($decrease->delivery_date)),
                        'Codigo de MP/MAT' => $decrease->supply->code,
                        'Nombre' => $decrease->supply->name,
                        'No. Entrada' => "#" . sprintf("%05s", $entrance->entrance_number),
                        'entrance' => $entrance->entrance_number,
                        'Cantidad Entrada (pza)' => $entrance->entrance->quantity,
                        'Cantidad Surtida (pza)' => number_format(($entrance->delivery_quantity), 4),
                        'Cantidad Remanente (pza)' => number_format(($totals[$entrance->entrance_number] - ($entrance->delivery_quantity)), 4),
                        'Tipo' => 'Descarga Paquete',
                        'OT' => $decrease->decrease->departure->order_number,
                        'Producto' => $decrease->decrease->departure->recipe->name,
                        'Lote' => $decrease->decrease->departure->lot,
                    );

                    $totals[$entrance->entrance_number] -= ($entrance->delivery_quantity);
                    $items[] = $newdata;
                }
            }
        }

        $packages = PackageSupply::where("deliver_date", "!=", NULL)->whereIn("supply_id", $ids)->get();

        foreach ($packages as $package) {
            if ($package->entrances != NULL) {
                foreach ($package->entrances as $entrance) {
                    if (!array_key_exists($entrance->entrance_number, $totals)) {
                        $totals[$entrance->entrance_number] = $entrance->entrance->quantity;
                    }

                    $newdata =  array(
                        'Fecha' => date("d/m/Y H:i", strtotime($package->delivery_date)),
                        'Codigo de MP/MAT' => $package->supply->code,
                        'Nombre' => $package->supply->name,
                        'No. Entrada' => "#" . sprintf("%05s", $entrance->entrance_number),
                        'entrance' => $entrance->entrance_number,
                        'Cantidad Entrada (pza)' => $entrance->entrance->quantity,
                        'Cantidad Surtida (pza)' => number_format(($entrance->delivery_quantity), 4),
                        'Cantidad Remanente (pza)' => number_format(($totals[$entrance->entrance_number] - ($entrance->delivery_quantity)), 4),
                        'Tipo' => 'Acondicionamiento',
                        'OT' => $package->package->id,
                        'Producto' => $package->package->product->name,
                        'Lote' => $package->package->lot,
                    );

                    $totals[$entrance->entrance_number] -= ($entrance->delivery_quantity);
                    $items[] = $newdata;
                }
            }
        }

        usort($items, function ($a, $b) {
            return $a["entrance"] - $b["entrance"];
        });

        $csvExporter->build($this->r_collect($items), ['Fecha', 'Codigo de MP/MAT', 'Nombre', 'No. Entrada', 'Cantidad Entrada (pza)', 'Cantidad Surtida (pza)', 'Cantidad Remanente (pza)', 'Tipo', 'OT', 'Producto', 'Lote'])->download('inventario_de_materias_primas_materiales_' . date('d_m_Y') . '.csv');
    }

    private function r_collect($array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = $this->r_collect($value);
                $array[$key] = $value;
            }
        }

        return collect($array);
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
