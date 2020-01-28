@extends('layouts.admin2')

@section('content')
<div class="row">
  <div class="col-sm-12">
  <div class="card shadow mb-4">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-10 pt-2">
                <h5 class="m-0 font-weight-bold text-primary">Recetas</h5>
                </div>
                <div class="col-sm-2">
                  <a href="{{ url('recetas/create') }}" class="btn btn-link">
                  <i class="fas fa-plus"></i>
                  Nueva Receta
                </a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th>Nombre</th>      
      <th>Creado Por</th>
      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($recipes as $recipe)
    <tr>
      <td>{{ $recipe->code }}</td>
      <td>{{ $recipe->name }}</td>      
      <td>{{ $recipe->type->name }} ({{ $recipe->type->code }})</td>
      <td>{{ $recipe->measurementUse->name }}</td>
      <td>{{ $recipe->measurementBuy->name }}</td>
      <td>
      <a href="{{ url('insumos/'.$recipe->id.'/edit')}}" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-pencil-alt"></i>
                    </span>
                    <span class="text">Modificar</span>
                  </a>
      </td>
    </tr>
    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
  </div>
</div>
@stop

@section('script')
<script>
  $(document).ready(function() {
  $('#dataTable').DataTable({
    language: {
        search: "Buscar:",
        lengthMenu:    "Mostrar _MENU_ elementos",
        info:           "Mostrando _START_ a _END_ de _TOTAL_ elementos",
        zeroRecords:    "No se encontraron coincidencias",
        emptyTable:     "Aun no hay registros",
        paginate: {
            first:      "Inicio",
            previous:   "Anterior",
            next:       "Siguiente",
            last:       "Ultimo"
        },
    }
  });
});
</script>
@stop