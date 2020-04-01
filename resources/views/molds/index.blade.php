@extends('layouts.admin2')

@section('content')
<div class="row">
  <div class="col-sm-12">
  <div class="card shadow mb-4">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-8 pt-2">
                <h5 class="m-0 font-weight-bold text-primary">Moldes</h5>
                </div>
                <div class="col-sm-2">
                  <a href="{{ url('moldes/create') }}" class="btn btn-link">
                  <i class="fas fa-plus"></i>
                  Nuevo Molde
                </a>
                </div>
                <div class="col-sm-2 pt-2">
                        <a href="{{ url('exportar/moldes') }}" target="_blank" class="btn btn-primary btn-block">Exportar CSV</a>
                    </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th>Código</th>
                    <th>Tipo</th>
                    <th>Largo</th>
                    <th>Ancho</th>
                    <th>Minimas</th>
                    <th>Capsulas Totales</th>   
      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($molds as $mold)
    <tr>
      <td>{{ $mold->code }}</td>
      <td>{{ $mold->type }}</td>
      <td>{{ number_format($mold->long_mm, 1) }} mm</td>
      <td>{{ number_format($mold->width_mm, 1) }} mm</td>      
      <td>{{ $mold->minimals }}</td>
      <td>{{ $mold->caps_long * $mold->caps_circ }}</td>
      <td>
      <a href="{{ url('moldes/'.$mold->id.'/edit')}}" class="btn btn-warning btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-pencil-alt"></i>
                    </span>
                    <span class="text">Modificar</span>
                  </a>
                  <a href="{{ url('moldes/'.$mold->id)}}" class="btn btn-danger btn-icon-split btn-sm">
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
  $('#dataTable').DataTable();
});
</script>
@stop