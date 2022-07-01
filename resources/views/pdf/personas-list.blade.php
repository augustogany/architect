<!DOCTYPE html>
<html>
<head>
    <title>Reporte Arquitectos</title>
</head>
<style>
    #watermark {
        position: fixed;
        top: 25%;
        width: 100%;
        text-align: center;
        opacity: .15;
        transform-origin: 50% 50%;
        z-index: -1000;
    }

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
        margin: 2cm 1cm 1cm;
    }

    /*Encabezado del Reporte (Titulos)*/
    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 1.5cm;
        background-color: #46C66B;
        color: white;
        text-align: center;
        line-height: 15px;
    }

    /*Efecto striped*/
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

</style>
<body>
    <header>
        <p>COLEGIO DE ARQUITECTOS DEL BENI<br>Arquitectos del CADBENI, <?php $time = time(); echo date("d-m-Y", $time); ?></p>
    </header>

        <div class="row">
            <table cellspacing="0" width="100%" align="center" border="1" style="font-size: 7pt">
                <thead>
                    <tr>
                        <th>Nro.</th>
                        <th>Nombres</th>
                        <th>Ap. Paterno</th>
                        <th>Ap. Materno</th>
                        <th>Código</th>
                        <th>Telefono</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <thead>
                    <?php $numeroitems = 0;?>
                    @foreach($personas as $persona)
                    <?php $numeroitems++ ?>
                    <tr>
                        <td style="width: 20pt">{{$numeroitems}}</td>
                        <td>{{$persona->nombre}}</td>
                        <td>{{$persona->apaterno}}</td>  
                        <td>{{$persona->amaterno}}</td>  
                        <td></td>  
                        <td></td>
                        <td></td>  
                        <td></td>
                        <td>{{$persona->condicion}}</td>                        
                    </tr>
                    @endforeach
                </thead>
            </table>
        </div>
        

        <script type="text/php">
            if ( isset($pdf) ) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $pdf->text(400, 570, "Pág $PAGE_NUM de $PAGE_COUNT", $font, 10);
                ');
            }
        </script>
</body>
</html>
