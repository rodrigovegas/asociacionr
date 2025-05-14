@extends('adminlte::page')

@section('title', 'Canales')

@section('content_header')
    <h1>Canales</h1>
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

            <table id="tabla-canales" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Comunidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($canales as $canal)
                        <tr>
                            <td>{{ $canal->id }}</td>
                            <td>{{ $canal->nombre }}</td>
                            <td>{{ $canal->comunidad->nombre }}</td>
                            <td>
                                <a href="{{ route('canales.show', $canal) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('canales.edit', $canal) }}" class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('canales.destroy', $canal) }}" method="POST"
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
    {{-- jQuery y DataTables --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

    <script>
        $(document).ready(function() {
            $('#tabla-canales').DataTable({
                pageLength: 10,
                ordering: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        });
    </script>
@endsection
