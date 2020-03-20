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
                            <label for="">Insumo</label>
                            <input type="hidden" name="supply" value="{{ $decrease->supply_id }}">
                            <input name="" type="text" value="{{ $decrease->supply->code }} - {{ $decrease->supply->name }}" class="form-control acSupply">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Número de Entrada</label>
                            <select name="entrance" id="" class="form-control">
                                @foreach($decrease->supply->entranceNumbers($decrease->supply_id) as $entrance)
                                <option value="{{$entrance->id}}" {{$entrance->id == $decrease->entrance_item_id ? "selected":"" }}>Entrada #{{ $entrance->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cantidad</label>
                            <input type="text" value="{{ $decrease->quantity }}" name="quantity" class="form-control number">
                        </div>
                        <div class="col-sm-12">
                            <label for="">Motivo o Descripción</label>
                            <input type="text" value="{{ $decrease->description }}" name="description" class="form-control">
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
        value: "{{$supply->name}}",
        label: "{{$supply->code}} {{$supply->name}}",
        measurement: "{{$supply->measurementBuy->name}}"
    })
    @endforeach

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