@extends('layouts.admin2')

@section('content')
<div class="row">
  <div class="col-sm-12">
  <div class="card shadow mb-4">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-10 pt-2">
                <h5 class="m-0 font-weight-bold text-primary">Ordenes de Fabricación</h5>
                </div>
                <div class="col-sm-2">
                  <a href="{{ url('ordenes-de-fabricacion/create') }}" class="btn btn-link">
                  <i class="fas fa-plus"></i>
                  Nueva Orden
                </a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th>Producto</th>
                    <th>Tamaño del Lote</th>
                    <th>Cliente</th>
                    <th>Creado Por</th> 
                    <th>Tipo</th>     
      <th>Estatus</th>
      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($orders as $order)
    <tr>
      <td>{{ $order->product->name }}</td>
      <td>{{ $order->quantity }}</td>      
      <td>{{ $order->client }}</td>
      <td>{{ $order->user->name }}</td>
      <td>{{ $order->type == 1 ? "Contenido":"Covertura"}}</td>
      <td>{{ $order->status }}</td>
      <td>
      <a href="{{ url('ordenes-de-fabricacion/'.$order->id.'/edit')}}" class="btn btn-warning btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-pencil-alt"></i>
                    </span>
                    <span class="text">Modificar</span>
                  </a>
                  <a href="{{ url('ordenes-de-fabricacion/'.$order->id)}}" target="_blank" class="btn btn-info btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                    <i class="far fa-file-pdf"></i>
                    </span>
                    <span class="text">PDF</span>
                  </a>
                  <a href="{{ url('ordenes-de-fabricacion/'.$order->id)}}" class="btn btn-danger btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Cancelar</span>
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