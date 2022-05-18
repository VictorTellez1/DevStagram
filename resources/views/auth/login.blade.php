@extends('layouts.app')
@section('titulo')
    Inicia sesion en DevStagram
@endsection
@section('contenido')
    <div class="md:flex md:justify-center md:gap-10">
        <div class="md:w-6/12">
            <img class="fluid" src="{{asset('img/login.jpg')}}" alt="Imagen login">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-md">
            <form action="{{route('login')}}" method="POST">
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{session('mensaje')}}</p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="text"
                        placeholder="Tu email de usuario"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500
                        @enderror"
                        value="{{old('email')}}"
                    />
                </div>
                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Tu password"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500
                        @enderror"
                    />
                </div>
                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror

            <div class="mb-5">
                <input class="ml-5" type="checkbox" name="remember"> <label for="password" class=" text-sm uppercase text-gray-500 font-bold">Matener mi sesión abiera</label></input>
            </div>
                <input
                    type="submit"
                    value="Iniciar Sesion"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                    uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>
@endsection
