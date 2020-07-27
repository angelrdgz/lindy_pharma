@extends('layouts.admin2')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 pt-2">
            <h5 class="m-0 font-weight-bold text-primary">Nueva Orden de Compra</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="{{ url('ordenes-de-compra') }}">
          @csrf
          <div class="row">
            <div class="col-sm-4">
              <label for="">Proveedor</label>
              <select name="supplier" id="" class="form-control">
                <option value="">Seleccionar Proveedor</option>
                @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-4">
              <label for="">CFDI</label>
              <select name="cfdi" id="" class="form-control">
                <option value="">Seleccionar CFDI</option>
                @foreach($codes as $code)
                <option value="{{ $code->id }}">{{ $code->code.' - '.$code->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-4">
              <label for="">Requisición</label>
              <input type="text" name="requisition" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Departamento</label>
              <input type="text" name="department" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Elabora</label>
              <input type="text" name="mader" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Solicita</label>
              <input type="text" name="owner" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Autoriza</label>
              <input type="text" name="authorizer" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Fecha Estimada de Entrega</label>
              <input type="date" name="expected_date" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Cto. de Costos</label>
              <select name="costs" id="" class="form-control">
                <option value="">Seleccionar Cto de Costos</option>
                @foreach($costs as $cost)
                 <option value="{{ $cost->id }}">{{ $cost->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-12">
              <table class="table contentTable">
                <thead>
                  <tr>
                    <th colspan="4">Contenido de la orden</th>
                    <th class="text-right">
                      <a class="btn btn-link addContentRow text-primary">Agregar Insumo</a>
                    </th>
                  </tr>
                  <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Moneda</th>
                    <th>Medida de Compra</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
          <br>
          <br>
          <div class="row">
            <div class="col-sm-12">
              <table class="table commentsTable">
                <thead>
                  <tr>
                    <th style="width: 80%;">Comentarios de la orden</th>
                    <th class="text-right">
                      <a class="btn btn-link addCommentRow text-primary">Agregar Comentario</a>
                    </th>
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
  var availableItems = [];
  var currencyOptions = "";

  @foreach($supplies as $supply)
  availableItems.push({
    id: "{{$supply->id}}",
    value: "{{ preg_replace('/[^A-Za-z0-9 ]/', '', $supply->name) }}",
    price: "{{$supply->price}}",
    label: "{{$supply->code}} {{ preg_replace('/[^A-Za-z0-9 ]/', '', $supply->name) }}",
    measurement: "{{$supply->measurementBuy->name}}"
  })
  @endforeach

  @foreach($currencies as $currency)
   currencyOptions += '<option value="{{ $currency->id }}">{{ $currency->name }}</option>';
  @endforeach

  $(document).on('click', '.addContentRow', function() {

    $('.contentTable tbody tr').removeClass('activeRow')

    let idRow = $('.tableContent tbody tr').length + 1;
    $('.contentTable').append('<tr class="activeRow">' +
      '<td><input type="hidden" name="idItem[]" class="idItem"/> <input type="text" class="form-control itemContent' + idRow + '" /></td>' +
      '<td><input type="text" name="quantityItem[]" value="0" class="form-control number"/></td>' +
      '<td><input type="text" name="priceItem[]" class="form-control number price"/></td>' +
      '<td><select class="form-control" name="currencyItem[]">'+currencyOptions+'</select></td>' +
      '<td><span> - </span></td>' +
      '</tr>')

    $(".itemContent" + idRow).autocomplete({
      source: availableItems,
      select: function(event, ui) {
        console.log(ui)
        $('.contentTable .activeRow .idItem').val(ui.item.id)
        $('.contentTable .activeRow .price').val(ui.item.price)
        $('.contentTable .activeRow span').text(ui.item.measurement)
      }
    });
  })

  $(document).on('click', '.addCommentRow', function() {

    $('.commentsTable tbody tr').removeClass('activeRow')

    let idRow = $('.tableCover tbody tr').length + 1;
    $('.commentsTable').append('<tr class="activeRow">' +
      '<td><input name="comments[]" type="text" class="form-control commentCover' + idRow + '" /></td>' +
      '<td class="text-center"><a class="btn btn-danger btn-circle removeCommentRow"><i class="fas fa-trash" style="color: #fff;"></i></a></td>' +
      '</tr>')
  })

  $(document).on('click', '.removeCommentRow', function() {
    $(this).closest('tr').remove();
  })

  $(document).on('click', '.removeRow', function() {
    $(this).closest('tr').remove();
  })
</script>
@stop