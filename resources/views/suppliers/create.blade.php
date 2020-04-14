@extends('layouts.admin2')

@section('content')

<div class="row">
  <div class="col-sm-12">
  <div class="card shadow mb-4">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-12 pt-2">
                <h5 class="m-0 font-weight-bold text-primary">Nuevo Proveedor</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
            <form method="post" action="{{ url('proveedores') }}">
            @csrf
            <div class="row">
            <div class="col-sm-4">
                            <label for="">Nombre</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Contacto</label>
                            <input type="text" name="contact" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Dirección</label>
                            <input type="text" name="address" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Colonia</label>
                            <input type="text" name="neight" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Municipio</label>
                            <input type="text" name="city" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Estado</label>
                            <input type="text" name="state" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Código Postal</label>
                            <input type="text" name="zip" class="form-control number">
                        </div>
                        <div class="col-sm-4">
                            <label for="">RFC</label>
                            <input type="text" name="rfc" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Teléfono</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>            
            </div>
            <br>
  <div class="row">
    <div class="col-sm-3 offset-sm-3">
      <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    </div>
    <div class="col-sm-3 ">
      <a href="{{ url('proveedores') }}" class="btn btn-secondary btn-block">Cancelar</a>
    </div>
  </div>
</form>
            </div>
          </div>
  </div>
</div>


                    @stop