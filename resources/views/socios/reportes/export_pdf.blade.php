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
            padding: 4px;
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
    <h3> Reporte de Socios</h3>

    <table>
        <thead>
            <tr>
                <th>Apellidos y Nombres</th>
                <th>CI</th>
                <th>Fecha Nacimiento</th>
                <th>Estado</th>
                <th>Turnos</th>
                <th>Tipo Ingreso</th>
                <th>Teléfono</th>
                <th>Tercera Edad</th>
                <th>Canales</th>
                <th>Fecha Creación</th>
                <th>Creado por</th>
                <th>Última Actualización</th>
                <th>Actualizado por</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($socios as $socio)
                <tr>
                    <td>{{ $socio->apellidos }} {{ $socio->nombres }}</td>
                    <td>{{ $socio->ci }}</td>
                    <td>{{ $socio->fecha_nacimiento }}</td>
                    <td>{{ ucfirst($socio->estado) }}</td>
                    <td>{{ $socio->numero_turnos }}</td>
                    <td>{{ $socio->tipo_ingreso }}</td>
                    <td>{{ $socio->telefono }}</td>
                    <td>{{ $socio->es_tercera_edad ? 'Sí' : 'No' }}</td>
                    <td>{{ $socio->canales->pluck('nombre')->implode(', ') }}</td>
                    <td>{{ $socio->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                    <td>{{ $socio->creador->name ?? '-' }}</td>
                    <td>{{ $socio->updated_at?->format('d/m/Y H:i') ?? '-' }}</td>
                    <td>{{ $socio->editor->name ?? '-' }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
