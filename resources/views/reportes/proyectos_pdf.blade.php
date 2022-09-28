<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Reporte de proyectos</title>
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
                    <h2 style="margin: 0px">Reporte de proyectos</h2>
                    <small style="font-size: 18px">Tipo de proyecto {{ $tipo }}</small>
                </td>
            </tr>
        </table>

        <br><br>
        @if ($tipo == 'general')
            <table width="100%" border="1" cellpadding="3">
                <thead>
                    <tr>
                        <th>N&deg;</th>
                        <th>Afiliado</th>
                        <th>Proyecto</th>
                        <th>Categoría</th>
                        <th>Precio Unit.</th>
                        <th>Superficie</th>
                        <th>Total</th>
                        <th>Fecha de registro</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $cont = 1;
                    @endphp
                    @forelse ($proyectos as $item)
                        <tr>
                            <td>{{ $cont }}</td>
                            <td>{{ $item->persona->full_name }}</td>
                            <td>{{ $item->proyecto }}</td>
                            <td>{{ $item->categoriageneral->nombre }}</td>
                            <td>{{ $item->costocategoria }}</td>
                            <td>{{ $item->superficiemts2 }}</td>
                            <td>{{ $item->totalbs }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->fecharegistro)) }}</td>
                        </tr>
                        @php
                            $cont++;
                        @endphp
                    @empty
                        <tr>
                            <td colspan="8"><h5>No hay resultados</h5></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @else
            <table width="100%" border="1" cellpadding="3">
                <thead>
                    <tr>
                        <th>N&deg;</th>
                        <th>Afiliado</th>
                        <th>Proyecto</th>
                        <th>Precio Unit.</th>
                        <th>Superficie</th>
                        <th>Total</th>
                        <th>Fecha de registro</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $cont = 1;
                    @endphp
                    @forelse ($proyectos as $item)
                        <tr>
                            <td>{{ $cont }}</td>
                            <td>{{ $item->persona->full_name }}</td>
                            <td>{{ $item->proyecto }}</td>
                            <td>{{ number_format($item->costo_pu_categoria, 2, ',', '.') }}</td>
                            <td>{{ $item->superficiemts2 }}</td>
                            <td>{{ number_format($item->totalbs, 2, ',', '.') }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->fecharegistro)) }}</td>
                        </tr>
                        @php
                            $cont++;
                        @endphp
                    @empty
                        <tr>
                            <td colspan="7"><h5>No hay resultados</h5></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif
    </body>
</html>