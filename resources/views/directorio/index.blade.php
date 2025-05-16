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

            <table id="tabla-directorio" class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th>Socio</th>
                        <th>Comunidad</th>
                        <th>Cargo</th>
                        <th>Gestión</th>
                        <th>Periodo</th>
                        <th>Estado</th>
                        <th>Creado por</th>
                        <th>Fecha creación</th>
                        <th>Actualizado por</th>
                        <th>Última actualización</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registros as $r)
                        <tr>
                            <td>{{ $r->socio->apellidos }} {{ $r->socio->nombres }}</td>
                            <td>{{ $r->comunidad->nombre ?? 'No asignada' }}</td>
                            <td>{{ $r->cargo }}</td>
                            <td>{{ $r->gestion }}</td>
                            <td>{{ $r->periodo_inicio }} - {{ $r->periodo_fin }}</td>
                            <td>
                                @if ($r->estado === 'activo')
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td>{{ $r->creador->name ?? '-' }}</td>
                            <td>{{ $r->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                            <td>
                                @if ($r->updated_at && $r->updated_at->ne($r->created_at))
                                    {{ $r->editor->name ?? '-' }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($r->updated_at && $r->updated_at->ne($r->created_at))
                                    {{ $r->updated_at->format('d/m/Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('directorio.show', $r) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('directorio.edit', $r) }}" class="btn btn-primary btn-sm">Editar</a>
                                @if ($r->estado === 'activo')
                                    <form action="{{ route('directorio.destroy', $r) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Inhabilitar este registro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Inhabilitar</button>
                                    </form>
                                @else
                                    <span class="text-muted">Inhabilitado</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Asegura que jQuery esté cargado -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabla-directorio').DataTable({
                responsive: true,
                pageLength: 10,
                ordering: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        });
    </script>
@endsection
