@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{route('perfil.store')}}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf

                @if (session('Mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{session('Mensaje')}}
                    </p>
                @endif

                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="username"> Username </label>
                    <input id="username" name="username" type="text"  placeholder="Ingresa tu nuevo usuario"
                           class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                           value="{{auth()->user()->username}}"/>
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="email"> Correo electrónico </label>
                    <input id="email" name="email" type="email"  placeholder="Ingresa tu nuevo correo"
                           class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                           value="{{auth()->user()->email}}"/>
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="imagen"> Foto de perfil </label>
                    <input id="imagen" name="imagen" type="file"
                           class="border p-3 w-full rounded-lg"
                           accept=".jpg, .jpeg, .png"/>
                </div>
                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="password_new"> Cambiar contraseña </label>
                    <input id="password_new" name="password_new" type="password"  placeholder="Ingresa tu nueva contraseña"
                           class="border p-3 w-full rounded-lg @error('password_new') border-red-500 @enderror" />
                    @error('password_new')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="mb-2 block uppercase text-gray-500 font-bold" for="password"> Contraseña actual </label>
                    <input id="password" name="password" type="password"  placeholder="Ingresa tu contraseña"
                           class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror" />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <input 
                    type="submit"
                    value="Guardar cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pinter uppercase font-bold w-full p-3
                    text-white rounded-lg"
                />
            </form>
        </div>
    </div>
@endsection