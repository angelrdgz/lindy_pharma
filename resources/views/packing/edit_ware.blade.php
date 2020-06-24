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
                <form method="post" target="_blank" action="{{ url('ordenes-de-acondicionamiento/'.$package->id.'/items') }}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        @if(Auth::user()->role_id == 3)
                        <div class="col-sm-12">
                            <h5>Recetas</h5>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Receta</th>
                                        <th>Cantidad</th>
                                        <th>Cantidad Surtida</th>
                                        <th>Núm. de Lote</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($package->recipes as $recipe)
                                    <tr>
                                        <td>{{ $recipe->recipe->code.' - '.$recipe->recipe->name }}</td>
                                        <td>{{ number_format((($recipe->quantity + ($recipe->quantity * ($recipe->excess / 100))) * $package->quantity),2)}} pza</td>
                                        <td><input type="text" class="form-control number" name="deliverQuantityRecipe[]" value="{{ $recipe->deliver_quantity !== NULL ? $recipe->deliver_quantity:(($recipe->quantity + ($recipe->quantity * ($recipe->excess / 100))) * $package->quantity)}}"></td>
                                        <td>
                                            <input type="hidden" name="recipeId[]" value="{{ $recipe->recipe_id }}">
                                            <input type="hidden" name="idRecipeRow[]" value="{{$recipe->id}}">
                                            <input type="hidden" name="processedRecipe[]" value="{{$recipe->processed}}">
                                            <input type="hidden" name="lotNumber[]" value="{{$recipe->lot_number}}">
                                            <select id="" class="form-control selectPickerLot" multiple>
                                                @foreach($recipe->recipe->lotNumbers($recipe->recipe_id) as $order)
                                                <option value="{{ $order->id }}">{{$order->lot}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h5>Insumos</h5>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Insumo</th>
                                        <th>Cantidad</th>
                                        <th>Cantidad Surtida</th>
                                        <th>Núm. de Entrada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($package->supplies as $supply)
                                    <tr>
                                        <td>{{ $supply->supply->code.' - '.$supply->supply->name }}</td>
                                        <td>{{ number_format((($supply->quantity + ($supply->quantity * ($supply->excess / 100))) * $package->quantity),2)}} pza</td>
                                        <td><input type="text" class="form-control number" name="deliverQuantity[]" value="{{ $supply->deliver_quantity !== NULL ? $supply->deliver_quantity:(($supply->quantity + ($supply->quantity * ($supply->excess / 100))) * $package->quantity)}}"></td>
                                        <td>
                                            <input type="hidden" name="supplyId[]" value="{{ $supply->supply_id }}">
                                            <input type="hidden" name="idSupplyRow[]" value="{{$supply->id}}">
                                            <input type="hidden" name="processed[]" value="{{$supply->processed}}">
                                            <input type="hidden" name="orderNumber[]" value="{{$supply->entrance_number}}">
                                            <select id="" class="form-control selectPickerEntrance" multiple>
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

@section("script")
<script>
    $(function() {
        $('.selectPickerLot').selectpicker({
            noneSelectedText: "Seleccionar Número de Lote"
        });

        $('.selectPickerEntrance').selectpicker({
            noneSelectedText: "Seleccionar Número de Entrada"
        });

        $('.selectPickerLot').on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {

            var ids = [];

            $.each(e.target.selectedOptions, function(index, obj) {
                ids.push(obj.value)
            });

            $(this).closest('tr').find("input[name='lotNumber[]']").val(ids.join(','))
        });

        $('.selectPickerEntrance').on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {

            var ids = [];

            $.each(e.target.selectedOptions, function(index, obj) {
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