@extends('layouts.admin2')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-9 pt-2">
                        <h5 class="m-0 font-weight-bold text-primary">Bitácora</h5>
                    </div>
                    <div class="col-sm-3 pt-2">
                        <input type="date" max="{{ date('d/m/Y') }}" onchange="sendDate(event)" class="date form-control">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Actualizar Orden</h5>
            </div>
            <div class="modal-body">
                <h5>¿Desea cambiar el estatus de la order?</h5>
                <p><b>Estatus actual:</b> {{ ucfirst($departure->status) }}</p>
                <p><b>Siguiente estatus:</b> Finalizada</p>
            </div>
            <div class="modal-footer">
                <a href="{{ url('ordenes-de-fabricacion') }}" class="btn btn-secondary">No</a>
                <form method="post" action="{{ route('ordenes-de-fabricacion.update', $departure->id) }}">
                    @method('PATCH')
                    @csrf
                    <button type="submit" class="btn btn-primary">Sí</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<script>
    $('#exampleModal').modal({
        backdrop: 'static',
        keyboard: false
    });
</script>
@endsection