@extends('layouts.admin2')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12 pt-2">
                        <h5 class="m-0 font-weight-bold text-primary">Nuevo Pedido</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('pedidos.update', $order->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Cliente</label>
                            <input type="hidden" name="client_id" value="{{ $order->client_id}}">
                            <input type="text" name="" readonly value="{{ $order->client->name}}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">No de Order de Compra Cliente</label>
                            <input type="text" name="order_number" readonly value="{{ $order->order_number }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Nota Número</label>
                            <input type="text" name="note" readonly value="{{ $order->order_number }}" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table contentTable">
                                <thead>
                                    <tr>
                                        <th colspan="3">Contenido del Pedido</th>
                                    </tr>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre Producto</th>
                                        <th>Cantidad Solicitada</th>
                                        <th>Lote</th>
                                        <th>Cantidad Entregada</th>
                                        <th>Pzas por Cajas</th>
                                        <th>Cajas Completas</th>
                                        <th>Parcial (pza)</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="idItem[]" value="{{ $item->id }}">
                                            <input type="hidden" name="idProductItem[]" value="{{ $item->product_id }}">
                                            <input type="text" readonly name="codeItem[]" value="{{ $item->product->code}}" class="form-control" /></td>
                                        <td>
                                            <input type="text" readonly class="form-control itemContent{{$item->id}}" value="{{ $item->product->name }}" />
                                        </td>
                                        <td>
                                            <input type="text" readonly name="quantityItem[]" value="{{ $item->quantity}}" class="form-control" />
                                        </td>
                                        <td>
                                            <input type="text" name="lotItem[]" class="form-control" value="{{ $item->lot }}"/>
                                        </td>
                                        <td>
                                            <input type="text" name="realQuantityItem[]" value="{{ $item->quantity_real == NULL ? $item->quantity:$item->quantity_real}}" class="form-control" />
                                        </td>
                                        <td>
                                            <input type="text" name="piecesItem[]" value="{{ $item->pieces }}" class="form-control" />
                                        </td>
                                        <td>
                                            <input type="text" name="boxesItem[]" value="{{ $item->boxes }}" class="form-control" />
                                        </td>
                                        <td>
                                            <input type="text" name="partialItem[]" value="{{ $item->partial }}" class="form-control" />
                                        </td>
                                        <td>
                                            <input type="text" name="totalItem[]" value="{{ $item->total }}" class="form-control" />
                                        </td>
                                        <td class="text-center">
                                            @if(Auth::user()->role_id == 1)
                                            <a class="btn btn-danger btn-circle removeRow">
                                                <i class="fas fa-trash" style="color: #fff;"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Entrega</label>
                            <input type="text" name="delivery" class="form-control" value="{{ $order->delivery }}">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Recibe</label>
                            <input type="text" name="receiver" class="form-control" value="{{ $order->receiver }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table commentsTable">
                                <thead>
                                    <tr>
                                        <th style="width: 100%;">Condiciones y Datos de Transporte</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <table>
                        <tbody>
                            <tr>
                                <td class="p-2"><b>Tipo Caja</b></td>
                                <td class="p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="box_type" type="radio" value="0" {{ $order->box_type == NULL || $order->box_type == 0 ? "checked":""}}>
                                        <label class="form-check-label" for="inlineradio1">Caja Seca</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="box_type" type="radio" value="1" {{ $order->box_type == 1 ? "checked":""}}>
                                        <label class="form-check-label" for="inlineradio2">Caja Fria</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2"><b>Caja Limpia</b></td>
                                <td class="p-2">
                                    <p>(Libre de polvo, alimentos, aceite, agua, olores)</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="clean_box" type="radio" value="0" {{ $order->clean_box == NULL || $order->clean_box == 0 ? "checked":""}}>
                                        <label class="form-check-label" for="inlineradio1">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="clean_box" type="radio" value="1" {{ $order->clean_box == 1 ? "checked":""}}>
                                        <label class="form-check-label" for="inlineradio2">No</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2"><b>Observaciones</b></td>
                                <td class="p-2">
                                    <input type="text" name="observations" class="form-control" value="{{ $order->observations }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2"><b>Certificado de fumigación</b></td>
                                <td class="p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="fumigation" type="radio" value="0" {{ $order->fumigation == NULL || $order->fumigation == 0 ? "checked":""}}>
                                        <label class="form-check-label" for="inlineradio1">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="fumigation" type="radio" value="1" {{ $order->fumigation == 1 ? "checked":""}}>
                                        <label class="form-check-label" for="inlineradio2">No</label>
                                    </div>
                                </td>
                                <td>
                                    <label for="">Vigencia</label>
                                    <input type="date" name="fumigation_date" class="form-control" value="{{ $order->fumigation_date}}">
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2"><b>Transporte Propio</b></td>
                                <td class="p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="own_delivery" type="radio" value="0" {{ $order->own_delivery == NULL || $order->own_delivery == 0 ? "checked":""}}>
                                        <label class="form-check-label" for="inlineradio1">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="own_delivery" type="radio" value="1" {{ $order->own_delivery == 1 ? "checked":""}}>
                                        <label class="form-check-label" for="inlineradio2">No</label>
                                    </div>
                                </td>
                                <td class="p-2">
                                    <label for="">Nombre de Empresa</label>
                                    <input type="text" name="company" class="form-control" value="{{ $order->company }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2"><b>Placas</b></td>
                                <td class="p-2">
                                    <input type="text" name="plates" class="form-control" value="{{ $order->plates}}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="row">
                        <div class="col-sm-3 offset-sm-3">
                            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                        </div>
                        <div class="col-sm-3 ">
                            <a href="{{ url('ordenes-de-compra') }}" class="btn btn-secondary btn-block">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@stop

@section('script')

<script>


</script>
@stop