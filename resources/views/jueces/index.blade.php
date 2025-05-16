@extends('adminlte::page')

@section('title', 'Jueces Registrados')

@section('content_header')
    <h1>Jueces Registrados</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('jueces.create') }}" class="btn btn-success">+ Nuevo Juez</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table id="tabla-jueces" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Socio</th>
                        <th>Canal</th>
                        <th>Gestión</th>
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
                    @foreach ($jueces as $juez)
                        <tr>
                            <td>{{ $juez->socio->apellidos }} {{ $juez->socio->nombres }}</td>
                            <td>{{ $juez->canal->nombre }}</td>
                            <td>{{ $juez->gestion }}</td>
                            <td>{{ $juez->descripcion ?? '-' }}</td>
                            <td>
                                @if ($juez->estado === 'activo')
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td>{{ $juez->creador->name ?? '-' }}</td>
                            <td>{{ $juez->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                            <td>
                                @if ($juez->updated_at && $juez->updated_at->ne($juez->created_at))
                                    {{ $juez->editor->name ?? '-' }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($juez->updated_at && $juez->updated_at->ne($juez->created_at))
                                    {{ $juez->updated_at->format('d/m/Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('jueces.show', $juez) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('jueces.edit', $juez) }}" class="btn btn-primary btn-sm">Editar</a>
                                @if ($juez->estado === 'activo')
                                    <form action="{{ route('jueces.destroy', $juez) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Inhabilitar este juez?');">
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-jueces').DataTable({
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        });
    </script>
@endsection
