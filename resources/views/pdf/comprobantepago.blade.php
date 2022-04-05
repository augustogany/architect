<!DOCTYPE html>
<html>
<head>
    <title>Comprabante de Pago de Mensualidades</title>

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
        <p>COLEGIO DE ARQUITECTOS DEL BENI<br>COMPROBANTE DE PAGO DE MENSUALIDADES<br>{{$deudas->sucursal->sucursal}}, <?php $time = time(); echo date("d-m-Y (H:i:s)", $time); ?></p>
    </header>

   <table cellspacing="0" width="100%" align="center" border="1" style="font-size: 8pt">
        <thead>
            <tr>
                <th colspan="3">Arquitecto: {{$deudas->persona->nombre}} {{$deudas->persona->apaterno}} {{$deudas->persona->amaterno}}</th>
                <th colspan="3">Tipo Pago: {{$deudas->tipopago->nombrepago}}</th>
            </tr>
            <tr>
                <th scope="col">Monto Global</th>
                <th>Monto Pagado</th>
                <th>Monto Restantes</th>
                <th>Total Cuotas</th>
                <th>Cuotas Pagadas</th>
                <th>Cuotas Restantes</th>
            </tr>
        </thead>
        <tbody>
            <?php $cuotasrestantes = 0;?>
            <?php $cuotasrestantes += $deudas->tipopago->cuotas-$cuotaspagadas; ?>
            <tr>
                <td>{{$deudas->tipopago->monto}} Bs.</td>
                @foreach($montopagados as $montopagado)
                <?php $montorestante = 0;?>
                <?php $montorestante += $deudas->tipopago->monto-$montopagado->montopagado; ?>
                    <td>{{$montopagado->montopagado}} Bs.</td>
                    <td>{{$montorestante}} Bs.</td>
                @endforeach
                <td>{{$deudas->tipopago->cuotas}}</td>
                <td>{{$cuotaspagadas}}</td>
                <td>{{$cuotasrestantes}}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table cellspacing="0" width="100%" align="center" border="1" style="font-size: 8pt">
        <thead>
            <tr>
                <th colspan="5">DETALLE DE PAGO</th>
                
            </tr>
            <tr>
                <th scope="col">Item</th>
                <th>Mes de Pago</th>
                <th>Monto Mes</th>
                <th>Observación</th>
                <th>Fecha Pago</th>
            </tr>
        </thead>
        <tbody>
            <?php $numeroitems = 0;?>
            @foreach($deudas->detalledeudas as $det_deuda)
            <?php $numeroitems++ ?>
            <tr>
                <td>{{$numeroitems}}</td>
                <td>{{$det_deuda->mes->nombre}}</td>
                <td>{{$det_deuda->preciomes}}</td>
                <td>{{$det_deuda->observacioncuota}}.</td>
                <td>{{$det_deuda->fechapagomes}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br><br><br>
    <div class="row">
        <table width="100%" align="center" style="font-size: 8pt">
            <tr>
                <th>.........................................................:</th>
                <th>.........................................................:</th>
            </tr>
            <tr>
                <td>CAJERO: {{ Auth::user()->name }}</td>
                <td>AFILIADO: {{$deudas->persona->nombre}} {{$deudas->persona->apaterno}} {{$deudas->persona->amaterno}}</td>
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

