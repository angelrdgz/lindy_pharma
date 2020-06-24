@extends('layouts.admin2')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-8 pt-2">
            <h5 class="m-0 font-weight-bold text-primary">Ordenes de Fabricación</h5>
          </div>
          <div class="col-sm-2">
            @if(in_array(Auth::user()->role_id, [1,2]))
            <a href="{{ url('exportar/ordenes-de-fabricacion') }}" target="_blank" class="btn btn-primary btn-block">
              <i class="fas fa-file"></i>
              Reporte Proceso
            </a>
            @endif
          </div>
          <div class="col-sm-2">
            @if(in_array(Auth::user()->role_id, [1,2]))
            <a href="{{ url('ordenes-de-fabricacion/create') }}" class="btn btn-link">
              <i class="fas fa-plus"></i>
              Nueva Orden
            </a>
            @endif
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          @if(Auth::user()->role_id == 3)
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>OT</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Cantidad Teorica</th>
                <th>Cantidad Real</th>
                <th>Lote</th>
                <th>Tipo</th>
                <th>Fecha de Caducidad</th>
                <th>Estatus</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
              <tr>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->recipe->code }}</td>
                <td>{{ $order->recipe->name }}</td>
                <td>{{ number_format($order->quantity,0) }}</td>
                <td>{{ number_format($order->quantity_real,0) }}</td>
                <td>{{ $order->lot }}</td>
                <td>
                  @if($order->type == 1)
                  Contenido de Capsula
                  @elseif($order->type == 2)
                  Envolvente de Capsula 1
                  @else
                  Envolvente de capsula 2
                  @endif
                </td>
                <td>{{ $order->expired_date == NULL ? "No definida":date("d/m/Y", strtotime($order->expired_date))}}</td>
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
                      <i class="far fa-file"></i>
                    </span>
                    <span class="text">PDF</span>
                  </a>
                  <a href="{{ url('ordenes-de-fabricacion/'.$order->id.'/revision')}}" target="_blank" class="btn btn-info btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="far fa-eye"></i>
                    </span>
                    <span class="text">Reporte</span>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Código de Producto</th>
                <th>Producto</th>
                <th>Tamaño del Lote</th>
                <th>No de Lote</th>
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
                <td>{{ $order->recipe->code }}</td>
                <td>{{ $order->recipe->name }}</td>
                <td>{{ number_format($order->quantity,0) }}</td>
                <td>{{ $order->lot }}</td>
                <td>{{ $order->client->name }}</td>
                <td>{{ $order->user->name }}</td>
                <td>
                  <?php
                  switch ($order->type) {
                    case 1:
                      echo "Mezcla de contenido";
                      break;
                    case 2:
                      echo "Pasta de gelatina";
                      break;
                    case 3:
                      echo "Pasta de gelatina 2";
                      break;

                    default:
                      # code...
                      break;
                  }
                  ?>
                </td>
                <td>{{ $order->status }}</td>
                <td>
                  <!--<a href="{{ url('ordenes-de-fabricacion/'.$order->id.'/edit')}}" class="btn btn-warning btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-pencil-alt"></i>
                    </span>
                    <span class="text">Modificar</span>
                  </a>-->
                  @if(in_array(Auth::user()->role_id, [1,2]))
                  <a href="{{ url('ordenes-de-fabricacion/'.$order->id.'/edit')}}" class="btn btn-warning btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-pencil-alt"></i>
                    </span>
                    <span class="text">Modificar</span>
                  </a>
                  @if($order->status === 'Creada')
                  <form method="post" action="{{ route('ordenes-de-fabricacion.destroy', $order->order_number) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-icon-split btn-sm">
                      <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                      </span>
                      <span class="text">Cancelar</span>
                    </button>
                  </form>
                  @endif
                  @endif
                  @if(in_array(Auth::user()->role_id, [3]))
                  <a href="{{ url('ordenes-de-fabricacion/'.$order->id.'/edit')}}" class="btn btn-warning btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="far fa-eye"></i>
                    </span>
                    <span class="text">Ver</span>
                  </a>
                  @endif
                  @if(in_array(Auth::user()->role_id, [1,2,3]))
                  <a href="{{ url('ordenes-de-fabricacion/'.$order->id)}}" target="_blank" class="btn btn-info btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="far fa-file-pdf"></i>
                    </span>
                    <span class="text">PDF</span>
                  </a>
                  @endif
                  <!--<a href="{{ url('ordenes-de-fabricacion/'.$order->id)}}" class="btn btn-danger btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Cancelar</span>
                  </a>-->
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
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