@extends('layouts.admin2')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 pt-2">
            <h5 class="m-0 font-weight-bold text-primary">Orden de Compra #{{ $entrance->id}}</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('ordenes-de-compra.update', $entrance->id) }}">
          @method('PATCH')
          @csrf
          <input type="hidden" name="supplier" value="{{$entrance->supplier_id}}" />
          <input type="hidden" name="cfdi" value="{{$entrance->cfdi_id}}" />
          <input type="hidden" name="requisition" value="{{$entrance->requisition}}" />
          <input type="hidden" name="department" value="{{$entrance->department}}" />
          <input type="hidden" name="mader" value="{{$entrance->mader}}" />
          <input type="hidden" name="owner" value="{{$entrance->owner}}" />
          <input type="hidden" name="authorizer" value="{{$entrance->authorizer}}" />
          <input type="hidden" name="expected_date" value="{{$entrance->expected_date}}" />
          <input type="hidden" name="costs" value="{{$entrance->cost_id}}" />
          <div class="row">
            <div class="col-sm-12">
              <table class="table contentTable">
                <thead>
                  <tr>
                    <th colspan="3">Contenido de la orden</th>
                  </tr>
                  <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Estatus</th>
                    <th>Comentarios</th>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  @foreach($entrance->items as $item)
                  <tr>
                    <input type="hidden" name="updated[]" value="{{$item->status == 'Aprobada' ? 1:0}}">
                    <input type="hidden" name="idItem[]" value="{{ $item->id }}">
                    <input type="hidden" name="splittedItem[]" value="{{ $item->splitted }}">
                    <input type="hidden" name="deletedItem[]" value="0" class="deleteInput">
                    <input type="hidden" name="lotSupplierItems[]" value="{{ $item->lot_supplier }}" class="form-control">
                    <input type="hidden" value="{{ $item->supply_id }}" class="idItem" name="idSupplyItem[]" />
                    <input type="hidden" name="priceItem[]" value="{{ $item->price}}" class="form-control" /></td>
                    <input type="hidden" name="currencyItem[]" value="{{ $item->currency_id}}" class="form-control" /></td>
                    <td>
                      <input type="text" value="{{ $item->supply->name }}" class="form-control itemContentidRow" readonly /></td>
                    <td><input type="text" name="quantityItem[]" value="{{ $item->quantity}}" class="form-control quantityId{{ $item->supply_id }}" {{$item->status !== "Creada" ? "readonly":""}}/></td>
                    <td>
                      @if($item->status == 'Aprobada')
                      <input type="text" name="statusItem[]" class="form-control" value="Aprobada" readonly >
                      @else
                      <select name="statusItem[]" id="" class="form-control">
                        <option value="">Seleccione una opción</option>
                        <option value="Cuarentena" {{$item->status == "Cuarentena" ? "selected":""}}>Cuarentena</option>
                        <option value="Rechazada" {{$item->status == "Rechazada" ? "selected":""}}>Rechazada</option>
                      </select>
                      @endif
                    </td>
                    <td class="text-center">
                      <input type="text" name="commentsItem[]" value="{{ $item->comments }}" class="form-control" {{$item->status !== "Creada" ? "readonly":""}}/>
                    </td>
                    <td>
                      @if($item->splitted == 0 && $item->status == 'Creada')
                      <a class="btn btn-primary btn-block splittedBtn" style="color:#fff;">Dividir</a>
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

<div class="modal fade" id="splitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dividir Entrada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="">¿En cuantas partes deseas dividir la entrada?</label>
          <input type="number" min="2" max="5" class="form-control splitBox">
          <div class="text-danger d-none">La cantidad debe ser mayor a 1 y menor a 6</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary splitBtn">Dividir</button>
      </div>
    </div>
  </div>
</div>


@stop

@section('script')

