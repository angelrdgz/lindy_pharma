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
                <form method="post" action="{{ url('ordenes-de-fabricacion/'.$departure->id.'/items') }}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Receta</label>
                            <input type="text" class="form-control" readonly value="{{ $departure->recipe->code.' - '.$departure->recipe->name}}">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cantidad</label>
                            <input type="text" name="quantity" readonly value="{{ $departure->quantity }}" class="form-control number">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cantidad Real</label>
                            <input type="text" name="quantity_real" value="{{ $departure->quantity_real }}" class="form-control number">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Fecha de Expiración</label>
                            <input type="date" name="expired_date" value="{{ $departure->expired_date }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cliente</label>
                            <input type="text"  readonly value="{{ $departure->client->name }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Lote</label>
                            <input type="text" name="lot" readonly value="{{ $departure->lot }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Linea</label>
                            <input type="text" name="line" readonly value="{{ $departure->line }}" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Insumo</th>
                                        <th>Cantidad</th>
                                        <th>Número de Entrada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departure->items as $item)
                                     <tr>
                                         <td>{{ $item->supply->name }}</td>
                                         <td>{{ $item->quantity}} {{ $item->supply->measurementUse->code }}</td>
                                         <td>
                                             <input type="hidden" name="id[]" value="{{$item->id}}">
                                             <select name="orderNumber[]" id="" class="form-control">
                                                 <option value="">Seleccionar Número de Entrada</option>
                                                 @foreach($item->supply->entranceNumbers($item->supply->id) as $order)
                                                  <option value="{{ $order->id}}" {{ $order->id == $item->order_number ? "selected":""}}>{{sprintf("%05s", $order->id)}}</option>
                                                 @endforeach
                                             </select>
                                         </td>
                                     </tr>
                                    @endforeach
                                </tbody>
                            </table>
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