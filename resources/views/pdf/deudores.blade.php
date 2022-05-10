<!DOCTYPE html>
<html>
<head>
    <title>Arquitectos Deudores</title>

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
        height: 2.3cm;
        background-color: #46C66B;
        color: white;
        text-align: center;
        line-height: 15px;
    }

</style>
<body>
    <header>
        <p>COLEGIO DE ARQUITECTOS DEL BENI<br>ARQUITECTOS DEUDORES</p>
    </header>

    <div class="row">
        <table cellspacing="0" width="100%" align="center" border="1" style="font-size: 8pt">
            <tr>
                <th>Nro. Item</th>
                <th>Nombre</th>
                <th>Nro Registro</th>
                <th>Cuotas pendientes</th>
            </tr>
            <?php 
                $numeroitems = 0;
                $cuotas_restantes = 0;
                $monto_pagado = 0; 
            ?>
            @forelse($deudores as $deudor)
            @foreach ($deudor->deudas as $deuda)
            $monto_pagado = $deuda->detalledeudas()->sum('totalbs');
                <?php 
                if ($deuda->montodeuda != ($monto_pagado + $deuda->desc_total)) {
                   $cuotas_restantes =  $deuda->cuotasrestantes;
                  }
                ?>
            @endforeach
            <?php $numeroitems++ ?>
            <tr>
                <td>{{$numeroitems}}</td>
                <td>{{$deudor->fullName}}</td>
                <td>{{$deudor->numeroregistro}}</td>
                <td>{{$cuotas_restantes}}</td>
            </tr>
            @empty
                <p>Sin registros.</p>
            @endforelse
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

