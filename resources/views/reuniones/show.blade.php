@extends('adminlte::page')

@section('title', 'Detalle de Reunión')

@section('content_header')
    <h1>Detalle de la Reunión</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $reunion->nombre }}</p>
            <p><strong>Tipo:</strong> {{ ucfirst($reunion->tipo) }}</p>
            <p><strong>Fecha:</strong> {{ $reunion->fecha }}</p>
            <p><strong>Canal:</strong> {{ $reunion->canal->nombre ?? '-' }}</p>
            <p><strong>Descripción:</strong> {{ $reunion->descripcion }}</p>
            <p><strong>Monto de Multa:</strong> {{ $reunion->multa_monto ?? '-' }} Bs</p>
            <p><strong>Cobra a tercera edad:</strong>
                {{ $reunion->multa_tercera_edad ? 'Sí' : 'No' }}
            </p>

            <hr>
            <h5>Asistencias</h5>
            <ul>
                @foreach ($reunion->asistencias as $a)
                    <li>
                        {{ $a->socio->nombres }} {{ $a->socio->apellidos }} —
                        @if ($a->asistio)
                            <span class="text-success">Presente</span>
                        @else
                            <span class="text-danger">Ausente</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
