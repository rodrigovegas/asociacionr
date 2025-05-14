@extends('adminlte::page')

@section('title', isset($canal) ? 'Editar Canal' : 'Nuevo Canal')

@section('content_header')
    <h1>{{ isset($canal) ? 'Editar Canal' : 'Nuevo Canal' }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ isset($canal) ? route('canales.update', $canal) : route('canales.store') }}" method="POST">
                @csrf
                @if(isset($canal))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $canal->nombre ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label>Comunidad</label>
                    <select name="comunidad_id" class="form-control" required>
                        <option value="">Seleccione...</option>
                        @foreach($comunidades as $comunidad)
                            <option value="{{ $comunidad->id }}" {{ (isset($canal) && $canal->comunidad_id == $comunidad->id) ? 'selected' : '' }}>
                                {{ $comunidad->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success mt-2">Guardar</button>
                <a href="{{ route('canales.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
