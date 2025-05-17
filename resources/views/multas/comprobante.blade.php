@extends('adminlte::page')

@section('title', 'Comprobante de Multa')

@section('content_header')
    <h1>Comprobante de Multa</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>Socio:</strong> {{ $multa->socio->nombres }} {{ $multa->socio->apellidos }}</p>
            <p><strong>Reunión:</strong> {{ optional($multa->reunion)->nombre }}</p>
            <p><strong>Monto:</strong> {{ number_format($multa->monto, 2) }} Bs</p>
            <p><strong>Fecha de pago:</strong> {{ $multa->fecha_pago }}</p>
            <p><strong>Observación:</strong> {{ $multa->observacion }}</p>

            <a href="{{ route('multas.comprobante.pdf', $multa) }}" class="btn btn-outline-danger mt-3">
                Descargar PDF
            </a>
        </div>
    </div>
@endsection
