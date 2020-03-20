@extends('layouts.admin2')

@section('content')
<div class="row">
  <div class="col-sm-12">
  <div class="card shadow mb-4">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-8 pt-2">
                <h5 class="m-0 font-weight-bold text-primary">Clientes</h5>
                </div>
                <div class="col-sm-2">
                  <a href="{{ url('clientes/create') }}" class="btn btn-link">
                  <i class="fas fa-plus"></i>
                  Nuevo Cliente
                </a>
                </div>
                <div class="col-sm-2 pt-2">
                        <a href="{{ url('exportar/clientes') }}" target="_blank" class="btn btn-primary btn-block">Exportar CSV</a>
                    </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th>Nombre</th>
                    <th>Contacto</th>
                    <th>Teléfono</th>
                    <th>Domicilio</th>
      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($clients as $client)
    <tr>
      <td>{{ $client->name }}</td>
      <td>{{ $client->contact }}</td>      
      <td>{{ $client->phone }}</td>
      <td>{{ $client->address }}</td>
      <td>
      <a href="{{ url('clientes/'.$client->id.'/edit')}}" class="btn btn-warning btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-pencil-alt"></i>
                    </span>
                    <span class="text">Modificar</span>
                  </a>
                  <a href="{{ url('clientes/'.$client->id)}}" class="btn btn-danger btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Eliminar</span>
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
  $('.dataTable').DataTable({
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