<script>

  var row = {id: 0, name:"", quantity: null, supply_id: null, price: null, currency_id: null}

  var quantityToSplit = null;
  var btnSplit = null;

  var quantityBox = null;
  var trIndex = null;

  var ids = [];

  @foreach($entrance->items as $item)
   ids["quantityId"+{{ $item->supply_id }}] = {{ $item->quantity }}
  @endforeach

  console.log(ids)


  $(document).on('click', '.splittedBtn', function() {

    trIndex = $(this).closest('tr').index();

    row = {
      id: $(this).closest('tr').find("input[name='idItem[]']").val(),
      supply_id: $(this).closest('tr').find("input[name='idSupplyItem[]']").val(),
      quantity: $(this).closest('tr').find("input[name='quantityItem[]']").val(),
      name: $(this).closest('tr').find(".itemContentidRow").val(),
      price: $(this).closest('tr').find("input[name='priceItem[]']").val(),
      currency_id: $(this).closest('tr').find("input[name='currencyItem[]']").val(),
    }

    quantityBox = $(this).closest('tr').find("input[name='quantityItem[]']")
    tr = $(this).closest('tr')
    $('#splitModal').modal()
  })

  $('#splitModal').on('show.bs.modal', function(event) {
    $('.splitBox').val("2")
  })
  
  $(document).on('keyup', 'input[name="quantityItem[]"]', function() {
    console.log($(this).val())
    if ($(this).val() == "") {
      $(this).val(0)
    } else {
      var supplyClass = $(this).attr('class').split(' ')[1]
      var total = ids[supplyClass]

      var sum = 0;
      $("."+supplyClass).each(function() {
        sum += parseFloat($(this).val()); // Or this.innerHTML, this.innerText
      });

      console.log(total+' - '+sum)

      if(total < sum){
        $(this).val(parseInt($(this).val()) - (sum -total))
      }

    }
  })

  $(document).on('click', '.splitBtn', function() {
    if(!($('.splitBox').val() >= 2 && $('.splitBox').val() <= 5)){
     $('.text-danger').removeClass('d-none') 
     return false;
    }else{
      $('.text-danger').addClass('d-none') 
    }

    let total = row.quantity  / $('.splitBox').val()
    quantityBox.val(total)
    for (let index = 0; index < ($('.splitBox').val() - 1); index++) {
      $('.contentTable tbody tr').eq(trIndex).after("<tr>"+
                    '<input type="hidden" name="updated[]" value="-1">'+
                    '<input type="hidden" name="idItem[]" value="">'+
                    '<input type="hidden" name="splittedItem[]" value="1">'+                    
                    '<input type="hidden" name="deletedItem[]" value="0" class="deleteInput">'+
                    '<input type="hidden" name="lotSupplierItems[]" value="" class="form-control">'+
                    '<input type="hidden" value="'+row.supply_id+'" class="idItem" name="idSupplyItem[]" />'+
                    '<input type="hidden" name="priceItem[]" value="'+row.price+'" class="form-control" /></td>'+
                    '<input type="hidden" name="currencyItem[]" value="'+row.currency_id+'" class="form-control" /></td>'+
                    '<td><input type="text" value="'+row.name+'" class="form-control itemContentidRow" readonly /></td>'+
                    '<td><input type="text" name="quantityItem[]" value="'+total+'" class="form-control quantityId'+row.supply_id+'" /></td>'+
                    '<td>'+
                      '<select name="statusItem[]" id="" class="form-control">'+
                        '<option value="">Seleccione una opción</option>'+
                        '<option value="Cuarentena">Cuarentena</option>'+
                        '<option value="Rechazada">Rechazada</option>'+
                     ' </select>'+
                    '</td>'+
                    '<td class="text-center"><input type="text" name="commentsItem[]" value="" class="form-control" /></td>'+
                    '<td></td>'+
                  '</tr>');      
    }
    tr.find('.btn').hide();
    tr.find('input[name="splittedItem[]"]').val(1);
    $('#splitModal').modal("hide")
  })
</script>
@stop