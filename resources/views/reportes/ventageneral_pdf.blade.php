<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Reporte de ventas General</title>
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
                    <h2 style="margin: 0px">Reporte diario de Ingresos</h2>
                </td>
            </tr>
        </table>

        <br><br>
        <table width="100%" border="1" cellpadding="3">
            <thead>
                <tr>
                    <th colspan='7'>VENTA DE CARPETAS</th>
                </tr>
                <tr>
                    <th>N&deg;</th>
                    <th>ARQUITECTO</th>
                    <th>TIPO PAGO</th>
                    <th>TIPO CARPETA</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cont = 1;
                    $total = 0;
                @endphp
                @forelse ($ventas as $item)
                    @php
                        $subtotal = 0;
                        $subtotal += ($item->precio * $item->cantidad) - $item->descuento;
                    @endphp
                    <tr>
                        <td>{{ $cont }}</td>
                        <td>{{ $item->persona->full_name }}</td>
                        <td>{{ $item->tipo }}</td>
                        <td>{{ $item->servicio}}</td>
                        <td>{{ $item->cantidad}}</td>
                        <td>{{ $item->precio}}</td>
                        <td style="text-align:right">{{ number_format($subtotal, 2, ',', '.') }}</td>
                    </tr>
                    @php
                        $cont++;
                        $total += $subtotal;
                    @endphp
                @empty
                    <tr>
                        <td colspan="7"><h5>No hay resultados</h5></td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="6"><b>TOTAL</b></td>
                    <td style="text-align:right"><b>{{ number_format($total, 2, ',', '.') }}</b></td>
                </tr>
            </tbody>
        </table>

        <br><br>
        <table width="100%" border="1" cellpadding="3">
            <thead>
                <tr>
                    <th colspan='5'>VENTA DE PROYECTO Y VISACIONES</th>
                </tr>
                <tr>
                    <th>N&deg;</th>
                    <th>ARQUITECTO</th>
                    <th>PROYECTO/VISACION</th>
                    <th>PRECIO</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cont = 1;
                    $total_proy=$proyectos->sum('total');
                @endphp
                @forelse ($proyectos as $item)
                    <tr>
                        <td>{{ $cont }}</td>
                        <td>{{ $item->persona->full_name }}</td>
                        <td>{{ $item->proyecto }}</td>
                        <td>{{ number_format($item->costo, 2, ',', '.') }}</td>
                        <td>{{ number_format($item->total, 2, ',', '.') }}</td>
                    </tr>
                    @php
                        $cont++;
                        
                    @endphp
                @empty
                    <tr>
                        <td colspan="5"><h5>No hay resultados</h5></td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="4"><b>TOTAL</b></td>
                    <td style="text-align: right"><b>{{ number_format($total_proy, 2, ',', '.') }}</b></td>
                </tr>
            </tbody>
        </table>
            <br><br>
        <table width="100%" border="1" cellpadding="3">
            <thead>
                <tr>
                    <th colspan='5'>MENSUALIDADES DEPARTAMENTALES</th>
                </tr>
                <tr>
                    <th>N&deg;</th>
                    <th>ARQUITECTO</th>
                    <th>TIPO CUOTA</th>
                    <th>NRO CUOTAS</th>
                    <th>MONTO TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cont = 1;
                    $total_mes = 0;
                @endphp
                @forelse ($pagos as $item)
                    <tr>
                        <td>{{ $cont }}</td>
                        <td>{{ $item->persona->full_name }}</td>
                        <td>{{$item->tipo}}</td>
                        <td style="text-align: right">{{$item->mensualidades->count()}}</td>
                        <td style="text-align: right">{{ $item->mensualidades->sum('monto_pagado') - $item->descuento }}</td>
                    </tr>
                    @php
                        $cont++;
                        $total_mes += $item->mensualidades->sum('monto_pagado') - $item->descuento;
                    @endphp
                @empty
                    <tr>
                        <td colspan="5"><h5 class="text-muted text-center">No hay resultados</h5></td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="4"><b>TOTAL</b></td>
                    <td style="text-align: right"><b>{{ number_format($total_mes, 2, ',', '.') }}</b></td>
                </tr>
            </tbody>
        </table>
        <br>
        <table width="100%" border="1" cellpadding="3">
            <thead>
                <tr>
                    <th colspan='5'>MENSUALIDADES NACIONALES</th>
                </tr>
                <tr>
                    <th>N&deg;</th>
                    <th>ARQUITECTO</th>
                    <th>TIPO CUOTA</th>
                    <th>NRO CUOTAS</th>
                    <th>MONTO TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cont = 1;
                    $total_year = 0;
                @endphp
                @forelse ($pagos_anual as $item)
                    <tr>
                        <td>{{ $cont }}</td>
                        <td>{{ $item->persona->full_name }}</td>
                        <td>{{$item->tipo}}</td>
                        <td style="text-align: right">{{$item->cuotas}}</td>
                        <td style="text-align: right">{{ $item->monto }}</td>
                    </tr>
                    @php
                        $cont++;
                        $total_year += $item->monto;
                    @endphp
                @empty
                    <tr>
                        <td colspan="5"><h5 class="text-muted text-center">No hay resultados</h5></td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="4"><b>TOTAL</b></td>
                    <td style="text-align: right"><b>{{ number_format($total_year, 2, ',', '.') }}</b></td>
                </tr>
            </tbody>
        </table>
        <br>
        <table width="100%" border="1" cellpadding="3">
            @php
                $total_suma=$total+$total_mes+$total_proy+$total_year;
            @endphp
            <tr>
                <th colspan="4" style="text-align: left"><b>SUMA TOTA</b>L</th>
                <th style="text-align: rigth">{{ number_format($total_suma,2,',','.')}}</th>
            </tr>
        </table>
    </body>
</html>