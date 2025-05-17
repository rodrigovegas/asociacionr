@extends('adminlte::page')

@section('title', 'Crear Reunión')

@section('content_header')
    <h1>Registrar Nueva Reunión</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('reuniones.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>

                <div class="form-group mt-2">
                    <label>Tipo de Reunión</label>
                    <select name="tipo" class="form-control" required
                        onchange="document.getElementById('canalSelect').style.display = this.value === 'canal' ? 'block' : 'none'">
                        <option value="">Seleccione tipo</option>
                        <option value="general" {{ old('tipo') === 'general' ? 'selected' : '' }}>General</option>
                        <option value="canal" {{ old('tipo') === 'canal' ? 'selected' : '' }}>Por Canal</option>
                        <option value="jueces" {{ old('tipo') === 'jueces' ? 'selected' : '' }}>Jueces</option>
                        <option value="directorio" {{ old('tipo') === 'directorio' ? 'selected' : '' }}>Directorio</option>
                    </select>
                </div>

                <div class="form-group mt-2" id="canalSelect" style="{{ old('tipo') === 'canal' ? '' : 'display:none;' }}">
                    <label>Canal</label>
                    <select name="canal_id" class="form-control">
                        <option value="">Seleccione canal</option>
                        @foreach ($canales as $canal)
                            <option value="{{ $canal->id }}" {{ old('canal_id') == $canal->id ? 'selected' : '' }}>
                                {{ $canal->nombre }} ({{ $canal->comunidad->nombre }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label>Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="{{ old('fecha') }}" required>
                </div>
                <div class="form-group mt-2">
                    <label>Hora</label>
                    <input type="time" name="hora" class="form-control" value="{{ old('hora') }}">
                </div>

                <div class="form-group mt-2">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                </div>

                <div class="form-group mt-2">
                    <label>Monto de Multa (Bs)</label>
                    <input type="number" name="multa_monto" class="form-control" step="0.01"
                        value="{{ old('multa_monto') }}">
                </div>

                <div class="form-check mt-2">
                    <input type="hidden" name="multa_tercera_edad" value="0">
                    <input type="checkbox" name="multa_tercera_edad" value="1" class="form-check-input"
                        id="terceraEdadCheck" {{ old('multa_tercera_edad') ? 'checked' : '' }}>
                    <label class="form-check-label" for="terceraEdadCheck">Cobrar multa a tercera edad</label>
                </div>

                <button class="btn btn-success mt-3">Guardar</button>
                <a href="{{ route('reuniones.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
