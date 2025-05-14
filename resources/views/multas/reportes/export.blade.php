<table>
    <thead>
        <tr>
            <th>Socio</th>
            <th>Reunión</th>
            <th>Tipo</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Pagado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($multas as $multa)
        <tr>
            <td>{{ $multa->socio->nombres }} {{ $multa->socio->apellidos }}</td>
            <td>{{ $multa->reunion->nombre }}</td>
            <td>{{ $multa->reunion->tipo }}</td>
            <td>{{ $multa->reunion->fecha }}</td>
            <td>{{ $multa->monto }}</td>
            <td>{{ $multa->pagado ? 'Sí' : 'No' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
