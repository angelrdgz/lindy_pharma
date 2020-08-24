<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Supply;
use App\SupplyType;
use App\SupplyMeasurement;
use App\Supplier;
use App\EntranceItem;
use App\Logbook;

use Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class SupplyController extends Controller
{
    public function index()
    {
        $supplies = Supply::all();
        return view('supplies.index', ['supplies' => $supplies]);
    }

    public function create()
    {
        $types = SupplyType::all();
        $suppliers = Supplier::all();
        $measurements = SupplyMeasurement::all();
        return view('supplies.create', [
            'types' => $types,
            'measurements' => $measurements,
            'suppliers' => $suppliers,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'code' => 'required|unique:supplies',
                'type' => 'required',
                'measurement_use' => 'required',
                'measurement_buy' => 'required',
            ],
            [
                'name.required' => 'El nombre es requerido',
                'code.required' => 'El código es requerido',
                'code.unique' => 'El código ya existe',
                'type.required' => 'El tipo es requerido',
                'measurement_use.required' => 'La medida de uso es requerida',
                'measurement_buy.required' => 'La medida de compra es requerida',
            ]
        );

        $supply = new Supply;
        $supply->name = $request->name;
        $supply->code = $request->code;
        $supply->type_id = $request->type;
        $supply->price = $request->price;
        $supply->supplier_id = $request->supplier;
        $supply->measurement_use = $request->measurement_use;
        $supply->measurement_buy = $request->measurement_buy;
        $supply->save();

        $logbook = new Logbook();
        $logbook->type_id = 1;
        $logbook->title = 'Insumo Creado';
        $logbook->content = 'El insumo con el código "' . $request->code . '" ha sido creado';
        $logbook->icon = 'fas fa-capsules';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('insumos')->with('success', 'Insumo guardado correctamente');
    }

    public function show($id)
    {
        $supply = Supply::find($id);
        return response()->json($supply->entranceNumbers($supply->id));
    }

    public function edit($id)
    {
        $supply = Supply::find($id);
        $types = SupplyType::all();
        $suppliers = Supplier::all();
        $measurements = SupplyMeasurement::all();
        return view('supplies.edit', [
            'supply' => $supply,
            'types' => $types,
            'measurements' => $measurements,
            'suppliers' => $suppliers,
        ]);
    }

    public function update(Request $request, $id)
    {
        if (in_array(Auth::user()->role_id, [3, 4])) {

            foreach ($request->idItems as $key => $supplie) {
                $item =  EntranceItem::find($request->idItems[$key]);
                $item->cups = $request->cupsItems[$key];
                $item->lot_supplier = $request->lotSupplierItems[$key];
                $item->expired_date = $request->expiredDateItems[$key];
                $item->reanalized_date = $request->reanalizedDateItems[$key];
                $item->save();
            }
        } else {
            $request->validate(
                [
                    'name' => 'required',
                    'code' => 'required',
                    'type' => 'required',
                    'measurement_use' => 'required',
                    'measurement_buy' => 'required',
                ],
                [
                    'name.required' => 'El nombre es requerido',
                    'code.required' => 'El código es requerido',
                    'type.required' => 'El tipo es requerido',
                    'measurement_use.required' => 'La medida de uso es requerida',
                    'measurement_buy.required' => 'La medida de compra es requerida',
                ]
            );

            $supply = Supply::find($id);
            $supply->name = $request->name;
            $supply->code = $request->code;
            $supply->type_id = $request->type;
            $supply->stock = $request->stock * 1000000;
            $supply->price = $request->price;
            $supply->supplier_id = $request->supplier;
            $supply->measurement_use = $request->measurement_use;
            $supply->measurement_buy = $request->measurement_buy;
            $supply->save();

            $logbook = new Logbook();
            $logbook->type_id = 2;
            $logbook->title = 'Insumo Modificado';
            $logbook->content = 'El insumo con el código "' . $request->code . '" ha sido modificado';
            $logbook->icon = 'fas fa-capsules';
            $logbook->created_by = Auth::user()->id;
            $logbook->save();
        }

        return redirect('insumos')->with('success', 'Insumo modificado correctamente');
    }

    public function export()
    {
        $csvExporter = new \Laracsv\Export();
        if (request()->type == 1) {

            $items = EntranceItem::select("entrance_items.*")->join('supplies', 'entrance_items.supply_id', '=', 'supplies.id')->orderBy('entrance_items.supply_id', 'ASC')->where("supplies.measurement_buy", 2)->where('entrance_items.status', '!=', 'Rechazada')->get();

            $csvExporter->beforeEach(function ($supply) {
                $supply->created_at = $supply->entrance->created_at;
                $supply->supply_id = $supply->supply->code;
                $supply->name = $supply->supply->name;
                $supply->supplier = $supply->entrance->supplier->name;
                $supply->entrance_id = '#' . strval(sprintf("%05s", $supply->entrance_id));
                $supply->idx = '#' . strval(sprintf("%05s", $supply->id));
            });

            $csvExporter->build($items, ["created_at" => "Fecha", 'supply_id' => "Codigo Producto", "name" => "Nombre Producto", "entrance_id" => "No Orden de Compra", "lot_supplier" => "Lote de Proveedor", "idx" => "Numero de Entrada", "quantity" => "Cantidad Inicial Kg", "available_quantity" => "Cantidad Disponible Kg", "cups" => "No de Envases", "expired_date" => "Fecha de Caducidad", "reanalized_date" => "Fecha de Reanalisis", "supplier" => "Proveedor"] /**/)->download('inventario_de_materias_primas_' . date('d_m_Y') . '.csv');
        } else {

            $items = EntranceItem::select("entrance_items.*")->join('supplies', 'entrance_items.supply_id', '=', 'supplies.id')->orderBy('entrance_items.supply_id', 'ASC')->where("supplies.measurement_buy", "!=", 2)->where('entrance_items.status', '!=', 'Rechazada')->get();

            $csvExporter->beforeEach(function ($supply) {
                $supply->created_at = $supply->entrance->created_at;
                $supply->supply_id = $supply->supply->code;
                $supply->name = $supply->supply->name;
                $supply->supplier = $supply->entrance->supplier->name;
                $supply->entrance_id = '#' . strval(sprintf("%05s", $supply->entrance_id));
                $supply->idx = '#' . strval(sprintf("%05s", $supply->id));
            });

            $csvExporter->build($items, ["created_at" => "Fecha", 'supply_id' => "Codigo Producto", "name" => "Nombre Producto", "entrance_id" => "No Orden de Compra", "lot_supplier" => "Lote de Proveedor", "idx" => "Numero de Entrada", "quantity" => "Cantidad Inicial Pza", "available_quantity" => "Cantidad Disponible pza", "cups" => "No de Envases", "expired_date" => "Fecha de Caducidad", "reanalized_date" => "Fecha de Reanalisis", "supplier" => "Proveedor"] /**/)->download('inventario_de_materiales_' . date('d_m_Y') . '.csv');
        }


        // Register the hook before building
        /*$csvExporter->beforeEach(function ($supply) {
            $supply->type_id = $supply->type->name;
            $supply->supplier_id = $supply->supplier->name;
            $supply->stock = $supply->stock / 1000000;
            switch ($supply->measurement_use) {
                case 5:
                    $supply->price = $supply->price * $supply->stock;
                    break;
                case 6:
                    $supply->price = $supply->price * ($supply->stock / 1000);
                    break;

                default:
                    $supply->price = $supply->price * ($supply->stock / 1000);
                    break;
            }
        });

        $csvExporter->build($items, ['code' => 'Código', 'name' => 'Nombre', 'type_id' => 'Tipo', 'stock' => 'En Almacen (Kg)', 'price' => 'Valor En Stock', 'supplier_id' => 'Proveedor'])->download('insumos_' . date('d_m_Y') . '.csv');*/
    }

    public function exportStock()
    {

        if (request()->type == 1)
            $items = Supply::where("type_id", 1)->get();
        else
            $items = Supply::where("type_id", "!=", 1)->get();
        $csvExporter = new \Laracsv\Export();

        $csvExporter->beforeEach(function ($supply) {
            $supply->type_id = $supply->type->name;
            $supply->supplier_id = $supply->supplier->name;
            switch ($supply->measurement_use) {
                case 6:
                    $supply->stock = $supply->stock / 1000000;
                    $supply->price = $supply->price * $supply->stock;
                    break;
                case 3:
                    $supply->stock = $supply->stock / 1000000;
                    $supply->price = $supply->price * $supply->stock;
                    break;
                case 1:
                    $supply->stock = $supply->stock / 1000;
                    $supply->price = $supply->price * $supply->stock;
                    break;
                default:
                    $supply->stock = $supply->stock;
                    $supply->price = $supply->price * $supply->stock;
                    break;
            }
        });

        if (request()->type == 1) {
            if (Auth::user()->role_id == 1)
                $csvExporter->build($items, ['code' => 'Código', 'name' => 'Nombre', 'type_id' => 'Tipo', 'stock' => 'Cantidad (Kg)', 'price' => 'Valor En Stock', 'supplier_id' => 'Proveedor'])->download('stock_materias_primas_' . date('d_m_Y') . '.csv');
            else
                $csvExporter->build($items, ['code' => 'Código', 'name' => 'Nombre', 'type_id' => 'Tipo', 'stock' => 'Cantidad (Kg)', 'supplier_id' => 'Proveedor'])->download('stock_materias_primas_' . date('d_m_Y') . '.csv');
        } else {
            if (Auth::user()->role_id == 1)
                $csvExporter->build($items, ['code' => 'Código', 'name' => 'Nombre', 'type_id' => 'Tipo', 'stock' => 'Cantidad (pza)', 'price' => 'Valor En Stock', 'supplier_id' => 'Proveedor'])->download('stock_materiales_' . date('d_m_Y') . '.csv');
            else
                $csvExporter->build($items, ['code' => 'Código', 'name' => 'Nombre', 'type_id' => 'Tipo', 'stock' => 'Cantidad (pza)', 'supplier_id' => 'Proveedor'])->download('stock_materiales_' . date('d_m_Y') . '.csv');
        }
    }

    public function exportSupply($id)
    {
        //$csvExporter = new \Laracsv\Export();
        //$sup = Supply::find($id);
        $supply = EntranceItem::find($id);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('a4', 'landscape')->loadView('pdfs.entrance_report', ["supply" => $supply]);
        return $pdf->stream('reporte_de_arribo_' . $id . '.pdf');

        // Register the hook before building
        /*$supply->created_at = $supply->entrance->created_at;
        $supply->supply_id = $supply->supply->code;
        $supply->name = $supply->supply->name;
        $supply->supplier = $supply->entrance->supplier->name;
        $supply->entrance_id = '#' . strval(sprintf("%05s", $supply->id));

        $csvExporter->build($supply, ["created_at" => "Fecha", 'supply_id' => "Código Producto", "name" => "Nombre Producto", "entrance_id" => "Número de Entrada", "quantity" => "Cantidad Kg", "cups" => "No de Envases", "expired_date" => "Fecha de Caducidad", "reanalized_date" => "Fecha de Reanalisis", "supplier" => "Proveedor"] )->download('insumo_' . $sup->code . '_' . str_replace(array("/", "-"), "_", $sup->name) . '_' . date('d_m_Y') . '.csv');*/
    }

    public function exportQuarantine()
    {
        if (request()->type == 1)
            $items = EntranceItem::select("entrance_items.*")->join('supplies', 'entrance_items.supply_id', '=', 'supplies.id')->orderBy('entrance_items.supply_id', 'ASC')->where("supplies.type_id", 1)->where('entrance_items.status', 'Cuarentena')->get();
        //Supply::where("type_id", 1)->get();
        else
            $items = EntranceItem::select("entrance_items.*")->join('supplies', 'entrance_items.supply_id', '=', 'supplies.id')->orderBy('entrance_items.supply_id', 'ASC')->where("supplies.type_id", '!=', 1)->where('entrance_items.status', 'Cuarentena')->get();
        $csvExporter = new \Laracsv\Export();


        $csvExporter->beforeEach(function ($supply) {
            $supply->type_id = $supply->supply->type->name;
            $supply->code = $supply->supply->code;
            $supply->name = $supply->supply->name;
            $supply->entrance = "#" . sprintf("%05s", $supply->id);
            $supply->supplier_id = $supply->supplier_id;
            $supply->quantity = $supply->quantity;
        });

        if (request()->type == 1)
            $csvExporter->build($items, ['entrance' => 'Número de Entrada', 'code' => 'Código', 'name' => 'Nombre', 'type_id' => 'Tipo', 'quantity' => 'Cantidad (Kg)', 'price' => 'Precio'])->download('cuarentena_materias_primas_' . date('d_m_Y') . '.csv');
        else
            $csvExporter->build($items, ['entrance' => 'Número de Entrada', 'code' => 'Código', 'name' => 'Nombre', 'type_id' => 'Tipo', 'quantity' => 'Cantidad (pza)', 'price' => 'Precio'])->download('cuarentena_materiales_' . date('d_m_Y') . '.csv');
    }
}
