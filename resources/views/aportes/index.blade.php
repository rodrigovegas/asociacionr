@extends('adminlte::page')

@section('title', 'Aportes')

@section('content_header')
    <h1>Aportes Registrados</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('aportes.create') }}" class="btn btn-success">+ Nuevo Aporte</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Aplicado a</th>
                        <th>Monto por ha</th>
                        <th>Calculado por riego</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aportes as $aporte)
                        <tr>
                            <td>{{ $aporte->nombre }}</td>
                            <td>{{ ucfirst($aporte->tipo_aporte) }}</td>
                            <td>{{ number_format($aporte->monto_por_hectarea, 2) }} Bs</td>
                            <td>
                                @if ($aporte->usar_superficie_riego)
                                    <span class="badge bg-success">Sí</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                {{-- Acciones básicas, luego agregamos detalle de pagos --}}
                                <a href="{{ route('aportes.edit', $aporte) }}" class="btn btn-primary btn-sm">Pagos</a>
                                {{-- Aquí puedes agregar eliminar si lo deseas --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
