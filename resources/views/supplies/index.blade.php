@extends('layouts.admin2')

@section('styles')
<style>
  .dropdown-menu li {
    width: 100%;
    margin: 8px auto;

  }

  .dropdown-menu li a {
    text-decoration: none;
    padding: 5px;
    margin: 10px auto;
    color: #000;
  }

  .dropdown-menu li a:hover {
    color: rgb(13.9%, 13.7%, 83.9%);
  }

  .dropdown-submenu {
    position: relative;
  }

  .dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
  }
</style>
@endsection

@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-8 pt-2">
            <h5 class="m-0 font-weight-bold text-primary">Insumos</h5>
          </div>
          <!--<div class="col-sm-2 pt-2">
          <div class="dropdown">
              <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Exportar Stock
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                <a href="{{ url('exportar/insumos-stock?type=1') }}" target="_blank" class="dropdown-item">Stock (Kilos)</a>
                <a href="{{ url('exportar/insumos-stock?type=2') }}" target="_blank" class="dropdown-item">Stock (Piezas)</a>
              </div>
            </div>
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
          </div>-->
          <div class="col-sm-2 pt-2">
            <div class="dropdown">
              <button class="btn btn-primary btn-block dropdown-toggle" type="button" data-toggle="dropdown">Reportes
                <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <!-- Export Stock List-->
                <li class="dropdown-submenu">
                  <a class="test" tabindex="-1" href="#">Exportar Stock<span class="caret text-dark"></span></a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="{{ url('exportar/insumos-stock?type=1') }}" target="_blank" class="dropdown-item">Stock (Kilos)</a>
                    </li>
                    <li>
                      <a href="{{ url('exportar/insumos-stock?type=2') }}" target="_blank" class="dropdown-item">Stock (Piezas)</a>
                    </li>
                  </ul>
                </li>
                <!-- Export CSV List-->
                <li class="dropdown-submenu">
                  <a class="test" tabindex="-1" href="#">Exportar CSV<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li>
                    <a href="{{ url('exportar/insumos?type=1') }}" target="_blank" class="dropdown-item">Inventario de Materias Primas</a>
                    </li>
                    <li>
                    <a href="{{ url('exportar/insumos?type=2') }}" target="_blank" class="dropdown-item">Inventario de Materiales</a>
                    </li>
                  </ul>
                </li>
                <!-- Export Logbook List-->
                <li class="dropdown-submenu">
                  <a class="test" tabindex="-1" href="#">Bitacora de Descarga<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li>
                    <a href="{{ url('exportar/bitacora-de-descargas') }}" target="_blank" class="dropdown-item">Bitacora de Descarga (Kilos)</a>
                    </li>
                    <li>
                    <a href="{{ url('exportar/bitacora-de-descargas-materiales') }}" target="_blank" class="dropdown-item">Bitacora de Descarga (Piezas)</a>
                    </li>
                  </ul>
                </li>
                <!-- Export Cuarenteen List-->
                <li class="dropdown-submenu">
                  <a class="test" tabindex="-1" href="#">Exportar Cuarentena<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li>
                    <a href="{{ url('exportar/cuarentena?type=1') }}" target="_blank" class="dropdown-item">Cuarentena (Kilos)</a>
                    </li>
                    <li>
                    <a href="{{ url('exportar/cuarentena?type=2') }}" target="_blank" class="dropdown-item">Cuarentena (Piezas)</a>
                    </li>
                  </ul>
                </li>
                <!--<li class="dropdown-submenu">
                  <a class="test" tabindex="-1" href="#">New dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
                    <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
                    <li class="dropdown-submenu">
                      <a class="test" href="#">Another dropdown <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">3rd level dropdown</a></li>
                        <li><a href="#">3rd level dropdown</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>-->
              </ul>
            </div>
          </div>
          <div class="col-sm-2 pt-2">
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

    $('.dropdown-submenu a.test').on("click", function(e) {
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });
  });
</script>
@stop