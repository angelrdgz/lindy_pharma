@extends('layouts.admin2')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12 pt-2">
                        <h5 class="m-0 font-weight-bold text-primary">Modificar Descarga de Insumo</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('descargas.update', $decrease->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">OT</label>
                            <select name="order_number" id="" class="form-control">
                                <option value="">Seleccionar OT</option>
                                @if($decrease->departure_id == NULL)
                                    @foreach($orderNumbers as $order)
                                    <option value="{{ $order->id }}" type="{{ $order->type }}" recipe_id="{{ $order->recipe_id }}" recipe="{{$order->recipe->name}}" lot="{{$order->lot}}">
                                        @if($order->type == 1)
                                        {{ $order->order_number }} - CONTENIDO DE LA CAPSULA
                                        @elseif($order->type == 2)
                                        {{ $order->order_number }} - ENVOLVENTE DE LA CAPSULA 1
                                        @else
                                        {{ $order->order_number }} - ENVOLVENTE DE LA CAPSULA 2
                                        @endif
                                    </option>
                                    @endforeach
                                @else
                                @foreach($orderNumbers as $order)
                                <option value="{{ $order->id }}" type="{{ $order->type }}" recipe_id="{{ $order->recipe_id }}" recipe="{{$order->recipe->name}}" lot="{{$order->lot}}" {{$order->id == $decrease->departure_id ? "selected":""}}>
                                    @if($order->type == 1)
                                    {{ $order->order_number }} - CONTENIDO DE LA CAPSULA
                                    @elseif($order->type == 2)
                                    {{ $order->order_number }} - ENVOLVENTE DE LA CAPSULA 1
                                    @else
                                    {{ $order->order_number }} - ENVOLVENTE DE LA CAPSULA 2
                                    @endif
                                </option>
                                @endforeach
                                @endif
                            </select>
                            @error('order_number')
                            <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="">Receta</label>
                            <input name="recipe" type="text" readonly value="{{ $decrease->departure_id == NULL ? '':$decrease->departure->recipe->name }}" class="form-control acSupply">
                        </div>
                        <div class="col-sm-4">
                            <label for="">No. de Lote</label>
                            <input name="lot" id="" readonly value="{{ $decrease->departure_id == NULL ? '':$decrease->departure->lot }}" class="form-control">
                        </div>
                        @if(Auth::user()->role_id == 2)
                        <div class="col-sm-4">
                            <label for="">Estatus</label>
                            <select name="status"  class="form-control">
                                <option value="Creada" selected>Creada</option>
                                <option value="Liberado">Liberado</option>
                            </select>
                        </div>
                        @endif
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12">
                            <h5>Insumos</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Insumo</th>
                                        <th>Cantidad</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($decrease->supplies as $supply)
                                    <tr>
                                        <td><input type="hidden" value="{{ $supply->supply_id }}" name="idSupply[]"><input type="text" name="supplyCode[]" value="{{ $supply->supply->code }}" class="form-control" readonly></td>
                                        <td><input type="text" name="supplyName[]" value="{{ $supply->supply->name }}" class="form-control" readonly></td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="quantity[]" value="{{ $supply->quantity * 1000 }}" class="form-control number">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">{{$supply->supply->measurementUse->code == "mg" ? "g":$supply->supply->measurementUse->code}}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center"><a class="btn btn-danger btn-circle removeRow"><i class="fas fa-trash" style="color: #fff;"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <hr>
                            <h5>Motivo o Descripción</h5>
                            <input type="text" name="description" value="{{ $decrease->description }}" class="form-control">
                            @error('description')
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
                            <a href="{{ url('descargas') }}" class="btn btn-secondary btn-block">Cancelar</a>
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
    var availableItems = [];

    callEntrances = (x) => {
        $('select[name="entrance"]').empty();

        $.ajax({
            url: "{{ url('insumos') }}/" + x.id,
            async: true,
            success: function(data) {
                console.log(data)
                data.map(function(entrance) {
                    $('select[name="entrance"]').append('<option value="' + entrance.id + '">Entrada #' + entrance.id + '</option>');
                })
            },
            error: function() {

            }
        })
    }

    try {

        $(".acSupply").autocomplete({
            source: availableItems,
            select: function(event, ui) {
                $('input[name="supply"]').val(ui.item.id)
                callEntrances(ui.item)
            }
        });
    } catch (e) {
        console.log(e);
    }


    $(document).ready(function() {

    })
</script>
@endsection