@extends('adminlte::page')

@section('title', 'Directorio')

@section('content_header')
    <h1>Miembros del Directorio</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('directorio.create') }}" class="btn btn-success">+ Nuevo Registro</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table id="tabla-directorio" class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Socio</th>
                        <th>Comunidad</th>
                        <th>Cargo</th>
                        <th>Gestión</th>
                        <th>Periodo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registros as $r)
                        <tr>
                            <td>{{ $r->socio->nombres }} {{ $r->socio->apellidos }}</td>
                            <td>{{ $r->comunidad->nombre ?? 'No asignada' }}</td>
                            <td>{{ $r->cargo }}</td>
                            <td>{{ $r->gestion }}</td>
                            <td>{{ $r->periodo_inicio }} - {{ $r->periodo_fin }}</td>
                            <td>
                                <a href="{{ route('directorio.show', $r) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('directorio.edit', $r) }}" class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('directorio.destroy', $r) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar?')">Eliminar</button>
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
    {{-- jQuery + DataTables --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

    <script>
        $(document).ready(function() {
            $('#tabla-directorio').DataTable({
                pageLength: 10,
                ordering: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        });
    </script>
@endsection
