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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Actualizar Orden</h5>
            </div>
            <div class="modal-body">
                @switch($package->status)
                @case("Creada")
                @case("Liberado")
                <?php $newStatus = "Empacado";; ?>
                @break

                @default
                <?php $newStatus = "Nada"; ?>
                @endswitch
                <table class="table">
                    <tbody>
                        <tr>
                            <td colspan="2" class="text-center">
                                <h5>¿Desea cambiar el estatus de la order?</h5>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Estatus actual:</b></td>
                            <td>{{ ucfirst($package->status) }}</td>
                        </tr>
                        @if($package->status == "Creada" || $package->status == "Liberado")
                        <tr>
                            <td><b>Cantidad :</b></td>
                            <td><input type="text" class="form-control number listenTotal" value='{{ $package->status == "Liberado" ? $package->quantity:"0"}}'></td>
                        </tr>
                        @endif
                        <tr>
                            <td><b>Siguiente estatus:</b></td>
                            <td>{{ ucfirst($newStatus) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="{{ url('ordenes-de-acondicionamiento') }}" class="btn btn-secondary">No</a>
                <form method="post" action="{{ route('ordenes-de-acondicionamiento.update', $package->id) }}">
                    <input type="hidden" name="status" value="{{ $newStatus }}">
                    <input type="hidden" name="total" value='{{ $package->status == "Liberado" ? $package->quantity:"0"}}'>
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

    $(document).on('keyup', '.listenTotal', function(){
        $('input[name="total"]').val($(this).val())
    })
</script>
@endsection