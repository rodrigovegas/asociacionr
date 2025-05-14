@extends('adminlte::page')

@section('title', 'Nuevo Director')

@section('content_header')
    <h1>Registrar Miembro del Directorio</h1>
@endsection

@section('content')
    @include('directorio.partials.form', [
        'route' => route('directorio.store'),
        'method' => 'POST',
        'directorio' => null
    ])
@endsection
