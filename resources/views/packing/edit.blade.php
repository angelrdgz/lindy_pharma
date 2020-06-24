@extends('layouts.admin2')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12 pt-2">
                        <h5 class="m-0 font-weight-bold text-primary">Modificar Orden de Acondicionamiento</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('ordenes-de-acondicionamiento.update', $package->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                    @if(in_array(Auth::user()->role_id, [1,2]))    
                    <div class="col-sm-4">
                            <label for="">Producto</label>
                            <select name="product" id="" class="form-control">
                                <option value="">Seleccionar Producto</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}" {{$product->id == $package->product_id ? "selected":""}}>{{ $product->code.' - '.$product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cantidad</label>
                            <input type="text" name="quantity" value="{{ $package->quantity }}" class="form-control number">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cliente</label>
                            <select name="client" id="" class="form-control">
                                <option value="">Seleccionar cliente</option>
                                @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{$client->id == $package->client_id ? "selected":""}}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="">Lote</label>
                            <input type="text" name="lot" value="{{ $package->lot }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Presentación</label>
                            <input type="text" name="presentation" value="{{ $package->presentation }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Fecha de Expiración</label>
                            <input type="date" name="expire" value="{{ $package->date_expire }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Forma Farmacéutica</label>
                            <input type="text" name="form" value="{{ $package->form }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Precio Máximo</label>
                            <input type="text" name="price" value="{{ $package->price }}" class="form-control number">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Status</label>
                            @if($package->status == "Empacado")
                            <input type="hidden" name="status" value="Empacado">
                            <label for="">Empacado</label>
                            @else
                            <select name="status" id="" class="form-control">
                                <option {{ $package->status == NULL ? "selected":""}} value="">Seleccionar Estatus</option>
                                <option {{ $package->status == "Creada" ? "selected":""}} value="Creada">Creada</option>
                                <option {{ $package->status == "Liberado" ? "selected":""}} value="Liberado">Liberado</option>
                            </select>
                            @endif
                        </div>
                        @endif
                        @if(Auth::user()->role_id == 3)
                         <div class="col-sm-12">
                             <table class="table">
                                 <thead>
                                     <tr>
                                         <th>Insumo</th>
                                         <th>Núm. de Entrada</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach($package->product->supplies as $supply)
                                      <tr>
                                          <td>{{ $supply->supply->code.' - '.$supply->supply->name }}</td>
                                          <td>
                                              <input type="hidden" name="supplyId[]" value="{{ $supply->supply_id }}">
                                              <select name="orderNumber[]" id="" class="form-control">
                                              <option value="">Seleccionar Número de Entrada</option>
                                                 @foreach($supply->supply->entranceNumbers($supply->supply->id) as $order)
                                                  <option value="{{ $order->id}}" {{ $order->id == $supply->order_number ? "selected":""}}>{{sprintf("%05s", $order->id)}}</option>
                                                 @endforeach
                                              </select>
                                          </td>
                                      </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                        @endif
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3 offset-sm-3">
                            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                        </div>
                        <div class="col-sm-3 ">
                            <a href="{{ url('ordenes-de-acondicionamiento') }}" class="btn btn-secondary btn-block">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@stop