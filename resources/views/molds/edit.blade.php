@extends('layouts.admin2')

@section('content')

<div class="row">
  <div class="col-sm-12">
  <div class="card shadow mb-4">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-12 pt-2">
                <h5 class="m-0 font-weight-bold text-primary">Modificar Molde</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
            <form method="post" action="{{ route('moldes.update', $mold->id) }}">
             @method('PATCH')
            @csrf
            <div class="row">
            <div class="col-sm-4">
                <label for="">Tipo</label>
                <select name="type" id="" class="form-control">
                    <option value="Oblongos" {{$mold->type == "Oblongos" ? "selected":""}}>Oblongos</option>
                    <option value="Ovales" {{$mold->type == "Ovales" ? "selected":""}}>Ovales</option>
                    <option value="Especiales" {{$mold->type == "Especiales" ? "selected":""}}>Especiales</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label for="">Código</label>
                <input type="text" name="code" value="{{ $mold->code }}" class="form-control">
              </div>
            <div class="col-sm-4">
                <label for="">Minimas</label>
                <input type="text" name="minimals" value="{{ $mold->minimals }}" class="form-control number">
              </div>
              <div class="col-sm-4">
                <label for="">Largo (mm)</label>
                <input type="text" name="long_mm" value="{{ $mold->long_mm }}" class="form-control number">
              </div>
              <div class="col-sm-4">
                <label for="">Ancho (mm)</label>
                <input type="text" name="width_mm" value="{{ $mold->width_mm }}" class="form-control number">
              </div>
              <div class="col-sm-4">
                <label for="">Número de Caps. Largo</label>
                <input type="text" name="caps_long" value="{{ $mold->caps_long }}" class="form-control number">
              </div>
              <div class="col-sm-4">
                <label for="">Número de Caps. Circ.</label>
                <input type="text" name="caps_circ" value="{{ $mold->caps_circ }}" class="form-control number">
              </div>
              <div class="col-sm-4">
                <label for="">Kilogramos / 100,000 Caps.</label>
                <input type="text" name="kilograms" value="{{ $mold->kilograms }}" class="form-control number">
              </div>
              <div class="col-sm-4">
                <label for="">Producto</label>
                <input type="text" name="reference_product" value="{{ $mold->reference_product }}" class="form-control">
              </div>
              <div class="col-sm-4">
                <label for="">Observaciones</label>
                <input type="text" name="observations" value="{{ $mold->observations }}" class="form-control">
              </div>
            </div>
            <br>
  <div class="row">
    <div class="col-sm-3 offset-sm-3">
      <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    </div>
    <div class="col-sm-3 ">
      <a href="{{ url('moldes') }}" class="btn btn-secondary btn-block">Cancelar</a>
    </div>
  </div>
</form>
            </div>
          </div>
  </div>
</div>


                    @stop