@extends('layouts.admin2')

@section('content')
<div class="flex mb-4 shadow text-white">
  <div class="w-4/6 bg-blue-800 h-12 p-2 ">
  <h3 class="font-bold  pl-2">Nuevo Usuario</h3></div>
  <div class="w-2/6 bg-blue-800 text-right h-12 p-2">
</div>
</div>

            <div class="flex flex-wrap">
                <div class="w-full md:w-1/1 xl:w-1/1 p-6">
                  <form method="post" action="{{ url('usuarios') }}" class="w-full">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                      <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                          Nombre
                        </label>
                        <input name="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text">
                        <!--<p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
                      </div>
                      <div class="w-full md:w-1/4 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Email
                        </label>
                        <input name="email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="email">
                      </div>
                      <div class="w-full md:w-1/4 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Contraseña
                        </label>
                        <input name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="password">
                      </div>
                      <div class="w-full md:w-1/4 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                          Rol
                        </label>
                        <select name="role" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                            @foreach($roles as $rol)
                             <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="w-full md:w-1/4 px-3">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Guardar</button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>

                    @stop