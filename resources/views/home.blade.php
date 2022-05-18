@extends('layouts.app')
@section('titulo')
    Principal
@endsection
@section('contenido')
    {{-- <x-listar-post>
        <x-slot:titulo>
            <header>Esto es un header</header>
        </x-slot:titulo>
        <h1>Mostrando post desde slot</h1>
    </x-listar-post> --}}
    {{-- x-nombre identifica a algo como un componente en laravel --}}
    <x-listar-post :posts="$posts" />
@endsection
