<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Supply;
use App\SupplyType;
use App\SupplyMeasurement;
use App\Supplier;
use App\Logbook;

use Auth;

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
        $supply->stock = $request->stock;
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

        return redirect('insumos')->with('success', 'Insumo modificado correctamente');
    }

    public function export()
    {
        $csvExporter = new \Laracsv\Export();
        $supplies = Supply::orderBy('code', 'ASC')->get();

        // Register the hook before building
        $csvExporter->beforeEach(function ($supply) {
            $supply->type_id = $supply->type->name;
            $supply->supplier_id = $supply->supplier->name;
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

        $csvExporter->build($supplies, ['code' => 'Código', 'name' => 'Nombre', 'type_id' => 'Tipo', 'stock' => 'En Almacen', 'price' => 'Valor En Stock', 'supplier_id'=>'Proveedor'])->download('insumos_' . date('d_m_Y') . '.csv');
    }
}
