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
                <label for="">Fecha de Petición</label>
                <input type="date" name="delivery" class="form-control">
              </div>
            </div>
            <hr>
  <div class="row">
    <div class="col-sm-12">
      <table class="table contentTable">
        <thead>
          <tr>
            <th colspan="2">Contenido de la orden</th>
            <th class="text-right">
              <a class="btn btn-link addContentRow">Agregar Insumo</a>
            </th>
          </tr>
          <tr>
            <th>Nombre</th>
            <th>Cantidad</th>
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
                     availableItems.push({id: "{{$supply->id}}",value: "{{$supply->name}}", label: "{{$supply->code}} {{$supply->name}}", measurement: "{{$supply->measurementBuy->name}}"})
                    @endforeach
    
                       $(document).on('click', '.addContentRow', function(){

                        $('.contentTable tbody tr').removeClass('activeRow')

                         let idRow = $('.tableContent tbody tr').length +1;
                        $('.contentTable').append('<tr class="activeRow">'+
                        '<td><input type="hidden" class="idItem" name="idItem[]"/> <input type="text" class="form-control itemContent'+idRow+'" /></td>'+
                        '<td><input type="text" name="quantityItem[]" class="form-control number"/></td>'+
                        '<td><span> - </span></td>'+
                        '</tr>')

                        $( ".itemContent"+idRow ).autocomplete({
                          source: availableItems,
                          select: function( event, ui ) {
                            console.log(ui)
                            $('.contentTable .activeRow .idItem').val(ui.item.id)
                            $('.contentTable .activeRow span').text(ui.item.measurement)
                          }
                        });
                       })

                       $(document).on('click', '.addCoverRow', function(){

                        $('.coverTable tbody tr').removeClass('activeRow')

let idRow = $('.tableCover tbody tr').length +1;
$('.coverTable').append('<tr class="activeRow">'+
'<td><input type="hidden" class="idItem" name="idItemCover[]"/> <input type="text" class="form-control itemCover'+idRow+'" /></td>'+
'<td><input type="text" name="quantityItemCover[]" class="form-control number" /></td>'+
'<td><input type="text" name="excessItemCover[]" class="form-control number" value="0.0"/></td>'+
'<td><span> - </span></td>'+
'</tr>')

$( ".itemCover"+idRow ).autocomplete({
 source: availableItems,
 select: function( event, ui ) {
   console.log(ui)
   $('.coverTable .activeRow .idItem').val(ui.item.id)
   $('.coverTable .activeRow span').text(ui.item.measurement)
 }
});
})
                    </script>
                    @stop