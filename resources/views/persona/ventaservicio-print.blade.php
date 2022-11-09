<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recibo de venta</title>
    <link rel="shortcut icon" href="{{ asset('theme/dist/img/logo.png') }}" type="image/x-icon">

    <style>
        body {
            margin: 0px;
            font-family: 'Trebuchet MS', sans-serif;
            font-size: 11px
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
                    <p>346 - 21299</p>
                    <p>Avenida 6 de agosto #541 - Zona San Antonio</p>
                    <p>Santísima Trinidad - Beni - Bolivia</p>
                </td>
                <td style="text-align: right">
                    <h3 style="margin: 0px">RECIBO DE VENTA</h3>
                    <span style="color: red">N&deg; {{ str_pad($venta->id, 5, "0", STR_PAD_LEFT) }}</span> <br>
                    <small>Impreso {{ date('d/m/Y H:i') }}</small>
                </td>
            </tr>
        </table>
    </div>
    <div style="margin: 20px">
        <b>RECIBO PARA:</b>
        <hr>
        <table style="width: 100%">
            <tr>
                <td style="width: 200px"><b><small>N&deg; de registro:</small></b></td>
                <td>{{ $venta->persona->numeroregistro }}</td>
            </tr>
            <tr>
                <td style="width: 200px"><b><small>Nombre completo:</small></b></td>
                <td>{{ $venta->persona->nombre }} {{ $venta->persona->apaterno }} {{ $venta->persona->amaterno }}</td>
            </tr>
            <tr>
                <td style="width: 200px"><b><small>Cédula de identidad:</small></b></td>
                <td>{{ $venta->persona->ci ?? '' }}</td>
            </tr>
            <tr>
                <td style="width: 200px"><b><small>Fecha:</small></b></td>
                <td>{{ date('d/m/Y', strtotime($venta->fecharegistro)) }}</td>
            </tr>
        </table>
    </div>
    <div class="body">
        <table border="1" style="width: 100%" cellpadding="3">
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
                    $cont = 1;
                    $total = 0;
                @endphp
                @foreach ($venta->detalle as $item)
                    <tr>
                        <td>{{ $cont }}</td>
                        <td>{{ $item->servicio->nombre }}</td>
                        <td style="text-align: right">{{ number_format($item->precio, 2, ',', '.') }}</td>
                        <td style="text-align: right">{{ intval($item->cantidad) }}</td>
                        <td style="text-align: right">{{ number_format($item->precio * $item->cantidad, 2, ',', '.') }}</td>
                    </tr>
                    @php
                        $cont++;
                        $total += $item->precio * $item->cantidad;
                    @endphp
                @endforeach

                @if ($venta->persona_pago)
                    {{-- {{ dd($venta->persona_pago->mensualidades) }} --}}
                    <tr>
                        <td>{{ $cont }}</td>
                        <td>
                            @php
                                $mes = ['', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
                                $detalles = '';
                                if($venta->persona_pago->mensualidades->count() == 1){
                                    $detalles = 'mensualidad ('.$mes[$venta->persona_pago->mensualidades->first()->mes].' de '.$venta->persona_pago->mensualidades->last()->gestion->gestion.')';
                                }elseif($venta->persona_pago->mensualidades->count() == 2){
                                    $detalles = 'mensualidades ('.$mes[$venta->persona_pago->mensualidades->first()->mes].' y '.$mes[$venta->persona_pago->mensualidades->last()->mes].' de '.$venta->persona_pago->mensualidades->last()->gestion->gestion.')';
                                }else{
                                    $detalles = 'mensualidades ('.$mes[$venta->persona_pago->mensualidades->first()->mes].' a '.$mes[$venta->persona_pago->mensualidades->last()->mes].' de '.$venta->persona_pago->mensualidades->last()->gestion->gestion.')';
                                }
                            @endphp
                            Pago de {{ $venta->persona_pago->mensualidades->count() }} {{ $detalles }}
                        </td>
                        <td style="text-align: right">{{ number_format($venta->persona_pago->mensualidades[0]->monto_pagado, 2, ',', '.') }}</td>
                        <td style="text-align: right">{{ $venta->persona_pago->mensualidades->count() }}</td>
                        <td style="text-align: right">{{ number_format($venta->persona_pago->mensualidades->sum('monto_pagado'), 2, ',', '.') }}</td>
                    </tr>
                    @php
                        $cont++;
                        $total += $venta->persona_pago->mensualidades->sum('monto_pagado');
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