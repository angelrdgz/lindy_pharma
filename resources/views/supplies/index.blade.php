@extends('layouts.admin2')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-8 pt-2">
            <h5 class="m-0 font-weight-bold text-primary">Insumos</h5>
          </div>
          <div class="col-sm-2">
            @if(Auth::user()->role_id !== 3)
            <a href="{{ url('insumos/create') }}" class="btn btn-link">
              <i class="fas fa-plus"></i>
              Nuevo Insumo
            </a>
            @endif
          </div>
          <div class="col-sm-2 pt-2">
            <a href="{{ url('exportar/insumos') }}" target="_blank" class="btn btn-primary btn-block">Exportar CSV</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Medida de Uso</th>
                <th>Medida de Compra</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($supplies as $supply)
              <tr>
                <td>{{ $supply->code }}</td>
                <td>{{ $supply->name }}</td>
                <td>{{ $supply->type->name }} ({{ $supply->type->code }})</td>
                <td>{{ $supply->measurementUse->name }}</td>
                <td>{{ $supply->measurementBuy->name }}</td>
                <td>
                  <a href="{{ url('insumos/'.$supply->id.'/edit')}}" class="btn btn-warning btn-icon-split">
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