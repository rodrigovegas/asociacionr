@extends('adminlte::page')

@section('title', 'Nuevo Aporte por Maquinaria')

@section('content_header')
    <h1>Registrar Aporte por Maquinaria</h1>
@endsection

@section('content')
    <div class="card">
        <form action="{{ route('aportes-maquinaria.store') }}" method="POST" id="form-aporte">
            @csrf
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
                    <select name="socio_id" id="socio_id" class="form-control" required>
                        <option value="">Seleccione un socio</option>
                        @foreach ($socios as $socio)
                            <option value="{{ $socio->id }}">
                                {{ $socio->apellidos }} {{ $socio->nombres }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label for="tipo_maquinaria">Tipo de Maquinaria</label>
                    <select name="tipo_maquinaria" id="tipo_maquinaria" class="form-control" required>
                        <option value="">Seleccione tipo</option>
                        <option value="maquinaria agrícola">Maquinaria Agrícola</option>
                        <option value="maquinaria pesada">Maquinaria Pesada</option>
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label>Monto por Hora (Bs)</label>
                    <input type="number" step="0.01" min="0" name="monto_por_hora" id="monto_por_hora" class="form-control" required>
                </div>

                <div class="form-group mt-2">
                    <label>Horas Requeridas</label>
                    <input type="number" step="0.01" min="0" name="horas_requeridas" id="horas_requeridas" class="form-control" required>
                </div>

                <div class="form-group mt-2">
                    <label>Total (Bs)</label>
                    <input type="text" name="total" id="total" class="form-control" readonly>
                </div>

                <div class="form-group mt-2">
                    <label>Fecha del Aporte</label>
                    <input type="date" name="fecha_aporte" class="form-control" required>
                </div>

                <div class="form-group mt-2">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="card-footer text-end">
                <a href="{{ route('aportes-maquinaria.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar Aporte</button>
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
