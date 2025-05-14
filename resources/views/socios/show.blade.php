@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title m-0">Detalle del Socio</h3>

                <div class="card-tools">
                    <a href="{{ route('socios.detalle', $socio) }}" class="btn btn-primary btn-sm mr-2">
                        <i class="fas fa-file-pdf"></i> Imprimir PDF
                    </a>
                    <a href="{{ route('socios.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>


            <div class="card-body">

                <div class="row mb-2">
                    <div class="col-md-6"><strong>Nombres:</strong> {{ $socio->nombres }}</div>
                    <div class="col-md-6"><strong>Apellidos:</strong> {{ $socio->apellidos }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6"><strong>CI:</strong> {{ $socio->ci ?? 'No registrado' }}</div>
                    <div class="col-md-6"><strong>Teléfono:</strong> {{ $socio->telefono ?? 'No registrado' }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6"><strong>Fecha de nacimiento:</strong>
                        {{ \Carbon\Carbon::parse($socio->fecha_nacimiento)->format('d/m/Y') }}</div>
                    <div class="col-md-6"><strong>Tipo de ingreso:</strong> {{ ucfirst($socio->tipo_ingreso) }}</div>
                </div>

                @if ($socio->socio_origen)
                    <div class="row mb-2">
                        <div class="col-md-6"><strong>Socio origen:</strong> {{ $socio->socio_origen->nombres }}
                            {{ $socio->socio_origen->apellidos }}</div>
                    </div>
                @endif

                <div class="row mb-2">
                    <div class="col-md-6"><strong>Sistema:</strong> {{ $socio->sistema ?? 'No registrado' }}</div>
                    <div class="col-md-6"><strong>Código socio:</strong> {{ $socio->codigo_socio }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6"><strong>Superficie total:</strong> {{ $socio->superficie_total }} ha</div>
                    <div class="col-md-6"><strong>Superficie de riego:</strong> {{ $socio->superficie_riego }} ha</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6"><strong>Fecha de ingreso:</strong>
                        {{ \Carbon\Carbon::parse($socio->fecha_ingreso)->format('d/m/Y') }}</div>
                    <div class="col-md-6"><strong>N° de turnos:</strong> {{ $socio->numero_turnos }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6"><strong>Estado:</strong>
                        <span class="badge badge-{{ $socio->estado == 'activo' ? 'success' : 'danger' }}">
                            {{ ucfirst($socio->estado) }}
                        </span>
                    </div>
                    <div class="col-md-6"><strong>¿Tercera edad?:</strong>
                        {{ $socio->es_tercera_edad ? 'Sí' : 'No' }}
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12"><strong>Canales asignados:</strong>
                        @forelse($socio->canales as $canal)
                            <span class="badge badge-info">{{ $canal->nombre }}</span>
                        @empty
                            <span class="text-muted">Sin canales asignados</span>
                        @endforelse
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6"><strong>Creado por:</strong> {{ $socio->creador?->name ?? 'Desconocido' }}</div>
                    <div class="col-md-6"><strong>Fecha de creación:</strong> {{ $socio->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><strong>Editado por:</strong> {{ $socio->editor?->name ?? 'Desconocido' }}</div>
                    <div class="col-md-6"><strong>Última actualización:</strong>
                        {{ $socio->updated_at->format('d/m/Y H:i') }}</div>
                </div>

            </div>
        </div>
    </div>
@endsection
