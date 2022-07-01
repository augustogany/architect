<!DOCTYPE html>
<html>
<head>
    <title>Reportes Proyectos Generales</title>
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
        <p>COLEGIO DE ARQUITECTOS DEL BENI<br>Proyectos Generales - Trinidad, <?php $time = time(); echo date("d-m-Y", $time); ?></p>
    </header>

        <div class="row">
            <table cellspacing="0" width="100%" align="center" border="1" style="font-size: 7pt">
                <thead>

                    <tr>
                        <th>Nro.</th>
                        <th>Fecha Registro</th>
                        <th>Proyecto</th>
                        <th>Propietarios</th>
                        <th>Arquitecto</th>
                        <th>Categoría</th>
                        <th>Superficie Mt2</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <thead>
                        <?php $numeroitems = 0; $suma_total = 0; ?>
                        @foreach($proyectogenerals as $proyectogeneral)
                        <?php $numeroitems++ ?>
                        <?php $suma_total += $proyectogeneral->totalbs; ?>
                        <tr>
                            <td style="width: 20pt">{{$numeroitems}}</td>
                            <td style="width: 50pt">{{$proyectogeneral->fecharegistro}}</td>
                            <td>{{$proyectogeneral->proyecto}}</td>
                            <td>{{$proyectogeneral->propietario}}</td>
                            <td>{{$proyectogeneral->persona->nombre}} {{$proyectogeneral->persona->apaterno}} {{$proyectogeneral->persona->amaterno}}</td>
                            <td>{{$proyectogeneral->categoriageneral->nombre}}</td>
                            <td style="width: 60pt">{{$proyectogeneral->superficiemts2}}</td>
                            <td style="width: 50pt">{{$proyectogeneral->totalbs}} Bs.</td>
                        </tr>
                        @endforeach
                </thead>
            </table>
        </div>
        <div class="row">
            <table width="100%" align="center" style="font-size: 7pt">
                <tr>
                    <td style="text-align: right">Total Final:
                     {{NumerosEnLetras::convertir($suma_total,'Bolivianos',true)}}
                    </td>
                </tr>
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
