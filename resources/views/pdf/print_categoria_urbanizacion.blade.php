<!DOCTYPE html>
<html>
<head>
    <title>Visado Categoría Urbanización</title>

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
        <p>COLEGIO DE ARQUITECTOS DEL BENI<br>VISADO DE CATEGORIA<br>Categoría Urbanización</p>
    </header>

    
    <div class="row">
        <table cellspacing="0" width="100%" align="center" border="1" style="font-size: 8pt">
            <tr>
                <th>Nro. Item</th>
                <th>Mts2 Inicio</th>
                <th>Mts2 Fin</th>
                <th>Arancel</th>
                <th>Costo PU.</th>
                <th>Porcentaje CADBENI.</th>
                <th>Visado Bs.</th>
                <th>Visado Bs.</th>
            </tr>
            <?php $numeroitems = 0; ?>
            @foreach($print_categoria_urbanizacions as $pcu)
            <?php $numeroitems++ ?>
            <tr>
                <td>{{$numeroitems}}</td>
                <td>{{$pcu->mt2_inicio}}</td>
                <td>{{$pcu->mt2_fin}}</td>
                <td>{{$pcu->arancel}}</td>
                <td>{{$pcu->costo_pu}}</td>
                <td>{{$pcu->porcentaje_cab}}</td>
                <td>{{$pcu->visado_sus}}</td>
                <td>{{$pcu->visado_bs}}</td>
            </tr>
            @endforeach 
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

