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
              <label for="">Receta</label>
              <select name="recipe" id="" class="form-control @error('recipe_id') is-invalid @enderror">
                <option value="">Seleccionar Receta</option>
                @foreach($recipes as $recipe)
                <option value="{{ $recipe->id }}">{{ $recipe->code.' - '.$recipe->name }}</option>
                @endforeach
              </select>
              @error('recipe_id')
                <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-sm-4">
              <label for="">Tamaño del lote</label>
              <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror number">
              @error('quantity')
                <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-sm-4">
              <label for="">Cliente</label>
              <select name="client" id="" class="form-control @error('client_id') is-invalid @enderror">
                <option value="">Seleccionar cliente</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
              </select>
              @error('client_id')
                <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-sm-4">
              <label for="">Lote</label>
              <input type="text" name="lot" class="form-control @error('lot') is-invalid @enderror">
              @error('lot')
                <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-sm-4">
              <label for="">Linea</label>
              <input type="text" name="line" class="form-control @error('line') is-invalid @enderror">
              @error('line')
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