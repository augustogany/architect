<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateIngresosPlanillasProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ingresos_planillas_procedures;');
        DB::unprepared(
            "CREATE PROCEDURE ingresos_planillas_procedures()
             BEGIN
             SELECT *
            ,rep.VisacFamiliar + rep.VisacComercio + rep.VisacOtros + rep.CertRegistro
            +rep.TimbreFort+rep.CertInscripcion+rep.CertTraslado+rep.CarpTransferencia+rep.FormContrato
            +rep.CarpProyectos+rep.CarpAvaluo+rep.CuotaMensual+rep.CuotaAnual AS TotalIngresos
            FROM
            (
            SELECT 
                CONCAT(per.nombre, ' ', per.apaterno, ' ', per.amaterno) AS Arquitecto
                ,SUM(CASE WHEN pg.categoriageneral_id = 1 THEN pg.totalbs ELSE 0 END) AS VisacFamiliar
                ,SUM(CASE WHEN pg.categoriageneral_id = 3 THEN pg.totalbs ELSE 0 END) AS VisacComercio
                ,SUM(CASE WHEN pg.categoriageneral_id IN (2, 4) THEN pg.totalbs ELSE 0 END) AS VisacOtros
                ,0 CertRegistro
                ,0 TimbreFort
                ,0 CertInscripcion
                ,0 CertTraslado
                ,0 CarpTransferencia
                ,0 FormContrato
                ,0 CarpProyectos
                ,0 CarpAvaluo
                ,0 CuotaMensual
                ,0 CuotaAnual
                FROM personas per
                INNER JOIN proyectogenerals pg ON per.id=pg.persona_id 
                AND pg.deleted_at IS NULL AND DATE(pg.created_at)= CURDATE()
                GROUP BY per.id
            UNION 
            select 
                CONCAT(p.nombre, ' ', p.apaterno, ' ', p.amaterno) AS Arquitecto
                    ,0 VisacFamiliar
                    ,0 VisacComercio
                    ,0 VisacOtros
                    ,0 CertRegistro
                    ,0 TimbreFort
                    ,SUM(CASE WHEN dv.servicio_id = 3 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS CertInscripcion
                    ,SUM(CASE WHEN dv.servicio_id = 4 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS CertTraslado
                    ,SUM(CASE WHEN dv.servicio_id = 6 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS CarpTransferencia
                    ,SUM(CASE WHEN dv.servicio_id = 8 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS FormContrato
                    ,SUM(CASE WHEN dv.servicio_id = 5 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS CarpProyectos
                    ,SUM(CASE WHEN dv.servicio_id = 7 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS CarpAvaluo
                    ,0 CuotaMensual
                    ,0 CuotaAnual
                    FROM personas p
                    INNER JOIN  ventaservicios vs ON p.id = vs.persona_id AND vs.deleted_at IS NULL AND DATE(vs.created_at)= CURDATE()
                    INNER JOIN detalleventaservicios dv ON vs.id = dv.ventaservicio_id AND dv.deleted_at IS NULL
                    GROUP BY p.id
            UNION 
            select 
                    CONCAT(p.nombre, ' ', p.apaterno, ' ', p.amaterno) AS Arquitecto
                    ,0 VisacFamiliar
                    ,0 VisacComercio
                    ,0 VisacOtros
                    ,0 CertRegistro
                    ,0 TimbreFort
                    ,0 CertInscripcion
                    ,0 CertTraslado
                    ,0 CarpTransferencia
                    ,0 FormContrato
                    ,0 CarpProyectos
                    ,0 CarpAvaluo
                    ,SUM(pm.monto_pagado) AS CuotaMensual
                    ,0 CuotaAnual
                    FROM personas p
                    INNER JOIN personas_pagos pp ON pp.persona_id=p.id 
                    INNER JOIN personas_pagos_mensualidades pm ON pp.id = pm.personas_pago_id 
                    WHERE DATE(pm.created_at)= CURDATE()
                    AND pp.deleted_at IS NULL AND DATE(pp.created_at)= CURDATE()
                    GROUP BY p.id	

            UNION 
            select 
                CONCAT(p.nombre, ' ', p.apaterno, ' ', p.amaterno) AS Arquitecto
                ,0 VisacFamiliar
                ,0 VisacComercio
                ,0 VisacOtros
                ,0 CertRegistro
                ,0 TimbreFort
                ,0 CertInscripcion
                ,0 CertTraslado
                ,0 CarpTransferencia
                ,0 FormContrato
                ,0 CarpProyectos
                ,0 CarpAvaluo
                ,0 CuotaMensual
                ,SUM(pa.monto_pagado) AS CuotaAnual
                FROM personas p
                INNER JOIN personas_pagos_anuales pa ON pa.persona_id=p.id AND pa.deleted_at IS NULL AND DATE(pa.created_at)= CURDATE()	
                GROUP BY p.id

            ) AS rep;
             END;"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingresos_planillas_procedures');
    }
}
