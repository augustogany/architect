<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recibo de pago</title>
    <link rel="shortcut icon" href="{{ asset('theme/dist/img/logo.png') }}" type="image/x-icon">

    <style>
        body {
            margin: 0px;
            font-family: 'Trebuchet MS', sans-serif;
        }
        .header{
            padding: 30px 20px;
            background-color: rgb(233, 233, 233);
            /* margin-bottom: 40px */
        }
        .header p{
            margin: 0px;
            font-size: 10px
        }
        td {
            vertical-align: top;
        }
        .body table{
            border-collapse: collapse;
        }
        .body th{
            background-color: rgb(143, 143, 143);
            color: white;
            font-size: 11px
        }
    </style>
</head>
<body>
    <div class="header">
        <table style="width: 100%">
            <tr>
                <td style="width: 80px">
                    <img src="{{ asset('theme/dist/img/logo.png') }}" width="70px" alt="CADBENI">
                </td>
                <td>
                    <span><b style="font-size: 20px">CADBENI</b></span>
                    <p>COLEGIO DE ARQUITECTOS DEL BENI</p>
                    <p>456464 - 785454</p>
                    <p>Av. 6 de agosto N&deg; 454, zona Central</p>
                    <p>Santísima Trinidad - Beni - Bolivia</p>
                </td>
                <td style="text-align: right">
                    <h2 style="margin: 0px">RECIBO DE PAGO</h2>
                    <span style="color: red">N&deg; {{ str_pad($pago->id, 5, "0", STR_PAD_LEFT) }}</span> <br>
                    <small>Impreso {{ date('d/m/Y H:i') }}</small>
                </td>
            </tr>
        </table>
    </div>
    <div style="margin: 30px">
        <b>RECIBO PARA:</b>
        <hr>
        <table style="width: 100%">
            <tr>
                <td style="width: 200px"><b><small>N&deg; de registro:</small></b></td>
                <td>{{ $pago->persona->numeroregistro }}</td>
            </tr>
            <tr>
                <td style="width: 200px"><b><small>Nombre completo:</small></b></td>
                <td>{{ $pago->persona->nombre }} {{ $pago->persona->apaterno }} {{ $pago->persona->amaterno }}</td>
            </tr>
            <tr>
                <td style="width: 200px"><b><small>Cédula de identidad:</small></b></td>
                <td>{{ $pago->persona->ci }}</td>
            </tr>
        </table>
    </div>
    <div class="body">
        <table border="1" style="width: 100%" cellpadding="5">
            <thead>
                <tr>
                    <th>N&deg;</th>
                    <th>DESCRIPCIÓN</th>
                    <th>SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        @php
                            $mes = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
                            $detalles = '';
                            if($pago->mensualidades->count() == 1){
                                $detalles = 'mensualidad ('.$mes[$pago->mensualidades->first()->mes].' de '.$pago->mensualidades->last()->gestion->gestion.')';
                            }elseif($pago->mensualidades->count() == 2){
                                $detalles = 'mensualidades ('.$mes[$pago->mensualidades->first()->mes].' y '.$mes[$pago->mensualidades->last()->mes].' de '.$pago->mensualidades->last()->gestion->gestion.')';
                            }else{
                                $detalles = 'mensualidades ('.$mes[$pago->mensualidades->first()->mes].' a '.$mes[$pago->mensualidades->last()->mes].' de '.$pago->mensualidades->last()->gestion->gestion.')';
                            }
                        @endphp
                        Pago de {{ $pago->mensualidades->count() }} {{ $detalles }}
                    </td>
                    <td style="text-align: right">{{ number_format($pago->mensualidades->sum('monto_pagado'), 2, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="text-align: right"><small>SUBTOTAL</small></td>
                    <td style="text-align: right; background-color:#ccc"><b>{{ number_format($pago->mensualidades->sum('monto_pagado'), 2, ',', '.') }}</b></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right"><small>DESC.</small></td>
                    <td style="text-align: right; background-color:#ccc"><b>{{ number_format($pago->descuento, 2, ',', '.') }}</b></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right"><small>TOTAL</small></td>
                    <td style="text-align: right; background-color:#ccc"><b>{{ number_format($pago->mensualidades->sum('monto_pagado') - $pago->descuento, 2, ',', '.') }}</b></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>