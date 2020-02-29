@extends('layouts.admin2')

@section('content')
<div class="row">
  <div class="col-sm-12">
  <div class="card shadow mb-4">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-10 pt-2">
                <h5 class="m-0 font-weight-bold text-primary">Usuarios</h5>
                </div>
                <div class="col-sm-2">
                  <a href="{{ url('usuarios/create') }}" class="btn btn-link">
                  <i class="fas fa-plus"></i>
                  Nuevo usuario
                </a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th class="px-4 py-2">Nombre</th>
      <th class="px-4 py-2">Email</th>
      <th class="px-4 py-2">Role</th>
      <th class="px-4 py-2"></th>
                    </tr>
                  </thead>
                  <!--<tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Age</th>
                      <th>Start date</th>
                      <th>Salary</th>
                    </tr>
                  </tfoot>-->
                  <tbody>
                  @foreach($users as $user)
    <tr>
      <td class="border px-4 py-2">{{ $user->name }}</td>
      <td class="border px-4 py-2">{{ $user->email }}</td>
      <td class="border px-4 py-2">{{ $user->role->name }}</td>
      <td class="border px-4 py-2">
      <a href="{{ url('usuarios/'.$user->id.'/edit')}}" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-pencil-alt"></i>
                    </span>
                    <span class="text">Modificar</span>
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
<!--<div class="flex mb-4 shadow text-white">
  <div class="w-4/6 bg-blue-800 h-12 p-2 ">
  <h3 class="font-bold  pl-2">Usuarios</h3></div>
  <div class="w-2/6 bg-blue-800 text-right h-12 p-2">
  <a href="{{ url('/usuarios/create') }}" class="text-md">Nuevo Usuario</a>
</div>
</div>

            <div class="flex flex-wrap">
                <div class="w-full md:w-1/1 xl:w-1/1 p-6">
                <table class="table-auto" style="width: 100%;">
  <thead>
    <tr>
      <th class="px-4 py-2">Nombre</th>
      <th class="px-4 py-2">Email</th>
      <th class="px-4 py-2">Role</th>
      <th class="px-4 py-2"></th>
    </tr>
  </thead>
  <tbody>
      @foreach($users as $user)
    <tr>
      <td class="border px-4 py-2">{{ $user->name }}</td>
      <td class="border px-4 py-2">{{ $user->email }}</td>
      <td class="border px-4 py-2">{{ $user->role->name }}</td>
      <td class="border px-4 py-2"></td>
    </tr>
    @endforeach
  </tbody>
</table>
                </div>
            </div>


            <div class="flex flex-row flex-wrap flex-grow mt-2">
            </div>-->
@stop

@section('script')
<script>
  $(document).ready(function() {
  $('#dataTable').DataTable();
});
</script>
@stop