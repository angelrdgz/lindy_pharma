@extends('layouts.admin2')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12 pt-2">
                        <h5 class="m-0 font-weight-bold text-primary">Modificar Orden de Fabricación</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('ordenes-de-fabricacion.update', $departure->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Producto</label>
                            <select name="product" id="" class="form-control">
                                <option value="">Seleccionar Producto</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $product->id == $departure->product_id ? "selected":""}} >{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="">Tamaño del lote</label>
                            <input type="text" name="quantity" value="{{ $departure->quantity }}" class="form-control number">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cliente</label>
                            <select name="client" id="" class="form-control">
                                <option value="">Seleccionar cliente</option>
                                @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ $client->id == $departure->client_id ? "selected":""}}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="">Lote</label>
                            <input type="text" name="lot" value="{{ $departure->lot }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Linea</label>
                            <input type="text" name="line" value="{{ $departure->line }}" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3 offset-sm-3">
                            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                        </div>
                        <div class="col-sm-3 ">
                            <a href="{{ url('ordenes-de-fabricacion') }}" class="btn btn-secondary btn-block">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@stop