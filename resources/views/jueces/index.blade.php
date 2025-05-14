@extends('adminlte::page')

@section('title', 'Jueces')

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

            <table id="tabla-jueces" class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Socio</th>
                        <th>Canal</th>
                        <th>Gestión</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jueces as $juez)
                        <tr>
                            <td>{{ $juez->socio->nombres }} {{ $juez->socio->apellidos }}</td>
                            <td>{{ $juez->canal->nombre }}</td>
                            <td>{{ $juez->gestion }}</td>
                            <td>{{ $juez->descripcion }}</td>
                            <td>
                                <a href="{{ route('jueces.show', $juez) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('jueces.edit', $juez) }}" class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('jueces.destroy', $juez) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar juez?')">Eliminar</button>
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
            $('#tabla-jueces').DataTable({
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
