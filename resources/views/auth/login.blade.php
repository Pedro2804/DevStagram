@extends('layouts.app')

@section('titulo')
    Iniciar sesión
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{asset('img/login.jpg')}}" alt="Login de usuarios">
        </div>
        <div class="md:w-4/12 bg-white p-6 m-6 rounded-lg shadow-xl">
            <form action="{{route('login')}}" method="POST" novalidate>
                @csrf

                @if (session('Mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{session('Mensaje')}}
                    </p>
                @endif
                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="email"> Correo electrónico </label>
                    <input id="email" name="email" type="email"  placeholder="Ingresa un correo de registro"
                           class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                           value="{{old('email')}}" />
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="password"> Contraseña </label>
                    <input id="password" name="password" type="password"  placeholder="Ingresa una contraseña"
                           class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror" />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" class="text-gray-500 text-sm">Mantener sesión abierta</label>
                </div>
                <input 
                    type="submit"
                    value="Iniciar Sesión"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pinter uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection