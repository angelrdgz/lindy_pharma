<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', ["suppliers"=>$suppliers]);
    }

    public function create()
    {
        return view("suppliers.create");        
    }

    public function store(Request $request)
    {

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->contact = $request->contact;
        $supplier->address = $request->address;
        $supplier->neight = $request->neight;
        $supplier->city = $request->city;
        $supplier->state = $request->state;
        $supplier->zip = $request->zip;
        $supplier->rfc = $request->rfc;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->save();

        return redirect('proveedores')->with('success', 'Proveedor creado correctamente');        
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id); 
        return view("suppliers.edit", ["supplier"=>$supplier]);        
    }

    public function update(Request $request, $id)
    {

        $supplier = Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->contact = $request->contact;
        $supplier->address = $request->address;
        $supplier->neight = $request->neight;
        $supplier->city = $request->city;
        $supplier->state = $request->state;
        $supplier->zip = $request->zip;
        $supplier->rfc = $request->rfc;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->save();

        return redirect('proveedores')->with('success', 'Proveedor modificado correctamente');        
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();

        return redirect('proveedores')->with('success', 'Proveedor eliminado correctamente');        
    }
}
