@extends('layouts.admin2')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 pt-2">
            <h5 class="m-0 font-weight-bold text-primary">Modificar Orden de Compra</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('ordenes-de-compra.update', $entrance->id) }}">
          @method('PATCH')
          @csrf
          <div class="row">
            <div class="col-sm-4">
              <label for="">Proveedor</label>
              <select name="supplier" id="" {{ Auth::user()->role_id == 2 ? 'readonly':''}} class="form-control">
                <option value="">Seleccionar Proveedor</option>
                @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ $entrance->supplier_id == $supplier->id ? "selected":"" }}>{{ $supplier->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-4">
              <label for="">CFDI</label>
              <select name="cfdi" id="" {{ Auth::user()->role_id == 2 ? 'readonly':''}} class="form-control">
                <option value="">Seleccionar CFDI</option>
                @foreach($codes as $code)
                <option value="{{ $code->id }}" {{ $entrance->cfdi_id == $code->id ? "selected":"" }}>{{ $code->code.' - '.$code->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-4">
              <label for="">Requisición</label>
              <input type="text" name="requisition" {{ Auth::user()->role_id == 2 ? 'readonly':''}} value="{{ $entrance->requisition }}" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Departamento</label>
              <input type="text" name="department" {{ Auth::user()->role_id == 2 ? 'readonly':''}} value="{{ $entrance->department }}" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Elabora</label>
              <input type="text" name="mader" {{ Auth::user()->role_id == 2 ? 'readonly':''}} value="{{ $entrance->mader }}" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Solicita</label>
              <input type="text" name="owner" {{ Auth::user()->role_id == 2 ? 'readonly':''}} value="{{ $entrance->owner }}" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Autoriza</label>
              <input type="text" name="authorizer" {{ Auth::user()->role_id == 2 ? 'readonly':''}} value="{{ $entrance->authorizer }}" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Fecha Estimada de Entrega</label>
              <input type="date" name="expected_date" {{ Auth::user()->role_id == 2 ? 'readonly':''}} value="{{ $entrance->expected_date }}" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Cto. de Costos</label>
              <select name="costs" id="" {{ Auth::user()->role_id == 2 ? 'readonly':'' }} class="form-control">
                <option value="">Seleccionar Cto de Costos</option>
                @foreach($costs as $cost)
                <option value="{{ $cost->id }}" {{$cost->id == $entrance->cost_id ? "selected":""}}>{{ $cost->name }}</option>
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
                    <th colspan="{{Auth::user()->role_id == 2 ? '7':'8'}}">Contenido de la orden</th>
                    <th class="text-right">
                      @if(in_array(Auth::user()->role_id, [1,4]))
                      <a class="btn btn-link addContentRow text-primary">Agregar Insumo</a>
                      @endif
                      @if(Auth::user()->role_id == 2)
                      Aprobar todas
                      <div class="custom-control custom-switch float-right ml-2">
                        <input type="checkbox" class="custom-control-input" id="switchAll">
                        <label class="custom-control-label" for="switchAll"></label>
                      </div>
                      @endif
                    </th>
                  </tr>
                  <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Entrada</th>
                    <th>Cantidad</th>
                    @if(Auth::user()->role_id !== 2)
                    <th>Precio</th>
                    <th>Moneda</th>
                    @endif
                    <th>Medida de Uso</th>
                    <th>Estatus</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($entrance->items as $item)
                  <tr>
                    <input type="hidden" name="updated[]" value="{{$item->status == 'Aprobada' ? 1:0}}">

                    <td>{{ $item->supply->code }}</td>
                    <td>
                      <input type="hidden" name="idItem[]" value="{{ $item->id }}">
                      <input type="hidden" name="deletedItem[]" value="0" class="deleteInput">
                      <input type="hidden" name="splittedItem[]" value="{{ $item->splitted }}" class="deleteInput">
                      <input type="hidden" value="{{ $item->supply_id}}" class="idItem" name="idSupplyItem[]" />
                      <input type="hidden" name="lotSupplierItems[]" value="" class="form-control">
                      <input type="text" {{ Auth::user()->role_id == 2 || $item->status == "Aprobada" ? 'readonly':''}} value="{{ $item->supply->name }}" class="form-control itemContentidRow+'" />
                    </td>
                    <td>{{ sprintf("%05s", $item->id) }}</td>
                    <td><input type="text" {{ Auth::user()->role_id == 2 || $item->status == "Aprobada" ? 'readonly':''}} name="quantityItem[]" value="{{ number_format($item->quantity,2, '.', '') }}" class="form-control" /></td>
                    @if(Auth::user()->role_id == 2)
                    <input type="hidden" name="priceItem[]" value="{{ $item->price }}">
                    <input type="hidden" name="currencyItem[]" value="{{ $item->currency_id }}">
                    @else
                    <td><input type="text" {{ Auth::user()->role_id == 2 || $item->status == "Aprobada" ? 'readonly':''}} name="priceItem[]" value="{{ $item->price}}" class="form-control" /></td>
                    <td><select class="form-control" {{ Auth::user()->role_id == 2 || $item->status == "Aprobada" ? 'readonly':''}} name="currencyItem[]">
                        @foreach($currencies as $currency)
                        <option value="{{ $currency->id }}" {{$item->currency_id == $currency->id ? 'selected':''}}> {{$currency->name }} </option>
                        @endforeach
                      </select>
                    </td>
                    @endif
                    <td class="text-center"><span> {{ $item->supply->measurementBuy->name}} </span></td>
                    <td>
                      @if($item->status == 'Cuarentena')
                      <select name="statusItem[]" id="" class="form-control">
                        <option value="">Seleccione una opción</option>
                        <option value="Aprobada" {{$item->status == 'Aprobada' ? 'selected':''}}>Aprobada</option>
                        <option value="Rechazada" {{$item->status == 'Rechazada' ? 'selected':''}}>Rechazada</option>
                      </select>
                      @else
                      <input type="hidden" name="statusItem[]" value="{{$item->status}}">
                      <span>{{$item->status}}</span>
                      @endif
                    </td>
                    <td class="text-center">
                      @if(in_array(Auth::user()->role_id, [1,4]) && $item->status == "Creada")
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
            <div class="col-sm-12">
              <table class="table commentsTable">
                <thead>
                  <tr>
                    <th style="width: 80%;">Comentarios de la orden</th>
                    <th class="text-right">
                      @if(in_array(Auth::user()->role_id, [1,4]))
                      <a class="btn btn-link addCommentRow text-primary">Agregar Comentario</a>
                      @endif
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($entrance->comments as $comment)
                  <tr>
                    <td><input type="text" {{ Auth::user()->role_id == 2 ? 'readonly':''}} value="{{ $comment->comment }}" name="comments[]" class="form-control itemCommentRow+'" /></td>
                    <td class="text-center">
                      @if(Auth::user()->role_id == 1)
                      <a class="btn btn-danger btn-circle removeCommentRow">
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
  let idToRemove = 0;
  let row = null;

  @foreach($supplies as $supply)
  availableItems.push({
    id: "{{$supply->id}}",
    value: "{{ preg_replace('/[^A-Za-z0-9 ]/', '', $supply->name) }}",
    code: "{{$supply->code}}",
    price: "{{$supply->price}}",
    label: "{{$supply->code}} {{ preg_replace('/[^A-Za-z0-9 ]/', '', $supply->name) }}",
    measurement: "{{$supply->measurementBuy->name}}"
  })
  @endforeach

  @foreach($currencies as $currency)
  currencyOptions += '<option value="{{ $currency->id }}">{{ $currency->name }}</option>';
  @endforeach

  $(document).on('change', '#switchAll', function() {
    if ($(this).is(":checked")) {
      $(".contentTable tbody tr").each(function(index, tr) {
        $(tr).find("select").val("Aprobada");
      })
    } else {
      $(".contentTable tbody tr").each(function(index, tr) {
        $(tr).find("select").val("");
      })
    }
  })

  $(document).on('click', '.addContentRow', function() {

    $('.contentTable tbody tr').removeClass('activeRow')

    let idRow = $('.tableContent tbody tr').length + 1;
    $('.contentTable').append('<tr class="activeRow">' +
      '<td class="supplyCode"></td>' +
      '<td>' +
      '<input type="hidden" name="updated[]" value="0">'+
      '<input type="hidden" name="lotSupplierItems[]" value="" class="form-control">' +
      '<input type="hidden" name="deletedItem[]" value="0" class="deleteInput">' +
      '<input type="hidden" name="idItem[]" value="">' +
      '<input type="hidden" name="splittedItem[]" value="0" class="deleteInput">' +
      '<input type="hidden" value="" class="idItem" name="idSupplyItem[]" />' +
      '<input type="text" class="form-control itemContent' + idRow + '" /></td>' +
      '<td>No asignada</td>' +
      '<td><input type="text" name="quantityItem[]" class="form-control number"/></td>' +
      '<td><input type="text" name="priceItem[]" class="form-control number price"/></td>' +
      '<td><select class="form-control" name="currencyItem[]">' + currencyOptions + '</select></td>' +
      '<input type="hidden" name="statusItem[]" value="Creada" />' +
      '<td><span> - </span></td>' +
      '<td></td>' +
      '</tr>')

    $(".itemContent" + idRow).autocomplete({
      source: availableItems,
      select: function(event, ui) {
        console.log(ui)
        $('.contentTable .activeRow .idItem').val(ui.item.id)
        $('.contentTable .activeRow .supplyCode').text(ui.item.code)
        $('.contentTable .activeRow .price').val(ui.item.price)
        $('.contentTable .activeRow span').text(ui.item.measurement)
      }
    });
  })

  $(document).on('click', '.addCoverRow', function() {

    $('.coverTable tbody tr').removeClass('activeRow')

    let idRow = $('.tableCover tbody tr').length + 1;
    $('.coverTable').append('<tr class="activeRow">' +
      '<td><input type="hidden" class="idItem" name="idItemCover[]"/> <input type="text" class="form-control itemCover' + idRow + '" /></td>' +
      '<td><input type="text" name="quantityItemCover[]" class="form-control number" /></td>' +
      '<td><input type="text" name="excessItemCover[]" class="form-control number" value="0.0"/></td>' +
      '<td><span> - </span></td>' +
      '</tr>')

    $(".itemCover" + idRow).autocomplete({
      source: availableItems,
      select: function(event, ui) {
        console.log(ui)
        $('.coverTable .activeRow .idItem').val(ui.item.id)
        $('.coverTable .activeRow span').text(ui.item.measurement)
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
    row = $(this)
    $.confirm({
      title: '¿Estas seguro?',
      content: 'Se eliminara el número de entrada',
      buttons: {
        confirm: {
          text: 'Si, Eliminar',
          btnClass: 'btn-danger',
          action: function(confirm) {
            row.closest('tr').find('.deleteInput').val(1)
            row.closest('tr').hide()
          }

        },
        cancel: {
          text: 'No, Cancelar',
          btnClass: 'btn-secondary',
          action: function(cancel) {
            $.alert('Canceled!');
          }
        }
      }
    });
  })
</script>
@stop