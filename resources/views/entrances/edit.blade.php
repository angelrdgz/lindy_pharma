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
              <select name="supplier" id="" class="form-control">
                <option value="">Seleccionar Proveedor</option>
                @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ $entrance->supplier_id == $supplier->id ? "selected":"" }}>{{ $supplier->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-4">
              <label for="">CFDI</label>
              <select name="cfdi" id="" class="form-control">
                <option value="">Seleccionar CFDI</option>
                @foreach($codes as $code)
                <option value="{{ $code->id }}" {{ $entrance->cfdi_id == $code->id ? "selected":"" }}>{{ $code->code.' - '.$code->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-4">
              <label for="">Requesición</label>
              <input type="text" name="requisition" value="{{ $entrance->requisition }}" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Departamento</label>
              <input type="text" name="department" value="{{ $entrance->department }}" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Estatus</label>
              <select name="status" id="" class="form-control">
                <option value="">Seleccionar Estatus</option>
                <option value="Cuarentena" {{$entrance->status == "Cuarentena" ? "selected":""}}>Cuarentena</option>
                <option value="Aprobada" {{$entrance->status == "Aprobada" ? "selected":""}}>Aprobada</option>
                <option value="Rechazada" {{$entrance->status == "Rechazada" ? "selected":""}}>Rechazada</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="">Elabora</label>
              <input type="text" name="mader" value="{{ $entrance->mader }}" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Solicita</label>
              <input type="text" name="owner" value="{{ $entrance->owner }}" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Autoriza</label>
              <input type="text" name="authorizer" value="{{ $entrance->authorizer }}" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Cto. de Costos</label>
              <select name="costs" id="" class="form-control">
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
                    <th colspan="4">Contenido de la orden</th>
                    <th class="text-right">
                      <a class="btn btn-link addContentRow text-primary">Agregar Insumo</a>
                    </th>
                  </tr>
                  <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Medida de Uso</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($entrance->items as $item)
                  <tr>
                    <td><input type="hidden" value="{{ $item->supply_id}}" class="idItem" name="idItem[]" /> <input type="text" value="{{ $item->supply->name }}" class="form-control itemContentidRow+'" /></td>
                    <td><input type="text" name="quantityItem[]" value="{{ $item->quantity}}" class="form-control" /></td>
                    <td><input type="text" name="priceItem[]" value="{{ $item->price}}" class="form-control" /></td>
                    <td class="text-center"><span> {{ $item->supply->measurementBuy->name}} </span></td>
                    <td class="text-center">
                      <a class="btn btn-danger btn-circle removeRow">
                        <i class="fas fa-trash" style="color: #fff;"></i>
                      </a>
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
                      <a class="btn btn-link addCommentRow text-primary">Agregar Comentario</a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($entrance->comments as $comment)
                  <tr>
                    <td><input type="text" value="{{ $comment->comment }}" name="comments[]" class="form-control itemCommentRow+'" /></td>
                    <td class="text-center">
                      <a class="btn btn-danger btn-circle removeCommentRow">
                        <i class="fas fa-trash" style="color: #fff;"></i>
                      </a>
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

  @foreach($supplies as $supply)
  availableItems.push({
    id: "{{$supply->id}}",
    value: "{{$supply->name}}",
    label: "{{$supply->code}} {{$supply->name}}",
    measurement: "{{$supply->measurementBuy->name}}"
  })
  @endforeach

  $(document).on('click', '.addContentRow', function() {

    $('.contentTable tbody tr').removeClass('activeRow')

    let idRow = $('.tableContent tbody tr').length + 1;
    $('.contentTable').append('<tr class="activeRow">' +
      '<td><input type="hidden" class="idItem" name="idItem[]"/> <input type="text" class="form-control itemContent' + idRow + '" /></td>' +
      '<td><input type="text" name="quantityItem[]" class="form-control number"/></td>' +
      '<td><input type="text" name="priceItem[]" class="form-control number"/></td>' +
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
      '<td class="text-center"><a class="btn btn-danger btn-circle removeCommentRow"><i class="fas fa-trash" style="color: #fff;"></i></a></td>'+
      '</tr>')
  })

  $(document).on('click', '.removeCommentRow',function(){
    $(this).closest('tr').remove();
  })

  $(document).on('click', '.removeRow',function(){
    $(this).closest('tr').remove();
  })


</script>
@stop