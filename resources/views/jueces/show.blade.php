@extends('adminlte::page')

@section('title', 'Detalle del Juez')

@section('content_header')
    <h1>Detalle del Juez</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <p><strong>Socio:</strong> {{ $juez->socio->apellidos }} {{ $juez->socio->nombres }}</p>
        <p><strong>Canal:</strong> {{ $juez->canal->nombre }} ({{ $juez->canal->comunidad->nombre ?? '-' }})</p>
        <p><strong>Gestión:</strong> {{ $juez->gestion }}</p>
        <p><strong>Descripción:</strong> {{ $juez->descripcion ?? '-' }}</p>

        <p>
            <strong>Estado:</strong>
            @if ($juez->estado === 'activo')
                <span class="badge bg-success">Activo</span>
            @else
                <span class="badge bg-secondary">Inactivo</span>
            @endif
        </p>

        <p><strong>Creado por:</strong> {{ $juez->creador->name ?? '-' }}</p>
        <p><strong>Fecha de creación:</strong> {{ $juez->created_at?->format('d/m/Y H:i') ?? '-' }}</p>

        <p><strong>Actualizado por:</strong>
            @if ($juez->updated_at && $juez->updated_at->ne($juez->created_at))
                {{ $juez->editor->name ?? '-' }}
            @else
                -
            @endif
        </p>

        <p><strong>Última actualización:</strong>
            @if ($juez->updated_at && $juez->updated_at->ne($juez->created_at))
                {{ $juez->updated_at->format('d/m/Y H:i') }}
            @else
                -
            @endif
        </p>

        <a href="{{ route('jueces.index') }}" class="btn btn-secondary mt-2">← Volver</a>
    </div>
</div>
@endsection
