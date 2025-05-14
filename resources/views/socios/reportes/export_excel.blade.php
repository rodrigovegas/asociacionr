<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>CI</th>
            <th>Fecha de Nacimiento</th>
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
                <td>
                    {{ $socio->canales->pluck('nombre')->implode(', ') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
