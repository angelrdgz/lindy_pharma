@extends('layouts.admin2')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-10 pt-2">
            <h5 class="m-0 font-weight-bold text-primary">Modificar Insumo</h5>
          </div>
          <div class="col-sm-2">
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
                <input type="text" name="code" {{ Auth::user()->role_id == 3 ? 'readonly':'' }} class="form-control @error('code') is-invalid @enderror" value="{{ $supply->code }}">
                @error('code')
                <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-sm-5">
              <div class="form-group">
                <label for="exampleFormControlInput1">Nombre</label>
                <input type="text" name="name" {{ Auth::user()->role_id == 3 ? 'readonly':'' }} class="form-control @error('name') is-invalid @enderror" value="{{ $supply->name }}">
                @error('name')
                <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="exampleFormControlInput1">Tipo</label>
                <select name="type" {{ Auth::user()->role_id == 3 ? 'readonly':'' }} id="" class="form-control @error('type') is-invalid @enderror">
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
                <select name="measurement_use" {{ Auth::user()->role_id == 3 ? 'readonly':'' }} id="" class="form-control @error('measurement_use') is-invalid @enderror">
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
                <select name="measurement_buy" id="" {{ Auth::user()->role_id == 3 ? 'readonly':'' }} class="form-control @error('measurement_buy') is-invalid @enderror">
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
                <?php
                $quanty = 0;
                switch ($supply->measurement_use) {
                  case 6:
                    $quanty = $supply->stock / 1000000;
                    break;
                  case 3:
                    $quanty = $supply->stock / 1000000;
                    break;
                    case 1:
                      $quanty = $supply->stock / 1000;
                      break;
                  default:
                    $quanty = $supply->stock;
                    break;
                }
                ?>
                <input type="text" class="form-control number" {{ Auth::user()->role_id == 3 ? 'readonly':'' }} value="{{ $quanty  }}" name="stock">
              </div>
            </div>
            @if(Auth::user()->role_id == 3)
            <input type="hidden" class="form-control number" value="{{ $supply->price }}" name="price">
            @else
            <div class="col-sm-4">
              <div class="form-group">
                <label for="exampleFormControlInput1">Precio Por Kg/Pza</label>
                <input type="text" class="form-control number" value="{{ $supply->price }}" name="price">
              </div>
            </div>
            @endif
            <input type="hidden" name="supplier" value="{{$supply->supplier_id}}">
            <!--<div class="col-sm-4">
              <div class="form-group">
                <label for="exampleFormControlInput1">Proveedor</label>
                <select name="supplier" id="" class="form-control" {{ Auth::user()->role_id == 3 ? 'readonly':'' }}>
                  @foreach($suppliers as $supplier)
                  <option value="{{ $supplier->id }}" {{$supply->supplier_id == $supplier->id ? 'selected':''}}>{{ $supplier->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>-->
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-12">
              <h3 class="text-center">Números de Entrada</h3>
              <table class="table">
                <thead>
                  <tr>
                    <th>Número de entrada</th>
                    <th>Cantidad</th>
                    <th>Proveedor</th>
                    <th>No Lote Proveedor</th>
                    <th>No de Envases</th>
                    <th>Fecha de Caducidad</th>
                    <th>Fecha de Reanalisis</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($supply->entrances as $order)
                  <tr>
                    <input type="hidden" name="idItems[]" value="{{ $order->id }}" class="form-control number">
                    <td>{{ $order->id }}</td>
                    <td>{{ number_format($order->quantity,4) }}</td>
                    <td>{{ $order->entrance->supplier->name }}</td>
                    <td>
                      <input type="text" name="lotSupplierItems[]" {{$order->status == 'Rechazada' ? "readonly":'' }} value="{{ $order->lot_supplier }}" class="form-control">
                    </td>
                    <td>
                      <input type="text" name="cupsItems[]" {{$order->status == 'Rechazada' ? "readonly":'' }} value="{{ $order->cups }}" class="form-control number">
                    </td>
                    <td>
                      <input type="date" name="expiredDateItems[]" {{$order->status == 'Rechazada' ? "readonly":'' }} value="{{ $order->expired_date }}" class="form-control">
                    </td>
                    <td>
                      <input type="date" name="reanalizedDateItems[]" {{$order->status == 'Rechazada' ? "readonly":'' }} value="{{ $order->reanalized_date }}" class="form-control">
                    </td>
                    <td>
                      @if(in_array(Auth::user()->role_id, [1,3]) && $order->status !== 'Rechazada')
                      <a href="{{ url('exportar/insumos/'.$order->id) }}" target="_blank" class="btn btn-block btn-primary">
                        Reporte de Arribo
                      </a>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
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