@extends('adminlte::page')

@section('title', 'Detalle del Juez')

@section('content_header')
    <h1>Detalle del Juez</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <p><strong>Socio:</strong> {{ $juez->socio->nombres }} {{ $juez->socio->apellidos }}</p>
        <p><strong>Canal:</strong> {{ $juez->canal->nombre }} ({{ $juez->canal->comunidad->nombre }})</p>
        <p><strong>Gestión:</strong> {{ $juez->gestion }}</p>
        <p><strong>Descripción:</strong> {{ $juez->descripcion }}</p>

        <a href="{{ route('jueces.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
