@extends('adminlte::page')

@section('title', 'Detalle del Miembro')

@section('content_header')
    <h1>Detalle del Directorio</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>Socio:</strong> {{ $directorio->socio->apellidos }} {{ $directorio->socio->nombres }}</p>
            <p><strong>Comunidad:</strong> {{ $directorio->comunidad->nombre ?? 'No asignada' }}</p>
            <p><strong>Cargo:</strong> {{ $directorio->cargo }}</p>
            <p><strong>Gestión:</strong> {{ $directorio->gestion }}</p>
            <p><strong>Periodo:</strong> {{ $directorio->periodo_inicio }} - {{ $directorio->periodo_fin }}</p>
            <p><strong>Descripción:</strong> {{ $directorio->descripcion ?? '-' }}</p>

            <p>
                <strong>Estado:</strong>
                @if ($directorio->estado === 'activo')
                    <span class="badge bg-success">Activo</span>
                @else
                    <span class="badge bg-secondary">Inactivo</span>
                @endif
            </p>

            <p><strong>Creado por:</strong> {{ $directorio->creador->name ?? '-' }}</p>
            <p><strong>Fecha de creación:</strong> {{ $directorio->created_at?->format('d/m/Y H:i') ?? '-' }}</p>

            <p><strong>Actualizado por:</strong>
                @if ($directorio->updated_at && $directorio->updated_at->ne($directorio->created_at))
                    {{ $directorio->editor->name ?? '-' }}
                @else
                    -
                @endif
            </p>

            <p><strong>Última actualización:</strong>
                @if ($directorio->updated_at && $directorio->updated_at->ne($directorio->created_at))
                    {{ $directorio->updated_at->format('d/m/Y H:i') }}
                @else
                    -
                @endif
            </p>

            <a href="{{ route('directorio.index') }}" class="btn btn-secondary mt-3">← Volver</a>
        </div>
    </div>
@endsection
