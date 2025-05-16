<form action="{{ $route }}" method="POST">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="form-group mb-3">
        <label for="socio_id">Socio (Juez)</label>
        <select name="socio_id" class="form-control" required>
            <option value="">Seleccione un socio</option>
            @foreach ($socios as $socio)
                <option value="{{ $socio->id }}"
                    {{ old('socio_id', $juez->socio_id ?? '') == $socio->id ? 'selected' : '' }}>
                    {{ $socio->apellidos }} {{ $socio->nombres }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="canal_id">Canal</label>
        <select name="canal_id" class="form-control" required>
            <option value="">Seleccione un canal</option>
            @foreach ($canales as $canal)
                <option value="{{ $canal->id }}"
                    {{ old('canal_id', $juez->canal_id ?? '') == $canal->id ? 'selected' : '' }}>
                    {{ $canal->nombre }} ({{ $canal->comunidad->nombre }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="gestion">Gestión</label>
        <input type="text" name="gestion" class="form-control" value="{{ old('gestion', $juez->gestion ?? '') }}"
            required>
    </div>

    <div class="form-group mb-3">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $juez->descripcion ?? '') }}</textarea>
    </div>

    <button class="btn btn-success mt-2">Guardar</button>
    <a href="{{ route('jueces.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
</form>
