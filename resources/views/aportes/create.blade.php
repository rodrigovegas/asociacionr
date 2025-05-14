@extends('adminlte::page')

@section('title', 'Nuevo Aporte')

@section('content_header')
    <h1>Registrar Aporte</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('aportes.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nombre del Aporte</label>
                <input type="text" name="nombre" class="form-control" required value="{{ old('nombre') }}">
            </div>

            <div class="form-group mt-2">
                <label>Aplicar a:</label>
                <select name="tipo_aporte" class="form-control" required onchange="toggleCanalSelect(this.value)">
                    <option value="">Seleccione</option>
                    <option value="general" {{ old('tipo_aporte') == 'general' ? 'selected' : '' }}>Todos los socios</option>
                    <option value="canal" {{ old('tipo_aporte') == 'canal' ? 'selected' : '' }}>Por canal</option>
                    <option value="jueces" {{ old('tipo_aporte') == 'jueces' ? 'selected' : '' }}>Solo jueces</option>
                    <option value="directorio" {{ old('tipo_aporte') == 'directorio' ? 'selected' : '' }}>Solo directorio</option>
                </select>
            </div>

            <div class="form-group mt-2" id="canalSelect" style="display: none;">
                <label>Canal</label>
                <select name="canal_id" class="form-control">
                    <option value="">Seleccione canal</option>
                    @foreach($canales as $canal)
                        <option value="{{ $canal->id }}" {{ old('canal_id') == $canal->id ? 'selected' : '' }}>
                            {{ $canal->nombre }} ({{ $canal->comunidad->nombre }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-2">
                <label>Monto por hectárea (Bs)</label>
                <input type="number" name="monto_por_hectarea" class="form-control" step="0.01" min="0"
                       value="{{ old('monto_por_hectarea') }}" required>
            </div>

            <div class="form-check mt-2">
                <input type="hidden" name="usar_superficie_riego" value="0">
                <input type="checkbox" name="usar_superficie_riego" value="1" class="form-check-input"
                       id="usarRiego" {{ old('usar_superficie_riego', true) ? 'checked' : '' }}>
                <label for="usarRiego" class="form-check-label">Calcular según superficie de riego</label>
            </div>

            <div class="form-group mt-2">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success mt-3">Guardar</button>
            <a href="{{ route('aportes.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    function toggleCanalSelect(tipo) {
        const canalDiv = document.getElementById('canalSelect');
        canalDiv.style.display = (tipo === 'canal') ? 'block' : 'none';
    }

    // Ejecutar al cargar (por si viene con old)
    document.addEventListener('DOMContentLoaded', function () {
        toggleCanalSelect(document.querySelector('[name="tipo_aporte"]').value);
    });
</script>
@endsection
