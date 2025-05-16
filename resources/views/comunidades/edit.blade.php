@extends('adminlte::page')

@section('title', 'Editar Comunidad')

@section('content_header')
    <h1>Editar Comunidad</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('comunidades.update', $comunidad) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $comunidad->nombre }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3">{{ $comunidad->descripcion }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="map">Ubicación (clic para ajustar coordenadas)</label>
                    <div id="map" style="height: 300px;"></div>
                    <input type="hidden" name="latitud" id="latitud" value="{{ $comunidad->latitud }}">
                    <input type="hidden" name="longitud" id="longitud" value="{{ $comunidad->longitud }}">
                </div>

                <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
                <a href="{{ route('comunidades.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([
            {{ $comunidad->latitud ?? '-21.5355' }},
            {{ $comunidad->longitud ?? '-64.7296' }}
        ], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let marker = L.marker([
            {{ $comunidad->latitud ?? '-21.5355' }},
            {{ $comunidad->longitud ?? '-64.7296' }}
        ]).addTo(map);

        map.on('click', function(e) {
            const {
                lat,
                lng
            } = e.latlng;
            document.getElementById('latitud').value = lat.toFixed(7);
            document.getElementById('longitud').value = lng.toFixed(7);
            marker.setLatLng(e.latlng);
        });
    </script>
@endsection
