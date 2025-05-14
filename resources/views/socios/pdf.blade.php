<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha del Socio</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .section { margin-bottom: 15px; }
        .label { font-weight: bold; }
        .badge { padding: 3px 6px; background-color: #17a2b8; color: white; border-radius: 3px; }
    </style>
</head>
<body>
    <h2>Detalle del Socio</h2>
    <div class="section">
        <p><span class="label">Nombres:</span> {{ $socio->nombres }}</p>
        <p><span class="label">Apellidos:</span> {{ $socio->apellidos }}</p>
        <p><span class="label">CI:</span> {{ $socio->ci }}</p>
        <p><span class="label">Teléfono:</span> {{ $socio->telefono }}</p>
        <p><span class="label">Fecha de nacimiento:</span> {{ \Carbon\Carbon::parse($socio->fecha_nacimiento)->format('d/m/Y') }}</p>
        <p><span class="label">Tipo de ingreso:</span> {{ ucfirst($socio->tipo_ingreso) }}</p>
        <p><span class="label">Código socio:</span> {{ $socio->codigo_socio }}</p>
        <p><span class="label">Superficie total:</span> {{ $socio->superficie_total }} ha</p>
        <p><span class="label">Superficie riego:</span> {{ $socio->superficie_riego }} ha</p>
        <p><span class="label">Sistema:</span> {{ $socio->sistema }}</p>
        <p><span class="label">N° turnos:</span> {{ $socio->numero_turnos }}</p>
        <p><span class="label">¿Tercera edad?:</span> {{ $socio->es_tercera_edad ? 'Sí' : 'No' }}</p>
        <p><span class="label">Estado:</span> {{ ucfirst($socio->estado) }}</p>
        <p><span class="label">Fecha de ingreso:</span> {{ \Carbon\Carbon::parse($socio->fecha_ingreso)->format('d/m/Y') }}</p>
    </div>

    <div class="section">
        <p><span class="label">Canales asignados:</span>
            @foreach($socio->canales as $canal)
                <span class="badge">{{ $canal->nombre }}</span>
            @endforeach
        </p>
    </div>

    <div class="section">
        <p><span class="label">Creado por:</span> {{ $socio->creador?->name ?? 'Desconocido' }}</p>
        <p><span class="label">Editado por:</span> {{ $socio->editor?->name ?? 'Desconocido' }}</p>
        <p><span class="label">Fecha de creación:</span> {{ $socio->created_at->format('d/m/Y H:i') }}</p>
        <p><span class="label">Última actualización:</span> {{ $socio->updated_at->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
