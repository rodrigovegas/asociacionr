@extends('adminlte::page')

@section('title', 'Nuevo Socio')

@section('content_header')
    <h1>Nuevo Socio</h1>
@endsection

@section('content')
    @include('socios.partials.form', ['route' => route('socios.store'), 'method' => 'POST', 'socio' => null])
@endsection
