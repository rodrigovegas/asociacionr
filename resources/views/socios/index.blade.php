
@extends('adminlte::page')

@section('title', 'Socios')

@section('content_header')
    <h1>Socios</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('socios.create') }}" class="btn btn-success mb-3">+ Nuevo Socio</a>

        <table id="tabla-socios" class="table table-bordered table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>CI</th>
                    <th>Fecha Nac.</th>
                    <th>Código</th>
                    <th>Teléfono</th>
                    <th>Turnos</th>
                    <th>Fecha Ingreso</th>
                    <th>Estado</th>
                    <th>Canales</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($socios as $socio)
                    <tr>
                        <td>{{ $socio->apellidos }} {{ $socio->nombres }}</td>
                        <td>{{ $socio->ci }}</td>
                        <td>{{ $socio->fecha_nacimiento }}</td>
                        <td>{{ $socio->codigo_socio }}</td>
                        <td>{{ $socio->telefono }}</td>
                        <td><span class="badge bg-info">{{ $socio->numero_turnos }}</span></td>
                        <td>{{ $socio->fecha_ingreso }}</td>
                        <td>{{ ucfirst($socio->estado) }}</td>
                        <td>{{ $socio->canales->pluck('nombre')->join(', ') }}</td>
                        <td>
                            <a href="{{ route('socios.show', $socio) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('socios.edit', $socio) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('socios.destroy', $socio) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-warning btn-sm" onclick="return confirm('¿Deseas inhabilitar este socio?')">Inhabilitar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@push('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable('#tabla-socios')) {
            $('#tabla-socios').DataTable({
                pageLength: 10,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        }
    });
</script>
@endpush
