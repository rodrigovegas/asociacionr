@extends('adminlte::page')

@section('title', 'Detalle de Comunidad')

@section('content_header')
    <h1>Detalle de la Comunidad</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4><strong>Nombre:</strong> {{ $comunidad->nombre }}</h4>

            <p><strong>Descripción:</strong> {{ $comunidad->descripcion ?? '—' }}</p>

            <p>
                <strong>Estado:</strong>
                @if ($comunidad->estado === 'activo')
                    <span class="badge bg-success">Activo</span>
                @else
                    <span class="badge bg-secondary">Inactivo</span>
                @endif
            </p>

            <p><strong>Coordenadas:</strong> {{ $comunidad->latitud ?? '-' }}, {{ $comunidad->longitud ?? '-' }}</p>

            <div id="map" style="height: 300px; margin-bottom: 20px;"></div>

            <p><strong>Creado por:</strong> {{ $comunidad->creador->name ?? '-' }}</p>
            <p><strong>Fecha de creación:</strong> {{ $comunidad->created_at?->format('d/m/Y H:i') ?? '-' }}</p>

            <p><strong>Actualizado por:</strong>
                @if ($comunidad->updated_at && $comunidad->updated_at->ne($comunidad->created_at))
                    {{ $comunidad->editor->name ?? '-' }}
                @else
                    -
                @endif
            </p>
            <p><strong>Última actualización:</strong>
                @if ($comunidad->updated_at && $comunidad->updated_at->ne($comunidad->created_at))
                    {{ $comunidad->updated_at->format('d/m/Y H:i') }}
                @else
                    -
                @endif
            </p>

            <a href="{{ route('comunidades.index') }}" class="btn btn-secondary mt-2">← Volver</a>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
        const lat = {{ $comunidad->latitud ?? -21.5355 }};
        const lng = {{ $comunidad->longitud ?? -64.7296 }};

        const map = L.map('map').setView([lat, lng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        if (lat && lng) {
            L.marker([lat, lng]).addTo(map).bindPopup("Ubicación seleccionada").openPopup();
        }
    </script>
@endsection
