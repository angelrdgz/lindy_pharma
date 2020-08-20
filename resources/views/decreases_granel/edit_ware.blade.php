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
                <form method="post" action="{{ url('descargas-granel/'.$decrease->id.'/items') }}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">OT</label>
                            <input type="text" name="package_id" class="form-control" value="{{ $decrease->package_id == NULL ? '':$decrease->package->lot}}" readonly>
                            @error('package_id')
                            <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="">Producto</label>
                            <input name="product" type="text" readonly value="{{ $decrease->package_id == NULL ? '':$decrease->package->product->name }}" class="form-control acSupply">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Presentación</label>
                            <input name="presentation" id="" readonly value="{{ $decrease->package_id == NULL ? '':$decrease->package->presentation }}" class="form-control">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12">
                            <h5>Granel</h5>
                            <table class="table suppliesTable">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Receta</th>
                                        <th>Cantidad</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($decrease->recipes as $recipe)
                                    <tr>
                                        <input type="hidden" name="idRowRecipe[]" value="{{ $recipe->id }}">
                                        <input type="hidden" name="processedRecipe[]" value="{{ $recipe->processed }}">
                                        <td  style="max-width:50px;"><input type="hidden" value="{{ $recipe->recipe_id }}" name="idRecipe[]"><input type="text" name="recipeCode[]" value="{{ $recipe->recipe->code }}" class="form-control" readonly></td>
                                        <td  style="max-width:50px;"><input type="text" name="recipeName[]" value="{{ $recipe->recipe->name }}" class="form-control" readonly></td>
                                        <td style="width:200px !important;">
                                            <div class="input-group m-0 float-left" style="max-width:160px;">
                                                <input type="text" name="quantityRecipe[]" value="{{ $recipe->quantity }}" class="form-control number" {{$recipe->processed == 1 ? "readonly":""}}>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">cap</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($recipe->processed == 1)
                                            Procesado
                                            @else
                                            <input type="hidden" name="lotNumbers[]">
                                            <select id="" class="form-control selectPickerRecipe" multiple>
                                                <?php var_dump($recipe->recipe->lotNumbers($recipe->recipe->id)); ?>
                                                @foreach($recipe->recipe->lotNumbers($recipe->recipe->id) as $order)
                                                <option value="{{ $order->id }}">{{sprintf("%05s", $order->id)}}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
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
                                <tbody>
                                    @foreach($decrease->supplies as $supply)
                                    <tr>
                                        <input type="hidden" name="idRow[]" value="{{ $supply->id }}">
                                        <input type="hidden" name="processed[]" value="{{ $supply->processed }}">
                                        <td  style="max-width:50px;"><input type="hidden" value="{{ $supply->supply_id }}" name="idSupply[]"><input type="text" name="supplyCode[]" value="{{ $supply->supply->code }}" class="form-control" readonly></td>
                                        <td  style="max-width:50px;"><input type="text" name="supplyName[]" value="{{ $supply->supply->name }}" class="form-control" readonly></td>
                                        <td style="width:200px !important;">
                                            <div class="input-group m-0 float-left" style="max-width:160px;">
                                                <input type="text" name="quantity[]" value="{{ $supply->quantity }}" class="form-control number" {{$supply->processed == 1 ? "readonly":""}}>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">{{$supply->supply->measurementUse->code}}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($supply->processed == 1)
                                            Procesado
                                            @else
                                            <input type="hidden" name="entranceNumbers[]">
                                            <select id="" class="form-control selectPicker" multiple>
                                                @foreach($supply->supply->entranceNumbers($supply->supply->id) as $order)
                                                <option value="{{ $order->id}}">{{sprintf("%05s", $order->id)}}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                        </td>
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
                            <input type="text" name="description" readonly value="{{ $decrease->description }}" class="form-control">
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


    $(function(){
        $('.selectPicker').selectpicker({
            noneSelectedText: "Seleccionar Entrada"
        });

        $('.selectPicker').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {

            var ids = [];

            $.each( e.target.selectedOptions , function( index, obj ){
                ids.push(obj.value)
            });

            $(this).closest('tr').find("input[name='entranceNumbers[]']").val(ids.join(','))
        });

        $('.selectPickerRecipe').selectpicker({
            noneSelectedText: "Seleccionar Lote"
        });

        $('.selectPickerRecipe').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {

            var ids = [];

            $.each( e.target.selectedOptions , function( index, obj ){
                ids.push(obj.value)
            });

            $(this).closest('tr').find("input[name='lotNumbers[]']").val(ids.join(','))
        });
    })
</script>
@endsection