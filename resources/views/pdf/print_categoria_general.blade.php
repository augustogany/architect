<!DOCTYPE html>
<html>
<head>
    <title>Visado Categoría General</title>

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
        <p>COLEGIO DE ARQUITECTOS DEL BENI<br>VISADO DE CATEGORIA<br>Categoría General</p>
    </header>

    
    <div class="row">
        <table cellspacing="0" width="100%" align="center" border="1" style="font-size: 8pt">
            <tr>
                <th>Nro. Item</th>
                <th>Nombre categoría</th>
                <th>Costo</th>
            </tr>
            <?php $numeroitems = 0; ?>
            @foreach($print_categoria_generals as $pcg)
            <?php $numeroitems++ ?>
            <tr>
                <td>{{$numeroitems}}</td>
                <td>{{$pcg->nombre}}</td>
                <td>{{$pcg->costo}}</td>
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

