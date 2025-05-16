@extends('layouts.app')

@section('title', 'Crear Canal')

@section('content')
    <div class="container">
        <h3 class="mb-4">➕ Nuevo Canal</h3>

        <form action="{{ route('canales.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nombre del canal</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                    value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="comunidad_id" class="form-label">🏘️ Comunidad (opcional)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                    <select name="comunidad_id" id="comunidad_id" class="form-select">
                        <option value="">-- Seleccionar --</option>
                        @foreach ($comunidades as $comunidad)
                            <option value="{{ $comunidad->id }}"
                                {{ old('comunidad_id') == $comunidad->id ? 'selected' : '' }}>
                                {{ $comunidad->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="mb-3">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('canales.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
