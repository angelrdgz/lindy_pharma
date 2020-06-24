@extends('layouts.admin2')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <form method="post" action="{{ url('inventario-productos/'.$package->id) }}">
                @method('PUT')
                @csrf
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <h5 class="m-0 font-weight-bold text-primary">Detalle de Inventario</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Receta</label>
                            <input type="text" class="form-control" readonly value="{{ $package->product->code.' - '.$package->product->name}}">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cantidad</label>
                            <input type="text" name="quantity" readonly value="{{ $package->quantity }}" class="form-control number">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cantidad Real</label>
                            <input type="text" name="quantity_real" {{ Auth::user()->role_id == 3 ? "":"readonly"}} value="{{ $package->quantity_real }}" class="form-control number">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cantidad Disponible</label>
                            <input type="text" name="" readonly value="{{ $package->available_quantity }}" class="form-control number">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Fecha de Caducidad</label>
                            <input type="date" name="expired_date" {{ Auth::user()->role_id == 3 ? "":"readonly"}} value="{{ $package->date_expire }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            @if(Auth::user()->role_id == 3)
                            <label for="">Estatus de Producción</label>
                            <select name="production_status" id="" class="form-control">
                                <option value="" {{$package->production_status == NULL ? 'selected':''}}>Seleccionar Estatus</option>
                                <option value="Incompleta" {{$package->production_status == "Incompleta" ? 'selected':''}}>Incompleta</option>
                                <option value="Completa" {{$package->production_status == "Completa" ? 'selected':''}}>Completa</option>
                            </select>
                            <input type="hidden" name="quality_status" value="{{$package->quality_status}}">
                            @else
                            <label for="">Estatus de Calidad</label>
                            <select name="quality_status" id="" class="form-control">
                                <option value="" {{$package->quality_status == NULL ? 'selected':''}}>Seleccionar Estatus</option>
                                <option value="Aprobado" {{$package->quality_status == "Aprobado" ? 'selected':''}}>Aprobado</option>
                                <option value="Rechazado" {{$package->quality_status == "Rechazado" ? 'selected':''}}>Rechazado</option>
                            </select>
                            <input type="hidden" name="production_status" value="{{$package->production_status}}">
                            @endif
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cliente</label>
                            <input type="text" readonly value="{{ $package->client->name }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Lote</label>
                            <input type="text" name="lot" readonly value="{{ $package->lot }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Linea</label>
                            <input type="text" name="line" readonly value="{{ $package->line }}" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3 offset-sm-3">
                            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                        </div>
                        <div class="col-sm-3 ">
                            <a href="{{ url('productos') }}" class="btn btn-secondary btn-block">Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection