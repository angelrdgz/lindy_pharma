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
                <form method="post" target="_blank" action="{{ url('ordenes-de-fabricacion/'.$departure->id.'/items') }}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Insumo</th>
                                        <th>Cantidad</th>
                                        <th>Cantidad Surtida</th>
                                        <th>Número de Entrada</th>
                                        <!--<th>Fecha</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departure->items as $item)
                                    <tr>
                                        <td>{{ $item->supply->code.' '.$item->supply->name }}</td>
                                        <td>{{ number_format(((($item->quantity + ($item->quantity * ($item->excess / 100))) * $departure->quantity) / 1000),2)}} gr</td>
                                        <td><input type="text" class="form-control number" name="deliverQuantity[]" value="{{ $item->deliver_quantity !== NULL ? $item->deliver_quantity:((($item->quantity + ($item->quantity * ($item->excess / 100))) * $departure->quantity) / 1000)}}"></td>
                                        <td>
                                            <input type="hidden" name="id[]" value="{{$item->id}}">
                                            <input type="hidden" name="supplyId[]" value="{{$item->supplie_id}}">
                                            <input type="hidden" name="processed[]" value="{{$item->processed}}">
                                            <input type="hidden" name="orderNumber[]" value="{{$item->order_number}}">
                                            <select id="" class="form-control selectPicker" multiple>
                                                <?php $exploded = explode(",", $item->order_number); ?>
                                                @foreach($item->supply->entranceNumbers($item->supply->id) as $order)
                                                <option value="{{ $order->id}}" {{ in_array($order->id, $exploded) ? "selected":""}}>{{sprintf("%05s", $order->id)}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <!--<td><input type="date" class="form-control" name="deliverDate[]" value="{{ $item->deliver_date}}"></td>-->
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

@section("script")
<script>
    $(function() {
        $('.selectPicker').selectpicker({
            noneSelectedText: "Seleccionar Entrada"
        });

        $('.selectPicker').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {

            var ids = [];

            $.each( e.target.selectedOptions , function( index, obj ){
                ids.push(obj.value)
            });

            $(this).closest('tr').find("input[name='orderNumber[]']").val(ids.join(','))
        });


    });

    $('form').submit(function() {
        setTimeout(function() {
            window.history.back();
        }, 3000)
    })
</script>
@endsection