@extends('adminlte::page')

@section('title', 'Detalle de Comunidad')

@section('content_header')
    <h1>Detalle</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $comunidad->id }}</p>
            <p><strong>Nombre:</strong> {{ $comunidad->nombre }}</p>

            <a href="{{ route('comunidades.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@endsection
