@extends('layouts.admin2')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 pt-2">
            <h5 class="m-0 font-weight-bold text-primary">Modificar Insumo</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('insumos.update', $supply->id) }}">
          @method('PATCH')
          @csrf
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label for="exampleFormControlInput1">Código</label>
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ $supply->code }}">
                @error('code')
                <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-sm-5">
              <div class="form-group">
                <label for="exampleFormControlInput1">Nombre</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $supply->name }}">
                @error('name')
                <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="exampleFormControlInput1">Tipo</label>
                <select name="type" id="" class="form-control @error('type') is-invalid @enderror">
                  <option value="">Seleccione Tipo</option>
                  @foreach($types as $type)
                  <option value="{{ $type->id }}" {{ $supply->type_id == $type->id ? 'selected':''}}>({{ $type->code }}) {{ $type->name}}</option>
                  @endforeach
                </select>
                @error('type')
                <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="exampleFormControlInput1">Medida de Uso</label>
                <select name="measurement_use" id="" class="form-control @error('measurement_use') is-invalid @enderror">
                  <option value="">Seleccione Medida</option>
                  @foreach($measurements as $measurement)
                  <option value="{{ $measurement->id }}" {{ $supply->measurement_use == $measurement->id ? 'selected':''}}>{{ $measurement->name}}</option>
                  @endforeach
                </select>
                @error('measurement_use')
                <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="exampleFormControlInput1">Medida de Compra</label>
                <select name="measurement_buy" id="" class="form-control @error('measurement_buy') is-invalid @enderror">
                  <option value="">Seleccione Medida</option>
                  @foreach($measurements as $measurement)
                  <option value="{{ $measurement->id }}" {{ $supply->measurement_buy == $measurement->id ? 'selected':''}}>{{ $measurement->name}}</option>
                  @endforeach
                </select>
                @error('measurement_buy')
                <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="exampleFormControlInput1">Stock</label>
                <input type="text" class="form-control number" value="{{ $supply->stock }}" name="stock">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="exampleFormControlInput1">Precio Por Kg/Pza</label>
                <input type="text" class="form-control number" value="{{ $supply->price }}" name="price">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="exampleFormControlInput1">Proveedor</label>
                <select name="supplier" id="" class="form-control">
                  @foreach($suppliers as $supplier)
                  <option value="{{ $supplier->id }}" {{$supply->supplier_id == $supplier->id ? 'selected':''}}>{{ $supplier->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
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