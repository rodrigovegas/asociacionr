@extends('adminlte::page')

@section('title', 'Editar Reunión')

@section('content_header')
    <h1>Editar Reunión: {{ $reunion->nombre }}</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('reuniones.update', $reunion) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $reunion->nombre) }}" required>
            </div>

            <div class="form-group mt-2">
                <label>Tipo</label>
                <input type="text" class="form-control" value="{{ ucfirst($reunion->tipo) }}" readonly>
            </div>

            <div class="form-group mt-2">
                <label>Fecha</label>
                <input type="date" class="form-control" value="{{ $reunion->fecha }}" readonly>
            </div>

            <div class="form-group mt-2">
                <label>Monto de Multa (Bs)</label>
                <input type="number" name="multa_monto" class="form-control" step="0.01" value="{{ old('multa_monto', $reunion->multa_monto) }}">
            </div>

            <div class="form-check mt-2">
                <input type="checkbox" name="multa_tercera_edad" class="form-check-input" id="terceraEdadCheck"
                    {{ old('multa_tercera_edad', $reunion->multa_tercera_edad) ? 'checked' : '' }}>
                <label class="form-check-label" for="terceraEdadCheck">Cobrar multa a tercera edad</label>
            </div>

            <h5 class="mt-4">Asistencia</h5>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Socio</th>
                        <th>¿Asistió?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reunion->asistencias as $asistencia)
                        <tr>
                            <td>{{ $asistencia->socio->nombres }} {{ $asistencia->socio->apellidos }}</td>
                            <td>
                                <input type="checkbox" name="asistencias[{{ $asistencia->id }}]" value="1"
                                    {{ $asistencia->asistio ? 'checked' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn btn-success">Guardar Cambios</button>
            <a href="{{ route('reuniones.index') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</div>
@endsection