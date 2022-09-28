<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recibo de proyecto general</title>
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
                    <h3 style="margin: 0px">RECIBO DE PROYECTO GENERAL</h3>
                    <span style="color: red">N&deg; {{ str_pad($proyecto->id, 5, "0", STR_PAD_LEFT) }}</span> <br>
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
                <td>{{ $proyecto->persona->numeroregistro }}</td>
            </tr>
            <tr>
                <td style="width: 200px"><b><small>Nombre completo:</small></b></td>
                <td>{{ $proyecto->persona->nombre }} {{ $proyecto->persona->apaterno }} {{ $proyecto->persona->amaterno }}</td>
            </tr>
            <tr>
                <td style="width: 200px"><b><small>Cédula de identidad:</small></b></td>
                <td>{{ $proyecto->persona->ci ?? '' }}</td>
            </tr>
            <tr>
                <td style="width: 200px"><b><small>Propietario del proyecto:</small></b></td>
                <td>{{ $proyecto->propietario }}</td>
            </tr>
        </table>
    </div>
    <div class="body">
        <table border="1" style="width: 100%" cellpadding="5">
            <thead>
                <tr>
                    <th>N&deg;</th>
                    <th>DESCRIPCIÓN</th>
                    <th>PRECIO UNIT.</th>
                    <th>CANT.</th>
                    <th>SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                <tr>
                    <td>1</td>
                    <td>{{ $proyecto->proyecto }}</td>
                    <td style="text-align: right">{{ number_format($proyecto->costocategoria, 2, ',', '.') }}</td>
                    <td style="text-align: right">{{ intval($proyecto->superficiemts2) }}</td>
                    <td style="text-align: right">{{ number_format($proyecto->totalbs, 2, ',', '.') }}</td>
                </tr>
                @php
                    $total += $proyecto->totalbs;
                @endphp

                @if ($proyecto->persona_pago)
                    <tr>
                        <td>2</td>
                        <td>
                            @php
                                $mes = ['', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
                                $detalles = '';
                                if($proyecto->persona_pago->mensualidades->count() == 1){
                                    $detalles = 'mensualidad ('.$mes[$proyecto->persona_pago->mensualidades->first()->mes].' de '.$proyecto->persona_pago->mensualidades->last()->gestion->gestion.')';
                                }elseif($proyecto->persona_pago->mensualidades->count() == 2){
                                    $detalles = 'mensualidades ('.$mes[$proyecto->persona_pago->mensualidades->first()->mes].' y '.$mes[$proyecto->persona_pago->mensualidades->last()->mes].' de '.$proyecto->persona_pago->mensualidades->last()->gestion->gestion.')';
                                }else{
                                    $detalles = 'mensualidades ('.$mes[$proyecto->persona_pago->mensualidades->first()->mes].' a '.$mes[$proyecto->persona_pago->mensualidades->last()->mes].' de '.$proyecto->persona_pago->mensualidades->last()->gestion->gestion.')';
                                }
                            @endphp
                            Pago de {{ $proyecto->persona_pago->mensualidades->count() }} {{ $detalles }}
                        </td>
                        <td style="text-align: right">{{ number_format($proyecto->persona_pago->mensualidades[0]->monto_pagado, 2, ',', '.') }}</td>
                        <td style="text-align: right">{{ $proyecto->persona_pago->mensualidades->count() }}</td>
                        <td style="text-align: right">{{ number_format($proyecto->persona_pago->mensualidades->sum('monto_pagado'), 2, ',', '.') }}</td>
                    </tr>
                    @php
                        $total += $proyecto->persona_pago->mensualidades->sum('monto_pagado');
                    @endphp
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right"><small>SUBTOTAL</small></td>
                    <td style="text-align: right; background-color:#ccc"><b>{{ number_format($total, 2, ',', '.') }}</b></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right"><small>DESC.</small></td>
                    <td style="text-align: right; background-color:#ccc"><b>{{ number_format(0, 2, ',', '.') }}</b></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right"><small>TOTAL</small></td>
                    <td style="text-align: right; background-color:#ccc"><b>{{ number_format($total, 2, ',', '.') }}</b></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>