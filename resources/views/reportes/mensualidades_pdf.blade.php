<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Reporte de mensualidades</title>
        <style>
            body {
                margin: 0px;
                font-family: Tahoma, sans-serif;
            }
            table {
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
        @php
            $imagen = asset('assets/img/logo.jpeg');
        @endphp

        <div style="width: 100%; text-align:center; position: fixed; top: 250px; z-index: -1; opacity: 0.1">
            <img src="{{ $imagen }}" alt="CADBENI" style="width: 350px">
        </div>

        {{-- header --}}
        <table width="100%">
            <tr>
                <td>
                    <div style="display: flex;">
                        <div style="margin-right: 10px">
                            <img src="{{ $imagen }}" alt="CADBENI" style="width: 60px">
                        </div>
                        <div>
                            <span><b>CADBENI</b></span><br>
                            <div><small style="color: #5D6D7E;">75199157 - 65784598</small><br></div>
                            <div style="margin-top: -5px"><small style="color: #5D6D7E;">Av. 6 de agosto N&deg; 123</small><br></div>
                            <div style="margin-top: -5px"><small style="color: #5D6D7E;">Santísima Trinidad Beni - Bolivia</small><br></div>
                        </div>
                    </div>
                </td>
                <td style="text-align: right">
                    <h2 style="margin: 0px">Reporte de mensualidades</h2>
                    {{-- <small style="font-size: 20px">Tipo de proyecto {{ $tipo }}</small> --}}
                </td>
            </tr>
        </table>

        <br><br>
        <table width="100%" border="1" cellpadding="3">
            <thead>
                <tr>
                    <th>N&deg;</th>
                    <th>Fecha de registro</th>
                    <th>Cantidad de mensualidades</th>
                    <th>Descuento</th>
                    <th>Monto pagado</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cont = 1;
                @endphp
                @forelse ($pagos as $item)
                    <tr>
                        <td>{{ $cont }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->fecha_pago)) }}</td>
                        <td>
                            <ul>
                                @foreach ($item->mensualidades as $mensualidad)
                                <li>{{ $mensualidad->mes }}/{{ $mensualidad->gestion->gestion }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $item->descuento }}</td>
                        <td>{{ $item->mensualidades->sum('monto_pagado') - $item->descuento }}</td>
                    </tr>
                    @php
                        $cont++;
                    @endphp
                @empty
                    <tr>
                        <td colspan="5"><h5 class="text-muted text-center">No hay resultados</h5></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </body>
</html>