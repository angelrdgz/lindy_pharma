@extends('layouts.admin2')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-10 pt-2">
                        <h5 class="m-0 font-weight-bold text-primary">Descargas de Granel</h5>
                    </div>
                    <div class="col-sm-2">
                        @if(in_array(Auth::user()->role_id, [1,2,6]))
                        <a href="{{ url('descargas-granel/create') }}" class="btn btn-link">
                            <i class="fas fa-plus"></i>
                            Nueva Descarga
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
                                <th>Ord. de Acondicionamiento</th>
                                <th>Lote</th>
                                <th>Creado Por</th>
                                <th>Fecha y Hora</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($decreases as $decrease)
                            <tr>
                                <td>{{ $decrease->package_id !== NULL ? "OT-".sprintf("%04s", $decrease->package_id):"Sin asignar" }}</td>
                                <td>{{ $decrease->package_id !== NULL ? $decrease->package->lot:"Sin asignar" }}</td>
                                <td>{{ $decrease->user->name }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($decrease->created_at)) }}</td>
                                <td>
                                    <a href="{{ url('descargas-granel/'.$decrease->id.'/edit')}}" class="btn btn-warning btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pencil-alt"></i>
                                        </span>
                                        <span class="text">Modificar</span>
                                    </a>
                                    <a href="{{ url('descargas-granel/'.$decrease->id)}}" target="_blank" class="btn btn-info btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-file"></i>
                                        </span>
                                        <span class="text">Reporte</span>
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