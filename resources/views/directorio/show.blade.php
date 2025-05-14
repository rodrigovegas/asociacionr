@extends('adminlte::page')

@section('title', 'Detalle del Miembro')

@section('content_header')
    <h1>Detalle del Directorio</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <p><strong>Socio:</strong> {{ $directorio->socio->nombres }} {{ $directorio->socio->apellidos }}</p>
        <p><strong>Comunidad:</strong> {{ $directorio->comunidad->nombre ?? 'No asignada' }}</p>
        <p><strong>Cargo:</strong> {{ $directorio->cargo }}</p>
        <p><strong>Gestión:</strong> {{ $directorio->gestion }}</p>
        <p><strong>Periodo:</strong> {{ $directorio->periodo_inicio }} - {{ $directorio->periodo_fin }}</p>
        <p><strong>Descripción:</strong> {{ $directorio->descripcion }}</p>

        <a href="{{ route('directorio.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
