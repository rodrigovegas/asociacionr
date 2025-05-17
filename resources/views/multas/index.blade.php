@extends('adminlte::page')

@section('title', 'Multas')

@section('content_header')
    <h1>Listado de Multas</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- Filtros --}}
            <form method="GET" class="row g-2 mb-4">
                <div class="col-md-3">
                    <label>Canal</label>
                    <select name="canal_id" class="form-control">
                        <option value="">Todos</option>
                        @foreach ($canales as $canal)
                            <option value="{{ $canal->id }}" {{ request('canal_id') == $canal->id ? 'selected' : '' }}>
                                {{ $canal->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Estado</label>
                    <select name="pagado" class="form-control">
                        <option value="">Todos</option>
                        <option value="0" {{ request('pagado') === '0' ? 'selected' : '' }}>Pendiente</option>
                        <option value="1" {{ request('pagado') === '1' ? 'selected' : '' }}>Pagado</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Tipo de reunión</label>
                    <select name="tipo" class="form-control">
                        <option value="">Todos</option>
                        <option value="general" {{ request('tipo') === 'general' ? 'selected' : '' }}>General</option>
                        <option value="canal" {{ request('tipo') === 'canal' ? 'selected' : '' }}>Por canal</option>
                        <option value="jueces" {{ request('tipo') === 'jueces' ? 'selected' : '' }}>Jueces</option>
                        <option value="directorio" {{ request('tipo') === 'directorio' ? 'selected' : '' }}>Directorio
                        </option>
                    </select>
                </div>

                <div class="col-md-3 align-self-end">
                    <button class="btn btn-primary">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </form>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Tabla --}}
            <table id="tabla-multas" class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Socio</th>
                        <th>Canales</th>
                        <th>Reunión</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th>Fecha pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($multas as $multa)
                        <tr>
                            <td>{{ $multa->socio->apellidos }} {{ $multa->socio->nombres }}</td>
                            <td>
                                @foreach ($multa->socio->canales as $canal)
                                    <span class="badge bg-info">{{ $canal->nombre }}</span>
                                @endforeach
                            </td>
                            <td>{{ $multa->reunion->nombre }}</td>
                            <td>{{ ucfirst($multa->reunion->tipo) }}</td>
                            <td>{{ number_format($multa->monto, 2) }} Bs</td>
                            <td>
                                @if ($multa->pagado)
                                    <span class="badge bg-success">Pagado</span>
                                @else
                                    <span class="badge bg-warning">Pendiente</span>
                                @endif
                            </td>
                            <td>{{ $multa->fecha_pago ?? '-' }}</td>
                            <td>
                                @if ($multa->pagado)
                                    <a href="{{ route('multas.comprobante', $multa) }}"
                                        class="btn btn-success btn-sm">Ver</a>
                                @endif

                                <a href="{{ route('multas.edit', $multa) }}" class="btn btn-primary btn-sm">Editar</a>
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
            $('#tabla-multas').DataTable({
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        });
    </script>
@endsection
