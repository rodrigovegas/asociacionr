<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Multas</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        ul {
            margin-top: 0;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h2>Reporte de Multas</h2>

    {{-- Filtros activos --}}
    @if(request()->anyFilled(['canal_id', 'pagado', 'tipo', 'desde', 'hasta']))
        <p><strong>Filtros aplicados:</strong></p>
        <ul>
            @if(request('canal_id'))
                <li>Canal ID: {{ request('canal_id') }}</li>
            @endif
            @if(request('pagado') !== null)
                <li>Estado: {{ request('pagado') ? 'Pagado' : 'Pendiente' }}</li>
            @endif
            @if(request('tipo'))
                <li>Tipo de reunión: {{ ucfirst(request('tipo')) }}</li>
            @endif
            @if(request('desde'))
                <li>Desde: {{ request('desde') }}</li>
            @endif
            @if(request('hasta'))
                <li>Hasta: {{ request('hasta') }}</li>
            @endif
        </ul>
    @endif

    {{-- Tabla --}}
    <table>
        <thead>
            <tr>
                <th>Socio</th>
                <th>Reunión</th>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($multas as $multa)
            <tr>
                <td>{{ $multa->socio->nombres }} {{ $multa->socio->apellidos }}</td>
                <td>{{ $multa->reunion->nombre }}</td>
                <td>{{ $multa->reunion->tipo }}</td>
                <td>{{ $multa->reunion->fecha }}</td>
                <td style="text-align: center;">{{ number_format($multa->monto, 2) }} Bs</td>
                <td>{{ $multa->pagado ? 'Pagado' : 'Pendiente' }}</td>
            </tr>
            @endforeach

            {{-- Total --}}
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Total</strong></td>
                <td style="text-align: center;"><strong>{{ number_format($multas->sum('monto'), 2) }} Bs</strong></td>
                <td></td>
            </tr>
        </tbody>
    </table>

</body>
</html>
