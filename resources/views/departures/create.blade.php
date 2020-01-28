@extends('layouts.admin2')

@section('content')

<div class="row">
  <div class="col-sm-12">
  <div class="card shadow mb-4">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-12 pt-2">
                <h5 class="m-0 font-weight-bold text-primary">Nueva Orden de Fabricación</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
            <form method="post" action="{{ url('ordenes-de-fabricacion') }}">
            @csrf
            <div class="row">
            <div class="col-sm-4">
                <label for="">Producto</label>
                <select name="product" id="" class="form-control">
                  <option value="">Seleccionar Producto</option>
                  @foreach($products as $product)
                   <option value="{{ $product->id }}">{{ $product->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-4">
                <label for="">Tamaño del lote</label>
                <input type="text" name="quantity" class="form-control number">
              </div>
              <div class="col-sm-4">
                <label for="">Cliente</label>
                <input type="text" name="client" class="form-control">
              </div>
              <div class="col-sm-4">
                <label for="">Molde</label>
                <input type="text" name="mold" class="form-control">
              </div>
              <div class="col-sm-4">
                <label for="">Linea</label>
                <input type="text" name="line" class="form-control">
              </div>
            </div>
            <br>
  <div class="row">
    <div class="col-sm-3 offset-sm-3">
      <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    </div>
    <div class="col-sm-3 ">
      <a href="{{ url('insumos') }}" class="btn btn-secondary btn-block">Cancelar</a>
    </div>
  </div>
</form>
            </div>
          </div>
  </div>
</div>


                    @stop