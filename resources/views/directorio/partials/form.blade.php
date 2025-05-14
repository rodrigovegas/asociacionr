<form action="{{ $route }}" method="POST">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    <div class="form-group">
        <label>Socio</label>
        <select name="socio_id" class="form-control" required>
            <option value="">Seleccione un socio</option>
            @foreach($socios as $socio)
                <option value="{{ $socio->id }}"
                    {{ old('socio_id', $directorio->socio_id ?? '') == $socio->id ? 'selected' : '' }}>
                    {{ $socio->nombres }} {{ $socio->apellidos }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mt-2">
        <label>Cargo</label>
        <div class="form-group mt-2">
            <label>Cargo</label>
            <select name="cargo" class="form-control" required>
                <option value="">Seleccione un cargo</option>
                @php
                    $cargos = [
                        'Presidente',
                        'Vice Presidente',
                        'Secretaría. De Actas',
                        'Secretaría. De Hacienda',
                        'Secretaría. De Organización',
                        'Secretaría. De Deportes y Cultura',
                        'Secretaría. De Prensa y propaganda',
                        'Secretaría. De Gestión, mercado y comercialización',
                        'Secretaría de Medio ambiente y desastres naturales',
                        'Secretaría de Género',
                        'Juez Mayor de Agua',
                        'Vocale'
                    ];
                @endphp
        
                @foreach($cargos as $cargo)
                    <option value="{{ $cargo }}"
                        {{ old('cargo', $directorio->cargo ?? '') === $cargo ? 'selected' : '' }}>
                        {{ $cargo }}
                    </option>
                @endforeach
            </select>
        </div>        
    </div>

    <div class="form-group mt-2">
        <label>Gestión</label>
        <input type="text" name="gestion" class="form-control" value="{{ old('gestion', $directorio->gestion ?? '') }}" required>
    </div>

    <div class="form-group mt-2">
        <label>Periodo Inicio</label>
        <input type="date" name="periodo_inicio" class="form-control" value="{{ old('periodo_inicio', $directorio->periodo_inicio ?? '') }}">
    </div>

    <div class="form-group mt-2">
        <label>Periodo Fin</label>
        <input type="date" name="periodo_fin" class="form-control" value="{{ old('periodo_fin', $directorio->periodo_fin ?? '') }}">
    </div>

    <div class="form-group mt-2">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control">{{ old('descripcion', $directorio->descripcion ?? '') }}</textarea>
    </div>

    <button class="btn btn-success mt-3">Guardar</button>
    <a href="{{ route('directorio.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
</form>
