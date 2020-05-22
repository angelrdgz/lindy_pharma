<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;
use App\Logbook;
use Auth;


class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', ["clients"=>$clients]);

    }

    public function create()
    {
        return view('clients.create');

    }

    public function store(Request $request)
    {
        $client = new Client();
        $client->name = $request->name;
        $client->contact = $request->contact;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->neight = $request->neight;
        $client->city = $request->city;
        $client->state = $request->state;
        $client->zip = $request->zip;
        $client->email = $request->email;
        $client->rfc = $request->rfc;
        $client->status = 1;
        $client->save();

        $logbook = new Logbook();
        $logbook->type_id = 1;
        $logbook->title = 'Cliente Creado';
        $logbook->content = 'El cliente "'.$request->name.'" ha sido creado';
        $logbook->icon = 'fas fa-user-tie';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();
        

        return redirect('clientes')->with('success', 'Cliente creado correctamente');

    }

    public function edit($id)
    {
        $client = Client::find($id);
        return view('clients.edit', ["client"=>$client]);
    }

    public function update(Request $request, $id)
    {

        $client = Client::find($id);
        $client->name = $request->name;
        $client->contact = $request->contact;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->neight = $request->neight;
        $client->city = $request->city;
        $client->state = $request->state;
        $client->zip = $request->zip;
        $client->email = $request->email;
        $client->rfc = $request->rfc;
        $client->status = 1;
        $client->save();

        $logbook = new Logbook();
        $logbook->type_id = 2;
        $logbook->title = 'Cliente Modificado';
        $logbook->content = 'El cliente "'.$client->name.'" ha sido modificado';
        $logbook->icon = 'fas fa-user-tie';
        $logbook->created_by = Auth::user()->id;
        $logbook->save();

        return redirect('clientes')->with('success', 'Cliente modificado correctamente');

    }

    public function export()
    {
        $csvExporter = new \Laracsv\Export();
        $clients = Client::all();

        // Register the hook before building
        $csvExporter->beforeEach(function ($client) {
            $client->address = $client->address.', '.$client->neight.'. '.$client->city.', '.$client->state.'. CP:'.$client->zip;
        });

        $csvExporter->build($clients, ['name'=>'Nombre', 'contact'=>'Contacto','phone'=>'Teléfono', 'address'=>'Dirección','email'=>'Correo'])->download('clientes_'.date('d_m_Y').'.csv');
    }
}
