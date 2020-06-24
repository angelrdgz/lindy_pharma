@extends('layouts.admin2')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12 pt-2">
                        <h5 class="m-0 font-weight-bold text-primary">Descarga Extra de Granel</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ url('descargas-granel') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">OT</label>
                            <select name="package_id" id="" class="form-control">
                                <option value="">Seleccionar OT</option>
                                @foreach($orderNumbers as $order)
                                <option value="{{ $order->id }}" type="{{ $order->type }}" product_id="{{ $order->product_id }}" product="{{$order->product->name}}" presentation="{{$order->presentation}}">
                                    {{ $order->lot }} 
                                </option>
                                @endforeach
                            </select>
                            @error('recipe_id')
                            <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="">Producto</label>
                            <input name="product" type="text" readonly class="form-control acSupply">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Presentación</label>
                            <input name="presentation" id="" readonly class="form-control">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12">
                            <h5>Granel</h5>
                            <table class="table recipesTable">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Receta</th>
                                        <th>Cantidad</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12">
                            <h5>Insumos</h5>
                            <table class="table suppliesTable">
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
                            <a href="{{ url('descargas-granel') }}" class="btn btn-secondary btn-block">Cancelar</a>
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

    $(document).on('change', 'select[name="package_id"]', function() {
        $('.table tbody').empty();
        $('input[name="product"]').val($(this).find('option:selected').attr("product"))
        $('input[name="presentation"]').val($(this).find('option:selected').attr("presentation"))

        $.ajax({

            url: "{{ url('productos') }}/" + $(this).find('option:selected').attr("product_id"),
            async: true,
            success: function(data) {
                console.log(data)

                data.data.recipes.map(function(recipe) {
                    /*let entranceNumbers = "";
                    supply.supply.entrances.map((entrance) => {
                        entranceNumbers += "<option value='" + entrance.id + "'>" + entrance.id.pad(5) + "</option>";
                    });*/

                    $('.recipesTable tbody').append('<tr>' +
                        '<td><input type="hidden" value="' + recipe.recipe_id + '"name="idRecipe[]"><input type="text" name="recipeCode[]" value="' + recipe.recipe.code + '" class="form-control" readonly></td>' +
                        '<td><input type="text" name="recipeName[]" value="' + recipe.recipe.name + '" class="form-control" readonly></td>' +
                        '<td>' +
                        '<div class="input-group">' +
                        '<input type="text" name="quantityRecipe[]" value="" class="form-control number">' +
                        '<div class="input-group-append">' +
                        '<span class="input-group-text" id="basic-addon2">cap</span>' +
                        '</div>' +
                        '</div>' +
                        '<td class="text-center"><a class="btn btn-danger btn-circle removeRow"><i class="fas fa-trash" style="color: #fff;"></i></a></td>' +
                        '</tr>');
                })

                data.data.supplies.map(function(supply) {
                    /*let entranceNumbers = "";
                    supply.supply.entrances.map((entrance) => {
                        entranceNumbers += "<option value='" + entrance.id + "'>" + entrance.id.pad(5) + "</option>";
                    });*/

                    $('.suppliesTable tbody').append('<tr>' +
                        '<td><input type="hidden" value="' + supply.supply_id + '"name="idSupply[]"><input type="text" name="supplyCode[]" value="' + supply.supply.code + '" class="form-control" readonly></td>' +
                        '<td><input type="text" name="supplyName[]" value="' + supply.supply.name + '" class="form-control" readonly></td>' +
                        '<td>' +
                        '<div class="input-group">' +
                        '<input type="text" name="quantity[]" value="" class="form-control number">' +
                        '<div class="input-group-append">' +
                        '<span class="input-group-text" id="basic-addon2">' + supply.supply.measurement_use.code + '</span>' +
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