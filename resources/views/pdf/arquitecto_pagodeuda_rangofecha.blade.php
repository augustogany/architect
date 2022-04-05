<!DOCTYPE html>
<html>
<head>
    <title>Pago de Mensualidades</title>

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

    @foreach($pagodeudas as $pagodeuda)
    <table cellspacing="0" width="100%" align="center" border="1" style="font-size: 8pt">
        <thead>
            <tr>
                <th colspan="2">Arquitecto: {{$pagodeuda->persona->nombre}} {{$pagodeuda->persona->aparterno}} {{$pagodeuda->persona->amaterno}}</th>
                <th colspan="2">Tipo Pago: {{$pagodeuda->tipopago->nombrepago}}</th>
            </tr>
            <tr>
                <th scope="col" width="25pt">Nro.</th>
                <th>Fecha Pago</th>
                <th>Mes de Pago</th>
                <th>Monto Mes</th>
            </tr>
        </thead>
        <tbody>
            <?php $numeroitems = 0; $deudaparcial_Pago = 0;?>
            @foreach($pagodeuda->detalledeudas as $detpago)
            <?php $deudaparcial_Pago += $detpago->totalbs; ?>
            <?php $numeroitems++ ?>
            <tr>
                <td>{{$numeroitems}}</td>
                <td>{{$detpago->fechapagomes}}</td>
                <td>{{$detpago->mes->nombre}}</td>
                <td>{{$detpago->totalbs}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <table width="100%" align="center" style="font-size: 8pt">
            <tr>
                <th style="text-align: right">Importe de Pago: {{NumerosEnLetras::convertir($deudaparcial_Pago,'Bolivianos',true)}}</th>
            </tr>
        </table>
    </div>
    <br>
    @endforeach
    
    <div class="row">
        <table width="100%" align="center" style="font-size: 8pt">
            <tr>
                <td style="text-align: right">
                    <b>Total Importe de Pago:
                    @foreach($deudatotal_Pagos as $deudatotal_Pago)
                        {{NumerosEnLetras::convertir($deudatotal_Pago->sumaTotal,'Bolivianos',true)}}
                    @endforeach
                    </b>
                </td>
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

