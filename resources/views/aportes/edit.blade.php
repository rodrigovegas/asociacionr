@extends('adminlte::page')

@section('title', 'Pagos del Aporte')

@section('content_header')
    <h1>Pagos - {{ $aporte->nombre }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('aportes.update', $aporte) }}" method="POST">
                @csrf
                @method('PUT')

                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Socio</th>
                            <th>Superficie Riego</th>
                            <th>Monto (Bs)</th>
                            <th>Pagado</th>
                            <th>Fecha de pago</th>
                            <th>Observación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aporte->pagos as $pago)
                            <tr>
                                <td>{{ $pago->socio->nombres }} {{ $pago->socio->apellidos }}</td>
                                <td>{{ $pago->socio->superficie_riego }} ha</td>
                                <td>{{ number_format($pago->monto, 2) }}</td>
                                <td>
                                    <input type="checkbox" name="pagos[{{ $pago->id }}][pagado]" value="1"
                                        {{ $pago->pagado ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="date" name="pagos[{{ $pago->id }}][fecha_pago]"
                                        class="form-control form-control-sm"
                                        value="{{ old("pagos.$pago->id.fecha_pago", $pago->fecha_pago) }}">
                                </td>
                                <td>
                                    <input type="text" name="pagos[{{ $pago->id }}][observacion]"
                                        class="form-control form-control-sm"
                                        value="{{ old("pagos.$pago->id.observacion", $pago->observacion) }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button class="btn btn-primary mt-3">Guardar Cambios</button>
                <a href="{{ route('aportes.index') }}" class="btn btn-secondary mt-3">Volver</a>
            </form>
        </div>
    </div>
@endsection
