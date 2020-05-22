@extends('layouts.admin2')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 pt-2">
            <h5 class="m-0 font-weight-bold text-primary">Nuevo Pedido</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
      <form method="post" action="{{ route('pedidos.update', $order->id) }}">
          @method('PATCH')
          @csrf
          <div class="row">
            <div class="col-sm-4">
              <label for="">Cliente</label>
              <select name="client_id" id="" class="form-control">
                <option value="">Seleccionar cliente</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}" {{$client->id == $order->client_id ? 'selected':''}}>{{ $client->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-4">
              <label for="">No de Order de Compra Cliente</label>
              <input type="text" name="order_number" value="{{ $order->order_number }}" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Fecha Compromiso de Entrega</label>
              <input type="date" name="commitment_date" value="{{ $order->commitment_date }}" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Elabora</label>
              <input type="text" name="mader" value="{{ $order->mader }}" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="">Autoriza</label>
              <input type="text" name="authorizer" value="{{ $order->authorizer }}" class="form-control">
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-12">
              <table class="table contentTable">
                <thead>
                  <tr>
                    <th colspan="2">Contenido del Pedido</th>
                    <th class="text-right">
                      <a class="btn btn-link addContentRow text-primary">Agregar Producto</a>
                    </th>
                  </tr>
                  <tr>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Cantidad</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                <tr>
                    <td>
                      <input type="hidden" name="idItem[]" value="{{ $item->product_id }}">
                      <input type="text" class="form-control itemContent{{$item->id}}" value="{{ $item->product->name }}" /></td>
                      <td><input type="text" name="codeItem[]" value="{{ $item->product->code}}" class="form-control" /></td>
                    <td><input type="text" name="quantityItem[]" value="{{ $item->quantity}}" class="form-control" /></td>
                    <td class="text-center">
                      @if(Auth::user()->role_id == 1)
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
                @foreach($order->comments as $comment)
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

  @foreach($products as $product)
  availableItems.push({
    id: "{{$product->id}}",
    code: "{{$product->code}}",
    value: "{{$product->name}}",
    price: "{{$product->price}}",
    label: "{{$product->code}} {{$product->name}}"
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
      '<td><input type="text" name="codeItem[]" class="form-control number code"/></td>' +
      '<td><input type="text" name="quantityItem[]" class="form-control number"/></td>' +
      '</tr>')

    $(".itemContent" + idRow).autocomplete({
      source: availableItems,
      select: function(event, ui) {
        console.log(ui)
        $('.contentTable .activeRow .idItem').val(ui.item.id)
        $('.contentTable .activeRow .code').val(ui.item.code)
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