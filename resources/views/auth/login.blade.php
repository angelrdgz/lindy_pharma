<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lindy Pharma</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body id="login">
<div class="flex mb-4">
  <div class="w-1/2 bg-white h-12">
  <div class="w-full max-w-md">
  <form action="{{ url('/login') }}" method="post" class="bg-white rounded px-8 pt-6 pb-8 mb-6">
   @csrf
  <div class="mb-4">
      <img src="{{ asset('images/logo.jpg') }}" class="logo" alt="">
    </div>
    @if (\Session::has('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
  <strong class="font-bold">Error!</strong>
  <span class="block sm:inline">{!! \Session::get('error') !!}</span>
  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
  </span>
</div>
@endif
@if (\Session::has('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
  <span class="block sm:inline">{!! \Session::get('success') !!}</span>
  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
  </span>
</div>
@endif
    
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
        Usuario
      </label>
      <input name="email" class="shadow appearance-none border rounded @error('email') border-red-500 @enderror w-full py-2 px-3 mb-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Usuario">
      @error('email')
            <p class="text-red-500 text-xs italic">El usuario es requerido.</p>
      @enderror 
    </div>
    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
        Contraseña
      </label>
      <input name="password" class="shadow appearance-none border rounded @error('password') border-red-500 @enderror w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Contraseña">
      @error('password')
            <p class="text-red-500 text-xs italic">La contraseña es requerida.</p>
      @enderror      
    </div>
    <div class="flex items-center justify-between text-center">
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
        Iniciar
      </button>
    </div>
  </form>
  <p class="text-center text-gray-500 text-xs">
    &copy;2020 Lindy Pharma. All rights reserved.
  </p>
</div>
</div>
  <div class="w-1/2 bg-gray-300 h-12">
  <img src="{{ asset('images/chemistry.png') }}" class="chemistry" alt="">
</div>
</div>
</body>
</html>