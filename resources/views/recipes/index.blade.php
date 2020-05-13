@extends('layouts.admin2')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-8 pt-2">
            <h5 class="m-0 font-weight-bold text-primary">Recetas</h5>
          </div>
          <div class="col-sm-2">
            <a href="{{ url('exportar/recetas') }}" class="btn btn-primary btn-block">
              <i class="far fa-file-excel"></i>
              Reporte Stock
            </a>
          </div>
          <div class="col-sm-2">
            <a href="{{ url('recetas/create') }}" class="btn btn-link">
              <i class="fas fa-plus"></i>
              Nuevo Receta
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($recipes as $recipe)
              <tr>
                <td>{{ $recipe->id }}</td>
                <td>{{ $recipe->code }}</td>
                <td>{{ $recipe->name }}</td>
                <td>{{ $recipe->stock }}</td>
                <td>
                  <a href="{{ url('recetas/'.$recipe->id.'/edit')}}" class="btn btn-warning btn-icon-split">
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
        lengthMenu: "Mostrar _MENU_ elementos",
        info: "Mostrando _START_ a _END_ de _TOTAL_ elementos",
        zeroRecords: "No se encontraron coincidencias",
        emptyTable: "Aun no hay registros",
        paginate: {
          first: "Inicio",
          previous: "Anterior",
          next: "Siguiente",
          last: "Ultimo"
        },
      }
    });
  });
</script>
@stop