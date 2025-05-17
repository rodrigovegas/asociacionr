@extends('adminlte::page')

@section('title', 'Reporte de Multas')

@section('content_header')
    <h1>Reporte de Multas</h1>
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

                <div class="col-md-2">
                    <label>Estado</label>
                    <select name="pagado" class="form-control">
                        <option value="">Todos</option>
                        <option value="1" {{ request('pagado') === '1' ? 'selected' : '' }}>Pagado</option>
                        <option value="0" {{ request('pagado') === '0' ? 'selected' : '' }}>Pendiente</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Tipo</label>
                    <select name="tipo" class="form-control">
                        <option value="">Todos</option>
                        <option value="general" {{ request('tipo') === 'general' ? 'selected' : '' }}>General</option>
                        <option value="canal" {{ request('tipo') === 'canal' ? 'selected' : '' }}>Canal</option>
                        <option value="jueces" {{ request('tipo') === 'jueces' ? 'selected' : '' }}>Jueces</option>
                        <option value="directorio" {{ request('tipo') === 'directorio' ? 'selected' : '' }}>Directorio
                        </option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Desde</label>
                    <input type="date" name="desde" class="form-control" value="{{ request('desde') }}">
                </div>

                <div class="col-md-2">
                    <label>Hasta</label>
                    <input type="date" name="hasta" class="form-control" value="{{ request('hasta') }}">
                </div>

                <div class="col-md-1 d-flex align-items-end">
                    <button class="btn btn-primary w-100" title="Filtrar">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </form>

            {{-- Tabla --}}
            <table id="tabla-multas" class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Socio</th>
                        <th>Reunión</th>
                        <th>Tipo</th>
                        <th>Canales</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th>Pago</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($multas as $multa)
                        <tr>
                            <td>{{ $multa->socio->apellidos }} {{ $multa->socio->nombres }}</td>

                            <td>{{ $multa->reunion->nombre }}</td>
                            <td>{{ ucfirst($multa->reunion->tipo) }}</td>
                            <td>
                                @foreach ($multa->socio->canales as $canal)
                                    <span class="badge bg-info">{{ $canal->nombre }}</span>
                                @endforeach
                            </td>
                            <td>{{ $multa->reunion->fecha }}</td>
                            <td>{{ number_format($multa->monto, 2) }} Bs</td>
                            <td>
                                @if ($multa->pagado)
                                    <span class="badge bg-success">Pagado</span>
                                @else
                                    <span class="badge bg-warning">Pendiente</span>
                                @endif
                            </td>
                            <td>{{ $multa->fecha_pago ?? '-' }}</td>
                            <td>{{ $multa->observacion ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Botones de exportación --}}
            <div class="mb-4">
                <a href="{{ route('multas.reportes.excel', request()->query()) }}" class="btn btn-success">
                    📥 Exportar a Excel
                </a>
                <a href="{{ route('multas.reportes.pdf', request()->query()) }}" class="btn btn-danger">
                    📄 Exportar a PDF
                </a>
            </div>
            {{-- Resumen y gráfico --}}
            <div class="row mb-4">
                <div class="col-md-5">
                    <div class="card shadow-sm p-3">
                        <h5 class="text-uppercase mb-3" style="font-weight: 600;">Resumen</h5>
                        <ul class="list-unstyled mb-0">
                            <li><strong class="text-dark">Total multas:</strong> {{ number_format($total, 2) }} Bs</li>
                            <li><strong class="text-success">Total pagado:</strong> {{ number_format($total_pagado, 2) }}
                                Bs</li>
                            <li><strong class="text-warning">Total pendiente:</strong>
                                {{ number_format($total_pendiente, 2) }} Bs</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-5 d-flex align-items-center justify-content-center">
                    <div style="max-width: 220px;">
                        <canvas id="graficoMultas" height="180"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    {{-- jQuery y DataTables --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabla-multas').DataTable({
                pageLength: 10,
                ordering: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });

            const ctx = document.getElementById('graficoMultas').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Pagado', 'Pendiente'],
                    datasets: [{
                        label: 'Multas',
                        data: [{{ $total_pagado }}, {{ $total_pendiente }}],
                        backgroundColor: ['#28a745', '#ffc107'],
                    }]
                },
                options: {
                    responsive: true,
                    cutout: '65%',
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
@endsection
