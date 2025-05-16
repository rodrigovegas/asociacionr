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
