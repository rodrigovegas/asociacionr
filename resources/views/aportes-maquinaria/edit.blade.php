@extends('adminlte::page')

@section('title', 'Editar Aporte')

@section('content_header')
    <h1>Editar Aporte por Maquinaria</h1>
@endsection

@section('content')
    <div class="card">
        <form action="{{ route('aportes-maquinaria.update', $aporte) }}" method="POST" id="form-aporte">
            @csrf
            @method('PUT')

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="socio_id">Socio</label>
                    <select name="socio_id" class="form-control" disabled>
                        <option value="{{ $aporte->socio->id }}" selected>
                            {{ $aporte->socio->apellidos }} {{ $aporte->socio->nombres }}
                        </option>
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label>Tipo de Maquinaria</label>
                    <select name="tipo_maquinaria" class="form-control" required>
                        <option value="">Seleccione tipo</option>
                        <option value="maquinaria agrícola"
                            {{ $aporte->tipo_maquinaria === 'maquinaria agrícola' ? 'selected' : '' }}>Maquinaria Agrícola
                        </option>
                        <option value="maquinaria pesada"
                            {{ $aporte->tipo_maquinaria === 'maquinaria pesada' ? 'selected' : '' }}>Maquinaria Pesada
                        </option>
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label>Monto por Hora (Bs)</label>
                    <input type="number" name="monto_por_hora" id="monto_por_hora" class="form-control" step="0.01"
                        value="{{ $aporte->monto_por_hora }}" required>
                </div>

                <div class="form-group mt-2">
                    <label>Horas Requeridas</label>
                    <input type="number" name="horas_requeridas" id="horas_requeridas" class="form-control" step="0.01"
                        value="{{ $aporte->horas_requeridas }}" required>
                </div>

                <div class="form-group mt-2">
                    <label>Total (Bs)</label>
                    <input type="text" name="total" id="total" class="form-control" readonly
                        value="{{ number_format($aporte->total, 2) }}">
                </div>

                <div class="form-group mt-2">
                    <label>Fecha del Aporte</label>
                    <input type="date" name="fecha_aporte" class="form-control" value="{{ $aporte->fecha_aporte }}"
                        required>
                </div>

                <div class="form-group mt-2">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ $aporte->descripcion }}</textarea>
                </div>
            </div>

            <div class="card-footer text-end">
                <a href="{{ route('aportes-maquinaria.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        function calcularTotal() {
            const monto = parseFloat(document.getElementById('monto_por_hora').value) || 0;
            const horas = parseFloat(document.getElementById('horas_requeridas').value) || 0;
            const total = (monto * horas).toFixed(2);
            document.getElementById('total').value = total;
        }

        document.getElementById('monto_por_hora').addEventListener('input', calcularTotal);
        document.getElementById('horas_requeridas').addEventListener('input', calcularTotal);
    </script>
@endsection
