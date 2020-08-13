@extends('layouts.admin2')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-10 pt-2">
            <h5 class="m-0 font-weight-bold text-primary">Inventario</h5>
          </div>
          <div class="col-sm-2">
            <a href="{{ url('exportar/productos') }}" class="btn btn-primary btn-block">
              <i class="far fa-file-excel"></i>
              Reporte Stock
            </a>
          </div>
          <div class="col-sm-2">
           
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No de Orden</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Lote</th>
                <th>Tamaño de Lote</th>
                <th>Cantidad Real</th>
                <th>Cantidad Disponible</th>
                <th>Fecha de Caducidad</th>
                <th>Estatus de Producción</th>
                <th>Estatus de Calidad</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            @foreach($packages as $package)
              <tr>
                <td>{{ $package->id }}</td>
                <td>{{ $package->product->code }}</td>
                <td>{{ $package->product->name }}</td>
                <td>{{ $package->lot }}</td>
                <td>{{ number_format($package->quantity,0) }}</td>
                <td>{{ number_format($package->quantity_real,0) }}</td>
                <td>{{ number_format($package->available_quantity,0) }}</td>
                <td>{{ $package->date_expire == NULL ? "No definida":date("d/m/Y", strtotime($package->date_expire))}}</td>
                <td>{{ $package->production_status == NULL ? "No definido":$package->production_status}}</td>
                <td>{{ $package->quality_status == NULL ? "No definido":$package->quality_status}}</td>
                <td>
                  <a href="{{ url('inventario-productos/'.$package->id)}}" class="btn btn-warning btn-icon-split btn-sm">
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