@extends('layouts.admin2')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-10 pt-2">
                        <h5 class="m-0 font-weight-bold text-primary">Ordenes de Acondicionamiento</h5>
                    </div>
                    <div class="col-sm-2">
                        @if(in_array(Auth::user()->role_id, [1]))
                        <a href="{{ url('ordenes-de-acondicionamiento/create') }}" class="btn btn-link">
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
                                <th>Código de Producto</th>
                                <th>Producto</th>
                                <th>Tamaño del Lote</th>
                                <th>No del Lote</th>
                                <th>Cliente</th>
                                <th>Estatus</th>
                                <th>Creado Por</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages as $package)
                            <tr>
                                <td>{{ $package->product->code }}</td>
                                <td>{{ $package->product->name }}</td>
                                <td>{{ number_format($package->quantity,0) }}</td>
                                <td>{{ $package->lot }}</td>
                                <td>{{ $package->client->name }}</td>
                                <td>{{ $package->status }}</td>
                                <td>{{ $package->user->name }}</td>
                                <th>
                                    @if($package->status !== "Empacado")
                                    <a href="{{ url('ordenes-de-acondicionamiento/'.$package->id.'/edit')}}" class="btn btn-warning btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pencil-alt"></i>
                                        </span>
                                        <span class="text">Modificar</span>
                                    </a>
                                    @endif
                                    <a href="{{ url('ordenes-de-acondicionamiento/'.$package->id)}}" target="_blank" class="btn btn-info btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="far fa-file"></i>
                                        </span>
                                        <span class="text">PDF</span>
                                    </a>
                                    <a href="{{ url('ordenes-de-acondicionamiento/'.$package->id.'/revision')}}" target="_blank" class="btn btn-info btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="far fa-eye"></i>
                                        </span>
                                        <span class="text">Reporte</span>
                                    </a>
                                </th>
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
                                <th>No del Lote</th>
                                <th>Cliente</th>
                                <th>Estatus</th>
                                <th>Creado Por</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages as $package)
                            <tr>
                                <td>{{ $package->product->code }}</td>
                                <td>{{ $package->product->name }}</td>
                                <td>{{ number_format($package->quantity,0) }}</td>
                                <td>{{ $package->lot }}</td>
                                <td>{{ $package->client->name }}</td>
                                <td>{{ $package->status }}</td>
                                <td>{{ $package->user->name }}</td>
                                <td>
                                    @if(in_array(Auth::user()->role_id, [1,2,3]))
                                    <a href="{{ url('ordenes-de-acondicionamiento/'.$package->id)}}" target="_blank" class="btn btn-info btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="far fa-file-pdf"></i>
                                        </span>
                                        <span class="text">PDF</span>
                                    </a>
                                    @endif
                                    @if(in_array(Auth::user()->role_id, [1,2,3]))
                                    <a href="{{ url('ordenes-de-acondicionamiento/'.$package->id.'/edit')}}" class="btn btn-warning btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pencil-alt"></i>
                                        </span>
                                        <span class="text">Modificar</span>
                                    </a>
                                    @endif
                                    @if(in_array(Auth::user()->role_id, [1,2]) && $package->status !== "Empacado")
                                    <form method="post" action="{{ route('ordenes-de-acondicionamiento.destroy', $package->id) }}">
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
        $('#dataTable').DataTable();
    });
</script>
@stop