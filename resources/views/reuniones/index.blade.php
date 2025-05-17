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
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Canal</th>
                        <th>Monto Multa</th>
                        <th>Cobra a 3ra Edad</th>
                        <th>Estado</th> {{-- ✅ nuevo --}}
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reuniones as $r)
                        <tr>
                            <td>{{ $r->fecha }}</td>
                            <td>{{ $r->hora }}</td>
                            <td>{{ $r->nombre }}</td>
                            <td>{{ ucfirst($r->tipo) }}</td>
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
                                @if ($r->deleted_at)
                                    <span class="badge bg-secondary">Inhabilitada</span>
                                @else
                                    <span class="badge bg-success">Activa</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('reuniones.edit', $r) }}" class="btn btn-primary btn-sm">Asistencia</a>
                                <a href="{{ route('reuniones.show', $r) }}" class="btn btn-info btn-sm">Ver</a>
                                @if (is_null($r->deleted_at))
                                    <form action="{{ route('reuniones.destroy', $r) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-warning btn-sm"
                                            onclick="return confirm('¿Inhabilitar esta reunión?')">
                                            Inhabilitar
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>Inhabilitada</button>
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
            $('#tabla-reuniones').DataTable({
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        });
    </script>
@endsection
