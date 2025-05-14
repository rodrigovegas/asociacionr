@extends('adminlte::page')

@section('title', 'Detalle del Canal')

@section('content_header')
    <h1>Detalle del Canal</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $canal->id }}</p>
            <p><strong>Nombre:</strong> {{ $canal->nombre }}</p>
            <p><strong>Comunidad:</strong> {{ $canal->comunidad->nombre }}</p>
            <a href="{{ route('canales.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@endsection
