<!DOCTYPE html>
<html>
<head>
    <title>Comprabante de Venta de Servicios</title>

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
        margin: 3cm 1cm 1cm;
    }

    /*Encabezado del Reporte (Titulos)*/
    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2.3cm;
        background-color: #46C66B;
        color: white;
        text-align: center;
        line-height: 15px;
    }

</style>
<body>
    <header>
        <p>COLEGIO DE ARQUITECTOS DEL BENI<br>COMPROBANTE DE VENTA DE SERVICIOS<br>{{$ventaservicios->sucursal->sucursal}}, <?php $time = time(); echo date("d-m-Y (H:i:s)", $time); ?></p>
    </header>

   <table cellspacing="0" width="100%" align="center" border="1" style="font-size: 8pt">
        <thead>
            <tr>
                <th colspan="3">Arquitecto CADBENI: {{$ventaservicios->persona->nombre}} {{$ventaservicios->persona->apaterno}} {{$ventaservicios->persona->amaterno}}</th>
            </tr>
            <tr>
                <th scope="col">Fecha Venta</th>
                <th>Gestión</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            <?php $cuotasrestantes = 0;?>
            
            <tr>
                <td>{{$ventaservicios->fecharegistro}}</td>
                <td>{{$ventaservicios->gestion}}</td>
                <td>{{$ventaservicios->observacion}}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table cellspacing="0" width="100%" align="center" border="1" style="font-size: 8pt">
        <thead>
            <tr>
                <th colspan="7">DETALLE CONCEPTO DE VENTAS</th>
                
            </tr>
            <tr>
                <th scope="col">Item</th>
                <th>Concepto de Pago</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Observación</th>
                <th>Fecha Pago</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $numeroitems = 0; $totalVenta = 0; ?>
            @foreach($ventaservicios->detalleventaservicios as $detventa)
            <?php $totalVenta += $detventa->precioservicio*$detventa->cantidad; ?>
            <?php $numeroitems++ ?>
            <tr>
                <td>{{$numeroitems}}</td>
                <td>{{$detventa->servicio->nombre}}</td>
                <td>{{$detventa->precioservicio}}</td>
                <td>{{$detventa->cantidad}}</td>
                <td>{{$detventa->observacionventa}}</td>
                <td>{{$detventa->fechapagoservicio}}</td>
                <td>{{$detventa->precioservicio*$detventa->cantidad}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <table width="100%" align="center" style="font-size: 8pt">
            <tr>
                <th style="text-align: right">Total Importe de Venta: {{NumerosEnLetras::convertir($totalVenta,'Bolivianos',true)}}</th>
            </tr>
        </table>
    </div>
    <br><br><br><br>
    <div class="row">
        <table width="100%" align="center" style="font-size: 8pt">
            <tr>
                <th>.........................................................:</th>
                <th>.........................................................:</th>
            </tr>
            <tr>
                <td>CAJERO: {{ Auth::user()->name }}</td>
                <td>AFILIADO: {{$ventaservicios->persona->nombre}} {{$ventaservicios->persona->apaterno}} {{$ventaservicios->persona->amaterno}}</td>
            </tr>
        </table>
    </div>

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

