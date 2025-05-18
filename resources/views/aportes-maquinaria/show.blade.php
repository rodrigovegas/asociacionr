@extends('adminlte::page')

@section('title', 'Detalle del Aporte')

@section('content_header')
    <h1>Detalle del Aporte por Maquinaria</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <p><strong>Socio:</strong> {{ $aporte->socio->apellidos }} {{ $aporte->socio->nombres }}</p>
            <p><strong>Tipo de Maquinaria:</strong> {{ ucfirst($aporte->tipo_maquinaria) }}</p>
            <p><strong>Monto por Hora:</strong> {{ number_format($aporte->monto_por_hora, 2) }} Bs</p>
            <p><strong>Horas Requeridas:</strong> {{ $aporte->horas_requeridas }}</p>
            <p><strong>Total:</strong> <strong>{{ number_format($aporte->total, 2) }} Bs</strong></p>
            <p><strong>Fecha del Aporte:</strong> {{ $aporte->fecha_aporte }}</p>
            <p><strong>Descripción:</strong> {{ $aporte->descripcion ?? '-' }}</p>

            <hr>
            <p><strong>Estado:</strong>
                @if ($aporte->estado === 'activo')
                    <span class="badge bg-success">Activo</span>
                @else
                    <span class="badge bg-secondary">Inactivo</span>
                @endif
            </p>

            <p><strong>Creado el:</strong> {{ $aporte->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Creado por:</strong> {{ optional($aporte->creador)->name ?? 'N/D' }}</p>

            <p><strong>Última edición:</strong> {{ $aporte->updated_at->format('d/m/Y H:i') }}</p>
            <p><strong>Editado por:</strong> {{ optional($aporte->editor)->name ?? 'N/D' }}</p>

            <hr>
            <a href="{{ route('aportes-maquinaria.comprobante', $aporte) }}" class="btn btn-outline-primary">
                Ver Comprobante
            </a>

            <a href="{{ route('aportes-maquinaria.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@endsection
