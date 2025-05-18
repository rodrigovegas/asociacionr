@extends('adminlte::page')

@section('title', 'Comprobante')

@section('content_header')
    <h1>Comprobante de Aporte por Maquinaria</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <p><strong>Recibí de:</strong> {{ $aporte->socio->apellidos }} {{ $aporte->socio->nombres }}</p>
            <p><strong>Cantidad:</strong> {{ number_format($aporte->total, 2) }} Bs</p>
            <p><strong>Cantidad literal:</strong>

            </p>
            <p><strong>Concepto:</strong> Uso de {{ $aporte->tipo_maquinaria }} —
                {{ $aporte->descripcion ?? 'sin descripción' }}</p>
            <p><strong>Horas:</strong> {{ $aporte->horas_requeridas }} h a {{ number_format($aporte->monto_por_hora, 2) }}
                Bs/h</p>
            <p><strong>Fecha del aporte:</strong> {{ $aporte->fecha_aporte }}</p>

            <div class="mt-4">
                <p><strong>Forma de pago:</strong></p>
                <div>
                    <span style="border: 1px solid #000; width: 15px; height: 15px; display: inline-block;"></span> Efectivo
                    <span style="margin-left: 40px;"></span>
                    <span style="border: 1px solid #000; width: 15px; height: 15px; display: inline-block;"></span>
                    Transferencia
                </div>
            </div>

            <div class="mt-5 text-end">
                <p>Recibido por: __________________________</p>
            </div>

            <a href="{{ route('aportes-maquinaria.comprobante.pdf', $aporte) }}" class="btn btn-danger mt-3">
                Descargar PDF
            </a>

            <a href="{{ route('aportes-maquinaria.index') }}" class="btn btn-secondary mt-3">
                Volver
            </a>
        </div>
    </div>
@endsection
