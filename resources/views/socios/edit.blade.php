@extends('adminlte::page')

@section('title', 'Editar Socio')

@section('content_header')
    <h1>Editar Socio</h1>
@endsection

@section('content')
    @include('socios.partials.form', [
        'route' => route('socios.update', $socio),
        'method' => 'PUT',
        'socio' => $socio
    ])
@endsection
