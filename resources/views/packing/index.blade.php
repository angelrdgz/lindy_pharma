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
                        <a href="{{ url('ordenes-de-acondicionamiento/create') }}" class="btn btn-link">
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages as $package)
                            <tr>
                                <td>{{ $package->product->name }}</td>
                                <td>{{ $package->quantity }}</td>
                                <td>{{ $package->client->name }}</td>
                                <td>{{ $package->user->name }}</td>
                                <td>
                                    @if(in_array(Auth::user()->role_id, [1,2]))
                                    <a href="{{ url('ordenes-de-acondicionamiento/'.$package->id.'/edit')}}" class="btn btn-warning btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pencil-alt"></i>
                                        </span>
                                        <span class="text">Modificar</span>
                                    </a>
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