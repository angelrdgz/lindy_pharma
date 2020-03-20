@extends('layouts.admin2')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-7 pt-2">
                        <h5 class="m-0 font-weight-bold text-primary">Bitácora</h5>
                    </div>
                    <div class="col-sm-3 pt-2">
                        <input type="date" max="{{ date('d/m/Y') }}" onchange="sendDate(event)" class="date form-control">
                    </div>
                    <div class="col-sm-2 pt-2">
                        <a href="{{ url('exportar/bitacora') }}" target="_blank" class="btn btn-primary btn-block">Exportar CSV</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    

                        @if(count($logbooks) == 0)
                        <h1 class="text-center">Bitacora Vacia</h1>
                        @else
                        <div class="main-timeline">
                        <?php $i = 1;?>
                        @foreach($logbooks as $logbook)
                        <div class="timeline time-{{$logbook->type->name}}">
                            <div class="row">
                                @if($i % 2 == 0)
                                <div class="col-sm-5 offset-sm-1">
                                    <div class="content">
                                        <h3 class="title">{{ $logbook->title }}</h3>
                                        <p class="description">
                                            {{ $logbook->content }}
                                        </p>
                                        <br>
                                        <p>
                                            <b>Responsable: </b> {{ $logbook->user->name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-6 d-flex justify-content-around">
                                    <span class="timeline-year align-self-center">{{ date('H:i:s', strtotime($logbook->created_at) )}}</span>
                                    <div class="timeline-icon align-self-center">
                                        <i class="{{ $logbook->icon }}" aria-hidden="true"></i>
                                    </div>
                                </div>
                                @else
                                <div class="col-sm-6 d-flex justify-content-around">
                                    <div class="timeline-icon align-self-center">
                                        <i class="{{ $logbook->icon }}" aria-hidden="true"></i>
                                    </div>
                                    <span class="timeline-year align-self-center">{{ date('H:i:s', strtotime($logbook->created_at) )}}</span>

                                </div>
                                <div class="col-sm-6">
                                    <div class="content">
                                        <h3 class="title">{{ $logbook->title }}</h3>
                                        <p class="description">
                                            {{ $logbook->content }}
                                        </p>
                                        <br>
                                        <p>
                                            <b>Responsable: </b> {{ $logbook->user->name }}
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <?php $i++; ?>
                        </div>
                        @endforeach
                        </div>
                        @endif                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function sendDate(e){
        window.location.href = "{{ url('bitacora') }}?date="+e.target.value;
    }
</script>
@endsection