<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Comprobante PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .titulo {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 10px;
        }

        .box {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid #000;
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <div class="titulo">COMPROBANTE DE APORTE POR MAQUINARIA</div>

    <div class="info"><strong>Recibí de:</strong> {{ $aporte->socio->apellidos }} {{ $aporte->socio->nombres }}</div>
    <div class="info"><strong>Cantidad:</strong> {{ number_format($aporte->total, 2) }} Bs</div>
    <div class="info"><strong>Cantidad literal:</strong>
    </div>
    <div class="info"><strong>Concepto:</strong> Uso de {{ $aporte->tipo_maquinaria }} —
        {{ $aporte->descripcion ?? 'sin descripción' }}</div>
    <div class="info"><strong>Horas:</strong> {{ $aporte->horas_requeridas }} h a
        {{ number_format($aporte->monto_por_hora, 2) }} Bs/h</div>
    <div class="info"><strong>Fecha:</strong> {{ $aporte->fecha_aporte }}</div>

    <div class="info" style="margin-top: 20px;">
        <strong>Forma de pago:</strong><br>
        <span class="box"></span> Efectivo
        <span style="margin-left: 40px;"></span>
        <span class="box"></span> Transferencia
    </div>

    <div style="margin-top: 40px; text-align: right;">
        <strong>Recibido por: __________________________</strong>
    </div>

</body>

</html>
