@extends('adminlte::page')

@section('title', 'Editar Multa')

@section('content_header')
    <h1>Editar Multa</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('multas.update', $multa) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Socio</label>
                <input type="text" class="form-control" value="{{ $multa->socio->nombres }} {{ $multa->socio->apellidos }}" readonly>
            </div>

            <div class="form-group mt-2">
                <label>Reunión</label>
                <input type="text" class="form-control" value="{{ $multa->reunion->nombre }} ({{ ucfirst($multa->reunion->tipo) }})" readonly>
            </div>

            <div class="form-group mt-2">
                <label>Monto (Bs)</label>
                <input type="text" class="form-control" value="{{ number_format($multa->monto, 2) }}" readonly>
            </div>

            <div class="form-group mt-2">
                <label>Estado de pago</label>
                <select name="pagado" class="form-control" required>
                    <option value="1" {{ $multa->pagado ? 'selected' : '' }}>Pagado</option>
                    <option value="0" {{ !$multa->pagado ? 'selected' : '' }}>Pendiente</option>
                </select>
            </div>

            <div class="form-group mt-2">
                <label>Fecha de pago</label>
                <input type="date" name="fecha_pago" class="form-control" value="{{ old('fecha_pago', $multa->fecha_pago) }}">
            </div>

            <div class="form-group mt-2">
                <label>Observación</label>
                <textarea name="observacion" class="form-control">{{ old('observacion', $multa->observacion) }}</textarea>
            </div>

            <button class="btn btn-success mt-3">Guardar</button>
            <a href="{{ route('multas.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
        </form>
    </div>
</div>
@endsection
