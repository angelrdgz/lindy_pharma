<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Decrease;
use App\Supply;

use Auth;

class DecreaseController extends Controller
{
    public function index()
    {
        $decreases = Decrease::all();
        return view('decreases.index', ["decreases"=>$decreases]);
    }

    public function create()
    {
        $supplies = Supply::all();
        return view('decreases.create', ["supplies"=>$supplies]);
    }

    public function store(Request $request)
    {
        $decrease = new Decrease();
        $decrease->supply_id = $request->supply;
        $decrease->entrance_item_id = $request->entrance;
        $decrease->quantity = $request->quantity;
        $decrease->description = $request->description;
        $decrease->created_by = Auth::user()->id;
        $decrease->save();

        return redirect('descargas')->with('success', 'Descarga creada correctamente');
    }

    public function edit($id)
    {
        $supplies = Supply::all();
        $decrease = Decrease::find($id);
        return view('decreases.edit', ["supplies"=>$supplies, "decrease"=>$decrease]);
    }

    public function update(Request $request, $id)
    {
        $decrease = Decrease::find($id);
        $decrease->supply_id = $request->supply;
        $decrease->entrance_item_id = $request->entrance;
        $decrease->quantity = $request->quantity;
        $decrease->description = $request->description;
        $decrease->save();

        return redirect('descargas')->with('success', 'Descarga modificada correctamente');
    }
}
