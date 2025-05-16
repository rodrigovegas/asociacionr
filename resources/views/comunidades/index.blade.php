@extends('adminlte::page')

@section('title', 'Comunidades')

@section('content_header')
    <h1>🏘️ Comunidades</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('comunidades.create') }}" class="btn btn-success">+ Nueva Comunidad</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table id="tabla-comunidades" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Creado por</th>
                        <th>Fecha creación</th>
                        <th>Actualizado por</th>
                        <th>Última actualización</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comunidades as $comunidad)
                        <tr>
                            <td>{{ $comunidad->nombre }}</td>
                            <td>{{ $comunidad->descripcion ?? '-' }}</td>
                            <td>
                                @if ($comunidad->estado === 'activo')
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td>{{ $comunidad->creador->name ?? '-' }}</td>
                            <td>{{ $comunidad->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                            <td>
                                @if ($comunidad->updated_at && $comunidad->updated_at->ne($comunidad->created_at))
                                    {{ $comunidad->editor->name ?? '-' }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($comunidad->updated_at && $comunidad->updated_at->ne($comunidad->created_at))
                                    {{ $comunidad->updated_at->format('d/m/Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('comunidades.show', $comunidad) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('comunidades.edit', $comunidad) }}"
                                    class="btn btn-primary btn-sm">Editar</a>
                                @if ($comunidad->estado === 'activo')
                                    <form action="{{ route('comunidades.destroy', $comunidad) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('¿Inhabilitar esta comunidad?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Inhabilitar</button>
                                    </form>
                                @else
                                    <span class="text-muted">Inhabilitada</span>
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
    {{-- Estilo DataTables Bootstrap 5 --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('js')
    {{-- jQuery y DataTables Bootstrap 5 --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabla-comunidades').DataTable({
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
