@extends('adminlte::page')

@section('title', 'Canales')

@section('content_header')
    <h1>📡 Lista de Canales</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('canales.create') }}" class="btn btn-success">+ Nuevo Canal</a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table id="tabla-canales" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Comunidad</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Creado por</th>
                        <th>Fecha de creación</th>
                        <th>Actualizado por</th>
                        <th>Última actualización</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($canales as $canal)
                        <tr>
                            <td>{{ $canal->nombre }}</td>
                            <td>{{ $canal->comunidad->nombre ?? '-' }}</td>
                            <td>{{ $canal->descripcion ?? '-' }}</td>
                            <td>
                                @if ($canal->estado === 'activo')
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td>{{ $canal->creador->name ?? '-' }}</td>
                            <td>{{ $canal->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                            <td>
                                @if ($canal->updated_at && $canal->updated_at->ne($canal->created_at))
                                    {{ $canal->editor->name ?? '-' }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($canal->updated_at && $canal->updated_at->ne($canal->created_at))
                                    {{ $canal->updated_at->format('d/m/Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('canales.show', $canal) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('canales.edit', $canal) }}" class="btn btn-primary btn-sm">Editar</a>
                                @if ($canal->estado === 'activo')
                                    <form action="{{ route('canales.destroy', $canal) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Deseas inhabilitar este canal?');">
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
    {{-- Estilo DataTables Bootstrap 5 --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('js')
    {{-- jQuery y DataTables --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabla-canales').DataTable({
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
