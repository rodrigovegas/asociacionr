@extends('adminlte::page')

@section('title', 'Editar Director')

@section('content_header')
    <h1>Editar Registro del Directorio</h1>
@endsection

@section('content')
    @include('directorio.partials.form', [
        'route' => route('directorio.update', $directorio),
        'method' => 'PUT',
        'directorio' => $directorio
    ])
@endsection
