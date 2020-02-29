<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Supply;
use App\SupplyType;
use App\SupplyMeasurement;
use App\Logbook;

use Auth;

class SupplyController extends Controller
{
    public function index(){
        $supplies = Supply::all();
        return view('supplies.index', ['supplies' => $supplies]);
    }

    public function create()
    {
        $types = SupplyType::all();
        $measurements = SupplyMeasurement::all();
        return view('supplies.create', [
            'types'=>$types,
            'measurements'=>$measurements,
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
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
        ]);

        $supply = new Supply;
        $supply->name = $request->name;
        $supply->code = $request->code;
        $supply->type_id = $request->type;
        $supply->measurement_use = $request->measurement_use;
        $supply->measurement_buy = $request->measurement_buy;
        $supply->save();

        $logbook = new Logbook();
        $logbook->type_id = 1;
        $logbook->title = 'Insumo Creado';
        $logbook->content = 'El insumo con el código "'.$request->code.'" ha sido creado';
        $logbook->icon = 'fas fa-capsules';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('insumos')->with('success', 'Insumo guardado correctamente');
    }

    public function edit($id)
    {
        $supply = Supply::find($id);
        $types = SupplyType::all();
        $measurements = SupplyMeasurement::all();
        return view('supplies.edit', [
            'supply'=>$supply,
            'types'=>$types,
            'measurements'=>$measurements,
            ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
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
        ]);

        $supply = Supply::find($id);
        $supply->name = $request->name;
        $supply->code = $request->code;
        $supply->type_id = $request->type;
        $supply->measurement_use = $request->measurement_use;
        $supply->measurement_buy = $request->measurement_buy;
        $supply->save();

        $logbook = new Logbook();
        $logbook->type_id = 2;
        $logbook->title = 'Insumo Modificado';
        $logbook->content = 'El insumo con el código "'.$request->code.'" ha sido modificado';
        $logbook->icon = 'fas fa-capsules';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('insumos')->with('success', 'Insumo modificado correctamente');
    }
}
