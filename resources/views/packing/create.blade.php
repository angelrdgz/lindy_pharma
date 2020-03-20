@extends('layouts.admin2')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12 pt-2">
                        <h5 class="m-0 font-weight-bold text-primary">Nueva Orden de Acondicionamiento</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ url('ordenes-de-acondicionamiento') }}">
                    @csrf
                    <div class="row">
                    <div class="col-sm-4">
                            <label for="">Nombre de Acondicionamiento</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Producto</label>
                            <select name="product" id="" class="form-control">
                                <option value="">Seleccionar Producto</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cantidad</label>
                            <input type="text" name="quantity" class="form-control number">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cliente</label>
                            <select name="client" id="" class="form-control">
                                <option value="">Seleccionar cliente</option>
                                @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="">Lote</label>
                            <input type="text" name="lot" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Presentación</label>
                            <input type="text" name="presentation" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Fecha de Expiración</label>
                            <input type="date" name="expire" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table contentTable">
                                <thead>
                                    <tr>
                                        <th colspan="3">Insumos Requeridos</th>
                                        <th class="text-right">
                                            <a class="btn btn-link addContentRow">Agregar Insumo</a>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Exceso</th>
                                        <th>Medida de Uso</th>
                                    </tr>
                                </thead>
                                <tbody>

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

@section('script')

<script>
    var availableItems = [];

    @foreach($supplies as $supply)
    availableItems.push({
        id: "{{$supply->id}}",
        value: "{{$supply->name}}",
        label: "{{$supply->code}} {{$supply->name}}",
        measurement: "{{$supply->measurementUse->name}}"
    })
    @endforeach

    $(document).on('click', '.addContentRow', function() {

        $('.contentTable tbody tr').removeClass('activeRow')

        let idRow = $('.tableContent tbody tr').length + 1;
        $('.contentTable').append('<tr class="activeRow">' +
            '<td><input type="hidden" class="idItem" name="idItem[]"/> <input type="text" class="form-control itemContent' + idRow + '" /></td>' +
            '<td><input type="text" name="quantityItem[]" class="form-control number"/></td>' +
            '<td><input type="text" name="excessItem[]" class="form-control number" value="0.0"/></td>' +
            '<td><span> - </span></td>' +
            '</tr>')

        $(".itemContent" + idRow).autocomplete({
            source: availableItems,
            select: function(event, ui) {
                console.log(ui)
                $('.contentTable .activeRow .idItem').val(ui.item.id)
                $('.contentTable .activeRow span').text(ui.item.measurement)
            }
        });
    })
</script>

@stop