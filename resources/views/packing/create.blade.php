@extends('layouts.admin2')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12 pt-2">
                        <h5 class="m-0 font-weight-bold text-primary">Nueva Orden de Acondicionamiento</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ url('ordenes-de-acondicionamiento') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Producto</label>
                            <select name="product" id="" value="{{ old('product' )}}" class="form-control">
                                <option value="">Seleccionar Producto</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->code.' - '.$product->name }}</option>
                                @endforeach
                            </select>
                            @error('product')
                            <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cantidad</label>
                            <input type="text" name="quantity" value="{{ old('quantity' )}}" class="form-control number">
                            @error('quantity')
                            <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cliente</label>
                            <select name="client" id="" value="{{ old('client') }}" class="form-control">
                                <option value="">Seleccionar cliente</option>
                                @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                            @error('client')
                            <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="">Lote</label>
                            <input type="text" name="lot" value="{{ old('lot') }}" class="form-control">
                            @error('lot')
                            <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="">Presentación</label>
                            <input type="text" name="presentation" value="{{ old('presentation') }}" class="form-control">
                            @error('presentation')
                            <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="">Fecha de Expiración</label>
                            <input type="date" name="expire" value="{{ old('expire') }}" class="form-control">
                            @error('expire')
                            <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="">Forma Farmacéutica</label>
                            <input type="text" name="form" value="{{ old('form') }}" class="form-control">
                            @error('form')
                            <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="">Precio Máximo</label>
                            <input type="text" name="price" value="{{ old('price') }}" class="form-control number">
                            @error('price')
                            <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                            @enderror
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