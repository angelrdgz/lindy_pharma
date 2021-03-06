@extends('layouts.admin2')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-10 pt-2">
            <h5 class="m-0 font-weight-bold text-primary">Ordenes de Compra</h5>
          </div>
          <div class="col-sm-2">
            @if(in_array(Auth::user()->role_id, [1,4]))
            <a href="{{ url('ordenes-de-compra/create') }}" class="btn btn-link">
              <i class="fas fa-plus"></i>
              Nueva Orden
            </a>
            @endif
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bentranceed" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No de Orden</th>
                <th>Creado Por</th>
                <th>Fecha de creación</th>
                <th># de Insumos</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($entrances as $entrance)
              <tr>
                <td>#{{ $entrance->id }}</td>
                <td>{{ $entrance->user->name }}</td>
                <td>{{ date('d/m/Y', strtotime($entrance->created_at))}}</td>
                <td>{{ count($entrance->items) }}</td>
                <td>
                  @if(Auth::user()->role_id == 4)
                  <a href="{{ url('ordenes-de-compra/'.$entrance->id.'/edit')}}" class="btn btn-warning btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-pencil-alt"></i>
                    </span>
                    <span class="text">Modificar</span>
                  </a>
                  <a href="{{ url('ordenes-de-compra/'.$entrance->id)}}" target="_blank" class="btn btn-info btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-file-pdf"></i>
                    </span>
                    <span class="text">PDF</span>
                  </a>
                  @endif
                  @if(Auth::user()->role_id == 1)
                  <a href="{{ url('ordenes-de-compra/'.$entrance->id)}}" target="_blank" class="btn btn-info btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-file-pdf"></i>
                    </span>
                    <span class="text">PDF</span>
                  </a>
                  @endif
                  @if(Auth::user()->role_id == 3)
                  <a href="{{ url('ordenes-de-compra/'.$entrance->id)}}" class="btn btn-info btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-search"></i>
                    </span>
                    <span class="text">Revisar</span>
                  </a>
                  @endif
                  @if(in_array(Auth::user()->role_id, [1,2]))
                  <a href="{{ url('ordenes-de-compra/'.$entrance->id.'/edit')}}" class="btn btn-warning btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-pencil-alt"></i>
                    </span>
                    <span class="text">Modificar</span>
                  </a>
                  @endif
                  @if(in_array(Auth::user()->role_id, [1, 4]))
                  <form method="post" action="{{ route('ordenes-de-compra.destroy', $entrance->id) }}">
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