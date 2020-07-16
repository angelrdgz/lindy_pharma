@extends('layouts.admin2')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-3 pt-2">
            <h5 class="m-0 font-weight-bold text-primary">Insumos</h5>
          </div>
          <div class="col-sm-2 pt-2">
          <div class="dropdown">
              <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Exportar Stock
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                <a href="{{ url('exportar/insumos-stock?type=1') }}" target="_blank" class="dropdown-item">Stock (Kilos)</a>
                <a href="{{ url('exportar/insumos-stock?type=2') }}" target="_blank" class="dropdown-item">Stock (Piezas)</a>
              </div>
            </div>
            <!--<a href="{{ url('exportar/insumos-stock') }}" target="_blank" class="btn btn-primary btn-block">Exportar Stock</a>-->
          </div>
          <div class="col-sm-2 pt-2">
            <div class="dropdown">
              <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Exportar CSV
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a href="{{ url('exportar/insumos?type=1') }}" target="_blank" class="dropdown-item">Inventario de Materias Primas</a>
                <a href="{{ url('exportar/insumos?type=2') }}" target="_blank" class="dropdown-item">Inventario de Materiales</a>
              </div>
            </div>
          </div>
          <div class="col-sm-3 pt-2">
          @if(in_array(Auth::user()->role_id, [1,2,3]))
          <div class="dropdown">
              <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Bitacora de Descarga
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                <a href="{{ url('exportar/bitacora-de-descargas') }}" target="_blank" class="dropdown-item">Bitacora de Descarga (Kilos)</a>
                <a href="{{ url('exportar/bitacora-de-descargas-materiales') }}" target="_blank" class="dropdown-item">Bitacora de Descarga (Piezas)</a>
              </div>
            </div>
            @endif
          </div>
          <div class="col-sm-2">
            @if(Auth::user()->role_id !== 3)
            <a href="{{ url('insumos/create') }}" class="btn btn-link">
              <i class="fas fa-plus"></i>
              Nuevo Insumo
            </a>
            @endif
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