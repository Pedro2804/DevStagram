@extends('layouts.app')

@section('titulo')
    Página principal
@endsection

@section('contenido')
    {{-- <x-slot:titulo></x-slot:titulo> Definir nombre de un slot --}}
    <x-listar-post :posts='$posts'/>
@endsection