@extends('layouts.admin2')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12 pt-2">
                        <h5 class="m-0 font-weight-bold text-primary">Descarga Extra de Insumo</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ url('descargas') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">OT</label>
                            <select name="order_number" id="" class="form-control">
                                <option value="">Seleccionar OT</option>
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
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="">Receta</label>
                            <input name="recipe" type="text" readonly class="form-control acSupply">
                        </div>
                        <div class="col-sm-4">
                            <label for="">No. de Lote</label>
                            <input name="lot" id="" readonly class="form-control">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-10">
                                    <h5>Insumos</h5>
                                </div>
                                <div class="col-sm-2">
                                    <a class="btn btn-link addContentRow text-primary">Agregar Insumo</a>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Insumo</th>
                                        <th>Cantidad</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            @error('idSupply')
                            <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <hr>
                            <h5>Motivo o Descripción</h5>
                            <input type="text" name="description" class="form-control">
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

    @foreach($supplies as $supply)
    availableItems.push({
        id: "{{$supply->id}}",
        value: "{{$supply->code}}",
        name: "{{ preg_replace('/[^A-Za-z0-9 ]/', '', $supply->name) }}",
        price: "{{$supply->price}}",
        label: "{{$supply->code}} {{ preg_replace('/[^A-Za-z0-9 ]/', '', $supply->name) }}",
        measurement: "{{$supply->measurementUse->code}}"
    })
    @endforeach

    $(document).on('click', '.addContentRow', function() {

        $('.table tbody tr').removeClass('activeRow')

        let idRow = $('.tableContent tbody tr').length + 1;
        $('.table').append('<tr class="activeRow">' +
            '<td>' +
            '<input type="hidden" name="idSupply[]" class="idItem"/>' +
            '<input type="text" class="form-control itemContent' + idRow + '" />' +
            '</td>' +
            '<td><input type="text" name="supplyName[]" class="form-control number supplyName" readonly/></td>' +
            '<td>' +
            '<div class="input-group">' +
            '<input type="text" name="quantity[]" value="" class="form-control number">' +
            '<div class="input-group-append">' +
            '<span class="input-group-text" id="basic-addon2"></span>' +
            '</div>' +
            '</div>' +
            '<td><a class="btn btn-danger btn-circle removeRow"><i class="fas fa-trash" style="color: #fff;"></i></a></td>' +
            '</tr>')

        $(".itemContent" + idRow).autocomplete({
            source: availableItems,
            select: function(event, ui) {
                console.log(ui)
                $('.table .activeRow .idItem').val(ui.item.id)
                $('.table .activeRow .supplyName').val(ui.item.name)
                $('.table .activeRow .input-group-text').text(ui.item.measurement == "mg" ? "g" : ui.item.measurement)
            }
        });
    })

    $(document).on('change', 'select[name="order_number"]', function() {
        $('.table tbody').empty();
        $('input[name="recipe"]').val($(this).find('option:selected').attr("recipe"))
        $('input[name="lot"]').val($(this).find('option:selected').attr("lot"))

        $.ajax({

            url: "{{ url('recetas') }}/" + $(this).find('option:selected').attr("recipe_id") + '-' + $(this).find('option:selected').attr("type"),
            async: true,
            success: function(data) {
                data.data.supplies.map(function(supply) {
                    let entranceNumbers = "";
                    supply.supply.entrances.map((entrance) => {
                        entranceNumbers += "<option value='" + entrance.id + "'>" + entrance.id.pad(5) + "</option>";
                    });

                    $('.table tbody').append('<tr>' +
                        '<td><input type="hidden" value="' + supply.supply_id + '"name="idSupply[]"><input type="text" name="supplyCode[]" value="' + supply.supply.code + '" class="form-control" readonly></td>' +
                        '<td><input type="text" name="supplyName[]" value="' + supply.supply.name + '" class="form-control" readonly></td>' +
                        '<td>' +
                        '<div class="input-group">' +
                        '<input type="text" name="quantity[]" value="" class="form-control number">' +
                        '<div class="input-group-append">' +
                        '<span class="input-group-text" id="basic-addon2">' + (supply.supply.measurement_use.code == "mg" ? "g" : supply.supply.measurement_use.code) + '</span>' +
                        '</div>' +
                        '</div>' +
                        '<td class="text-center"><a class="btn btn-danger btn-circle removeRow"><i class="fas fa-trash" style="color: #fff;"></i></a></td>' +
                        '</tr>');
                })

                /*$('.selectPicker').selectpicker({
                    noneSelectedText: "Seleccionar Entrada"
                }, 'refresh');

                $('.selectPicker').on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {

                    var ids = [];

                    $.each(e.target.selectedOptions, function(index, obj) {
                        ids.push(obj.value)
                    });

                    $(this).closest('tr').find("input[name='entranceNumbers[]']").val(ids.join(','))
                });*/
            },
            error: function() {

            }

        })
    })

    $(document).on('click', '.removeRow', function() {
        $(this).closest('tr').remove();
    })

    /*$(document).on('change', '.table tbody select', function() {
        var ids = [];

        $(this).val().map((id) => {
            ids.push(id)
        })

        $(this).closest('tr').find("input[name='entranceNumbers[]']").val(ids.join(','))
    })*/

    callEntrances = (x) => {
        $('select[name="entrance"]').empty();

        $.ajax({
            url: "{{ url('insumos') }}/" + x.id,
            async: true,
            success: function(data) {
                console.log(data)
                data.map(function(entrance) {
                    $('select[name="entrance"]').append('<option value="' + entrance.id + '">' + entrance.id.pad(5) + '</option>');
                })
            },
            error: function() {

            }
        })
    }

    Number.prototype.pad = function(size) {
        var s = String(this);
        while (s.length < (size || 2)) {
            s = "0" + s;
        }
        return s;
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