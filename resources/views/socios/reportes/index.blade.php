@extends('layouts.app') {{-- Cambia esto si usas otro layout como layouts.admin --}}

@section('title', 'Reporte de Socios')

@section('content')
    <div class="container">
        <h3 class="mb-4">📊 Reporte de Socios</h3>

        <form method="GET" action="{{ route('socios.reportes.index') }}" class="row g-3 mb-4">
            <div class="col-md-3">
                <label>Canal</label>
                <select name="canal_id" class="form-select">
                    <option value="">Todos</option>
                    @foreach ($canales as $canal)
                        <option value="{{ $canal->id }}" {{ request('canal_id') == $canal->id ? 'selected' : '' }}>
                            {{ $canal->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label>Estado</label>
                <select name="estado" class="form-select">
                    <option value="">Todos</option>
                    <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="col-md-2">
                <label>F. Nac. desde</label>
                <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" class="form-control">
            </div>
            <div class="col-md-2">
                <label>F. Nac. hasta</label>
                <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" class="form-control">
            </div>
            <div class="col-md-1">
                <label>Turnos ≥</label>
                <input type="number" name="turnos_min" value="{{ request('turnos_min') }}" class="form-control">
            </div>
            <div class="col-md-1">
                <label>Turnos ≤</label>
                <input type="number" name="turnos_max" value="{{ request('turnos_max') }}" class="form-control">
            </div>
            <div class="col-md-1 d-grid">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>

        <div class="mb-3">
            <a href="{{ route('socios.reportes.excel', request()->all()) }}" class="btn btn-success me-2">📤 Exportar a
                Excel</a>
            <a href="{{ route('socios.reportes.pdf', request()->all()) }}" class="btn btn-danger">🖨 Exportar a PDF</a>
        </div>

        <table id="tablaSocios" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>CI</th>
                    <th>Fecha Nacimiento</th>
                    <th>Estado</th>
                    <th>Turnos</th>
                    <th>Canales</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($socios as $socio)
                    <tr>
                        <td>{{ $socio->nombre }}</td>
                        <td>{{ $socio->ci }}</td>
                        <td>{{ $socio->fecha_nacimiento }}</td>
                        <td>{{ ucfirst($socio->estado) }}</td>
                        <td>{{ $socio->numero_turnos }}</td>
                        <td>
                            @foreach ($socio->canales as $canal)
                                <span class="badge bg-info">{{ $canal->nombre }}</span>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tablaSocios').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        });
    </script>
@endsection
