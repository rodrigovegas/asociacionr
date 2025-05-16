@extends('layouts.app')

@section('title', 'Reporte de Socios')

@section('content')
    <div class="container">
        <h3 class="mb-4">📊 Reporte de Socios</h3>

        <form method="GET" action="{{ route('socios.reportes.index') }}"
            class="row row-cols-lg-auto g-3 align-items-end mb-4">
            <div class="col">
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
            <div class="col">
                <label>Tipo de Ingreso</label>
                <select name="tipo_ingreso" class="form-select">
                    <option value="">Todos</option>
                    @foreach ($tiposIngreso as $tipo)
                        <option value="{{ $tipo }}" {{ request('tipo_ingreso') == $tipo ? 'selected' : '' }}>
                            {{ ucfirst($tipo) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label>Estado</label>
                <select name="estado" class="form-select">
                    <option value="">Todos</option>
                    <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="col">
                <label>F. Nac. desde</label>
                <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" class="form-control">
            </div>
            <div class="col">
                <label>F. Nac. hasta</label>
                <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" class="form-control">
            </div>
            <div class="col">
                <label>Turnos ≥</label>
                <input type="number" name="turnos_min" value="{{ request('turnos_min') }}" class="form-control">
            </div>
            <div class="col">
                <label>Turnos ≤</label>
                <input type="number" name="turnos_max" value="{{ request('turnos_max') }}" class="form-control">
            </div>
            <div class="col d-grid">
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
                    <th>Apellidos y Nombres</th>
                    <th>CI</th>
                    <th>Fecha Nacimiento</th>
                    <th>Estado</th>
                    <th>Turnos</th>
                    <th>Tipo Ingreso</th>
                    <th>Teléfono</th>
                    <th>Tercera Edad</th>
                    <th>Canales</th>
                    <th>Fecha Creación</th>
                    <th>Creado por</th>
                    <th>Última Actualización</th>
                    <th>Actualizado por</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($socios as $socio)
                    <tr>
                        <td>{{ $socio->apellidos }} {{ $socio->nombres }}</td>
                        <td>{{ $socio->ci }}</td>
                        <td>{{ $socio->fecha_nacimiento }}</td>
                        <td>{{ ucfirst($socio->estado) }}</td>
                        <td>{{ $socio->numero_turnos }}</td>
                        <td>{{ $socio->tipo_ingreso }}</td>
                        <td>{{ $socio->telefono }}</td>
                        <td>{{ $socio->es_tercera_edad ? 'Sí' : 'No' }}</td>
                        <td>
                            @foreach ($socio->canales as $canal)
                                <span class="badge bg-info">{{ $canal->nombre }}</span>
                            @endforeach
                        </td>
                        <td>{{ $socio->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                        <td>{{ $socio->creador->name ?? '-' }}</td>
                        <td>{{ $socio->updated_at?->format('d/m/Y H:i') ?? '-' }}</td>
                        <td>{{ $socio->editor->name ?? '-' }}</td>
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
