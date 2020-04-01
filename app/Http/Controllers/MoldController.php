<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mold;
use App\Logbook;

use Auth;

class MoldController extends Controller
{
    public function index()
    {
        $molds = Mold::all();
        return view('molds.index', ["molds"=>$molds]);

    }

    public function create()
    {
        return view('molds.create');
    }

    public function store(Request $request)
    {
        $mold = new Mold();
        $mold->code = $request->code;
        $mold->type = $request->type;
        $mold->long_mm = $request->long_mm;
        $mold->width_mm = $request->width_mm;
        $mold->minimals = $request->minimals;
        $mold->caps_long = $request->caps_long;
        $mold->caps_circ = $request->caps_circ;
        $mold->kilograms = $request->kilograms;
        $mold->reference_product = $request->reference_product;
        $mold->observations = $request->observations;
        $mold->save();

        $logbook = new Logbook();
        $logbook->type_id = 1;
        $logbook->title = 'Molde Creado';
        $logbook->content = 'El molde con el código "'.$request->code.'" ha sido modificada';
        $logbook->icon = 'fas fa-dice-d20';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('moldes')->with('success', 'Molde creado correctamente');

    }

    public function edit($id)
    {
        $mold = Mold::find($id);
        return view('molds.edit', ["mold"=>$mold]);
    }

    public function update(Request $request, $id)
    {

        $mold = Mold::find($id);
        $mold->code = $request->code;
        $mold->type = $request->type;
        $mold->long_mm = $request->long_mm;
        $mold->width_mm = $request->width_mm;
        $mold->minimals = $request->minimals;
        $mold->caps_long = $request->caps_long;
        $mold->caps_circ = $request->caps_circ;
        $mold->kilograms = $request->kilograms;
        $mold->reference_product = $request->reference_product;
        $mold->observations = $request->observations;
        $mold->save();

        $logbook = new Logbook();
        $logbook->type_id = 2;
        $logbook->title = 'Molde Modificado';
        $logbook->content = 'El molde con el código "'.$request->code.'" ha sido modificado';
        $logbook->icon = 'fas fa-dice-d20';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('moldes')->with('success', 'Molde modificado correctamente');

    }

    public function export()
    {
        $csvExporter = new \Laracsv\Export();
        $molds = Mold::all();

        // Register the hook before building
        $csvExporter->beforeEach(function ($mold) {
            //$client->address = $client->address.', '.$client->neight.'. '.$client->city.', '.$client->state.'. CP:'.$client->zip;
        });

        $csvExporter->build($molds, ['code'=>'Código', 'type'=>'Tipo','minimals'=>'Minimas', 'long_mm'=>'Largo mm','width_mm'=>'Ancho mm','caps_long'=>'Caps Long','caps_circ'=>'Caps Circ','kilograms'=>'Kilogramos','reference_product'=>'Productos de Referencia', 'observations'=>'Observaciones'])->download('moldes_'.date('d_m_Y').'.csv');
    }
}
