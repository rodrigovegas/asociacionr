@extends('adminlte::page')

@section('title', 'Reuniones')

@section('content_header')
    <h1>Reuniones</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('reuniones.create') }}" class="btn btn-success">+ Nueva Reunión</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table id="tabla-reuniones" class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Canal</th>
                        <th>Monto Multa</th>
                        <th>Cobra a 3ra Edad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reuniones as $r)
                        <tr>
                            <td>{{ $r->nombre }}</td>
                            <td>{{ ucfirst($r->tipo) }}</td>
                            <td>{{ $r->fecha }}</td>
                            <td>{{ $r->canal->nombre ?? '-' }}</td>
                            <td>{{ $r->multa_monto ? number_format($r->multa_monto, 2) : '-' }} Bs</td>
                            <td>
                                @if ($r->multa_tercera_edad)
                                    <span class="badge bg-danger">Sí</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('reuniones.edit', $r) }}" class="btn btn-primary btn-sm">Asistencia</a>
                                <a href="{{ route('reuniones.show', $r) }}" class="btn btn-info btn-sm">Ver</a>
                                <form action="{{ route('reuniones.destroy', $r) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar reunión?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    {{-- jQuery y DataTables --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

    <script>
        $(document).ready(function() {
            $('#tabla-reuniones').DataTable({
                pageLength: 10,
                ordering: true,
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        });
    </script>
@endsection
