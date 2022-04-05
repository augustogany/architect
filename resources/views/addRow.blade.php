<!DOCTYPE html>
<html>
<head>
    <title>Venta de Servicios</title>

</head>
<style>

    /*centrado de datos th + td*/
    table th {
        text-align: center;
    }

    /*centrado de datos th + td*/
    table td {
        text-align: center;
    }

    /*Margenes*/
    @page {
        margin: 0cm 0cm;
        font-size: 1em;
    }

    /*Margenes*/
    body {
        margin: 2.5cm 1cm 1cm;
    }

    /*Encabezado del Reporte (Titulos)*/
    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
        background-color: #46C66B;
        color: white;
        text-align: center;
        line-height: 15px;
    }

</style>
<body>
    <header>
        <p>COLEGIO DE ARQUITECTOS DEL BENI<br>DETALLE DE PAGO DE DEUDAS - ARQUITECTOS CADBENI<br>{{$sucursal->sucursal}}, <?php $time = time(); echo date("d-m-Y (H:i:s)", $time); ?></p>
    </header>

    @foreach($ventaservicios as $venServicio)
        @if($venServicio->detalleventaservicios->count()>0)
    <table cellspacing="0" width="100%" align="center" border="1" style="font-size: 8pt">
        <thead>
            <tr>
                <th colspan="6">Servicio: {{$venServicio->nombre}}</th>
            </tr>
            <tr>
                <th scope="col" width="25pt">Nro.</th>
                <th width="200pt">Arquitecto</th>
                <th width="60pt">Fecha Compra</th>
                <th>Precio Actual</th>
                <th>Cantidad</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $numeroitems = 0; $ventaimporte_parcial = 0;?>
            @foreach($venServicio->detalleventaservicios as $detventa)
            <?php $ventaimporte_parcial += $detventa->precioservicio*$detventa->cantidad; ?>
            <?php $numeroitems++ ?>
            <tr>
                <td>{{$numeroitems}}</td>
                <td>{{$detventa->ventaservicio->persona->nombre}} {{$detventa->ventaservicio->persona->apaterno}} {{$detventa->ventaservicio->persona->amaterno}}</td>
                <td>{{$detventa->ventaservicio->fecharegistro}}</td>
                <td>{{$detventa->precioservicio}}</td>
                <td>{{$detventa->cantidad}}</td>
                <td>{{$detventa->precioservicio*$detventa->cantidad}} Bs.</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <table width="100%" align="center" style="font-size: 8pt">
            <tr>
                <th style="text-align: right">Importe Servicio: {{NumerosEnLetras::convertir($ventaimporte_parcial,'Bolivianos',true)}}</th>
            </tr>
        </table>
    </div>
    <br>
        @endif
    @endforeach

    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(270, 820, "Pág $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }
    </script>

</body>
</html>

