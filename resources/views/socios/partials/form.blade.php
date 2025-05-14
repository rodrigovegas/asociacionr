<form action="{{ $route }}" method="POST">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-6">
            <label>Nombres</label>
            <input name="nombres" class="form-control" value="{{ old('nombres', $socio->nombres ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label>Apellidos</label>
            <input name="apellidos" class="form-control" value="{{ old('apellidos', $socio->apellidos ?? '') }}" required>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-4">
            <label>CI</label>
            <input name="ci" class="form-control" value="{{ old('ci', $socio->ci ?? '') }}">
        </div>
        <div class="col-md-4">
            <label>Teléfono</label>
            <input name="telefono" class="form-control" value="{{ old('telefono', $socio->telefono ?? '') }}">
        </div>
        <div class="col-md-4">
            <label>Fecha Nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control"
                value="{{ old('fecha_nacimiento', $socio->fecha_nacimiento ?? '') }}" required>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-4">
            <label>Código de Socio</label>
            <input name="codigo_socio" class="form-control"
                value="{{ old('codigo_socio', $socio->codigo_socio ?? '') }}" required>
        </div>
        <div class="col-md-4">
            <label>Fecha de Ingreso</label>
            <input type="date" name="fecha_ingreso" class="form-control"
                value="{{ old('fecha_ingreso', $socio->fecha_ingreso ?? '') }}" required>
        </div>
        <div class="col-md-4">
            <label>Número de Turnos</label>
            <input type="number" name="numero_turnos" class="form-control"
                value="{{ old('numero_turnos', $socio->numero_turnos ?? 0) }}">
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-4">
            <label>Sistema</label>
            <input name="sistema" class="form-control" value="{{ old('sistema', $socio->sistema ?? '') }}">
        </div>
        <div class="col-md-4">
            <label>Superficie Total (ha)</label>
            <input type="number" step="0.01" name="superficie_total" class="form-control"
                value="{{ old('superficie_total', $socio->superficie_total ?? '') }}">
        </div>
        <div class="col-md-4">
            <label>Superficie Riego (ha)</label>
            <input type="number" step="0.01" name="superficie_riego" class="form-control"
                value="{{ old('superficie_riego', $socio->superficie_riego ?? '') }}">
        </div>
    </div>



    <div class="form-group mt-2">
        <label>Tipo de Ingreso</label>
        <select name="tipo_ingreso" class="form-control"
            onchange="document.getElementById('socio_origen').style.display = this.value !== 'original' ? 'block' : 'none'">
            @foreach (['original', 'transferencia', 'herencia'] as $tipo)
                <option value="{{ $tipo }}"
                    {{ old('tipo_ingreso', $socio->tipo_ingreso ?? '') === $tipo ? 'selected' : '' }}>
                    {{ ucfirst($tipo) }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group mt-2" id="socio_origen"
        style="{{ old('tipo_ingreso', $socio->tipo_ingreso ?? '') !== 'original' ? '' : 'display:none;' }}">
        <label>Socio de Origen</label>
        <select name="socio_origen_id" class="form-control">
            <option value="">Seleccione un socio</option>
            @foreach ($todosLosSocios as $s)
                <option value="{{ $s->id }}"
                    {{ old('socio_origen_id', $socio->socio_origen_id ?? '') == $s->id ? 'selected' : '' }}>
                    {{ $s->nombres }} {{ $s->apellidos }}
                </option>
            @endforeach
        </select>
    </div>







    <div class="form-group mt-3">
        <label>Canales</label>
        <div class="row">
            @foreach ($canales as $canal)
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="canales[]" value="{{ $canal->id }}"
                            {{ isset($socio) && $socio->canales->contains($canal->id) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $canal->nombre }} ({{ $canal->comunidad->nombre }})</label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <button class="btn btn-success mt-3">Guardar</button>
    <a href="{{ route('socios.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
</form>
