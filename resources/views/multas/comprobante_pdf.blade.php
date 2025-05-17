<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Comprobante de Multa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #004080;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #004080;
            font-size: 24px;
            margin: 0;
        }

        .datos-recibo {
            border: 1px solid #004080;
            padding: 10px;
            margin-bottom: 20px;
        }

        .fila {
            margin-bottom: 10px;
        }

        .negrita {
            font-weight: bold;
        }

        .formato-pago {
            margin-top: 20px;
        }

        .firmado {
            margin-top: 40px;
            text-align: right;
        }

        .cuadro {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid #000;
            margin-right: 5px;
        }

        .marca {
            font-weight: bold;
        }

        .azul {
            background-color: #e6f0ff;
        }

        table {
            width: 100%;
        }

        .titulo-box {
            background-color: #004080;
            color: white;
            padding: 4px 8px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div>
            <h2 style="text-align: center;">
                ASOCIACION DE PRODUCTORES REGANTES AREA DE INFLUENCIA "SAN JACINTO"
            </h2>

            <p>E-mail: contacto@asociacion.org</p>
            <p>Dirección: Oficinas central, zona el Portillo Tarija</p>
        </div>
        <div>
            <table>
                <tr>
                    <td class="titulo-box">RECIBO #</td>
                    <td class="azul">{{ $multa->id }}</td>
                </tr>
                <tr>
                    <td class="titulo-box">FECHA</td>
                    <td class="azul">{{ \Carbon\Carbon::parse($multa->fecha_pago)->format('d/m/Y') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="datos-recibo">
        <div class="fila"><span class="negrita">Recibí de:</span> {{ $multa->socio->nombres }}
            {{ $multa->socio->apellidos }}</div>

        <div class="fila">
            <span class="negrita">Cantidad:</span> Bs {{ number_format($multa->monto, 2, '.', ',') }}
        </div>


        <div class="fila">
            <span class="negrita">Por concepto de :</span> Inasistencia en {{ optional($multa->reunion)->nombre }} en
            fecha
            {{ optional($multa->reunion)->fecha }}
        </div>

        <div class="formato-pago">
            <span class="negrita">Forma de pago:</span>
            <span class="cuadro"></span> Efectivo
            <span style="margin-left: 20px;"></span>
            <span class="cuadro"></span> Transferencia
        </div>

        <div class="firmado">
            <p>Recibido por: __________________________</p>
        </div>
    </div>

</body>

</html>
