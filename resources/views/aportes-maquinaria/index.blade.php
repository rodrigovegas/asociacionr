@extends('adminlte::page')

@section('title', 'Aportes por Maquinaria')

@section('content_header')
    <h1>Listado de Aportes por Maquinaria</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('aportes-maquinaria.create') }}" class="btn btn-success">+ Nuevo Aporte</a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table id="tabla-aportes" class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th>Socio</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Monto/Hora</th>
                        <th>Horas</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aportes as $a)
                        <tr>
                            <td>{{ $a->socio->apellidos }} {{ $a->socio->nombres }}</td>
                            <td>{{ ucfirst($a->tipo_maquinaria) }}</td>
                            <td>{{ $a->fecha_aporte }}</td>
                            <td>{{ number_format($a->monto_por_hora, 2) }} Bs</td>
                            <td>{{ $a->horas_requeridas }}</td>
                            <td><strong>{{ number_format($a->total, 2) }} Bs</strong></td>
                            <td>
                                @if ($a->estado === 'activo')
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('aportes-maquinaria.show', $a) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('aportes-maquinaria.edit', $a) }}"
                                    class="btn btn-primary btn-sm">Editar</a>

                                @if ($a->estado === 'activo')
                                    <a href="{{ route('aportes-maquinaria.comprobante', $a) }}"
                                        class="btn btn-success btn-sm">Comprobante</a>

                                    <form action="{{ route('aportes-maquinaria.destroy', $a) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-warning btn-sm"
                                            onclick="return confirm('¿Inhabilitar este aporte?')">Inhabilitar</button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>Inhabilitado</button>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-aportes').DataTable({
                pageLength: 10,
                responsive: true,
                ordering: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
@endsection
