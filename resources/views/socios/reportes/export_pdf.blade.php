<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reporte de Socios</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        h3 {
            text-align: center;
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <h3>📄 Reporte de Socios</h3>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>CI</th>
                <th>Fecha Nac.</th>
                <th>Estado</th>
                <th>Turnos</th>
                <th>Canales</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($socios as $socio)
                <tr>
                    <td>{{ $socio->nombre }}</td>
                    <td>{{ $socio->ci }}</td>
                    <td>{{ $socio->fecha_nacimiento }}</td>
                    <td>{{ ucfirst($socio->estado) }}</td>
                    <td>{{ $socio->numero_turnos }}</td>
                    <td>{{ $socio->canales->pluck('nombre')->implode(', ') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
