@extends('layouts.admin2')

@section('content')

<div class="row">
  <div class="col-sm-12">
  <div class="card shadow mb-4">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-12 pt-2">
                <h5 class="m-0 font-weight-bold text-primary">Nuevo Producto</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
            <form method="post" action="{{ url('productos') }}">
            @csrf
  <div class="row">
    <div class="col-sm-3">
    <div class="form-group">
    <label for="exampleFormControlInput1">Código de Producto</label>
    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}">
    @error('code')
            <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
      @enderror 
  </div>
    </div>
    <div class="col-sm-5">
    <div class="form-group">
    <label for="exampleFormControlInput1">Nombre</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
    @error('name')
            <p class="text-red-500 text-xs text-danger italic">{{ $message }}</p>
      @enderror 
  </div>
    </div>
    
  </div>
  <hr>
  <div class="row">
    <div class="col-sm-12">
      <table class="table contentTable">
        <thead>
          <tr>
            <th colspan="2">Contenido de la Capsula</th>
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
  <hr>
  <div class="row">
    <div class="col-sm-12">
      <table class="table coverTable">
        <thead>
          <tr>
            <th colspan="2">Envolvente de la Capsula</th>
            <th>
             <a  class="btn btn-link addCoverRow">Agregar Insumo</a>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Nombre</td>
            <td>Cantidad</td>
            <td>Medida de Uso</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-3 offset-sm-3">
      <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    </div>
    <div class="col-sm-3 ">
      <a href="{{ url('productos') }}" class="btn btn-secondary btn-block">Cancelar</a>
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
                     availableItems.push({id: "{{$supply->id}}",value: "{{$supply->name}}", label: "{{$supply->name}}", measurement: "{{$supply->measurementUse->name}}"})
                    @endforeach
    
                       $(document).on('click', '.addContentRow', function(){

                        $('.contentTable tbody tr').removeClass('activeRow')

                         let idRow = $('.tableContent tbody tr').length +1;
                        $('.contentTable').append('<tr class="activeRow">'+
                        '<td><input type="hidden" class="idItem" name="idItem[]"/> <input type="text" class="form-control itemContent'+idRow+'" /></td>'+
                        '<td><input type="text" name="quantityItem[]" class="form-control number" /></td>'+
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