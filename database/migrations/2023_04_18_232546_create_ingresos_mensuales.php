<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateIngresosMensuales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ingresos_mensuales;');
        DB::unprepared(
            "CREATE PROCEDURE ingresos_mensuales()
            BEGIN
                SELECT
                cat.nombre AS Detalle
                ,SUM(CASE DAY(pg.created_at) WHEN 1 THEN pg.totalbs ELSE 0 END) AS '1'
                ,SUM(CASE DAY(pg.created_at) WHEN 2 THEN pg.totalbs ELSE 0 END) AS '2'
                ,SUM(CASE DAY(pg.created_at) WHEN 3 THEN pg.totalbs ELSE 0 END) AS '3'
                ,SUM(CASE DAY(pg.created_at) WHEN 4 THEN pg.totalbs ELSE 0 END) AS '4'
                ,SUM(CASE DAY(pg.created_at) WHEN 5 THEN pg.totalbs ELSE 0 END) AS '5'
                ,SUM(CASE DAY(pg.created_at) WHEN 6 THEN pg.totalbs ELSE 0 END) AS '6'
                ,SUM(CASE DAY(pg.created_at) WHEN 7 THEN pg.totalbs ELSE 0 END) AS '7'
                ,SUM(CASE DAY(pg.created_at) WHEN 8 THEN pg.totalbs ELSE 0 END) AS '8'
                ,SUM(CASE DAY(pg.created_at) WHEN 9 THEN pg.totalbs ELSE 0 END) AS '9'     
                ,SUM(CASE DAY(pg.created_at) WHEN 10 THEN pg.totalbs ELSE 0 END) AS '10'     
                ,SUM(CASE DAY(pg.created_at) WHEN 11 THEN pg.totalbs ELSE 0 END) AS '11'     
                ,SUM(CASE DAY(pg.created_at) WHEN 12 THEN pg.totalbs ELSE 0 END) AS '12'     
                ,SUM(CASE DAY(pg.created_at) WHEN 13 THEN pg.totalbs ELSE 0 END) AS '13'     
                ,SUM(CASE DAY(pg.created_at) WHEN 14 THEN pg.totalbs ELSE 0 END) AS '14'     
                ,SUM(CASE DAY(pg.created_at) WHEN 15 THEN pg.totalbs ELSE 0 END) AS '15'     
                ,SUM(CASE DAY(pg.created_at) WHEN 16 THEN pg.totalbs ELSE 0 END) AS '16'     
                ,SUM(CASE DAY(pg.created_at) WHEN 17 THEN pg.totalbs ELSE 0 END) AS '17'     
                ,SUM(CASE DAY(pg.created_at) WHEN 18 THEN pg.totalbs ELSE 0 END) AS '18'
                ,SUM(CASE DAY(pg.created_at) WHEN 19 THEN pg.totalbs ELSE 0 END) AS '19'     
                ,SUM(CASE DAY(pg.created_at) WHEN 20 THEN pg.totalbs ELSE 0 END) AS '20'     
                ,SUM(CASE DAY(pg.created_at) WHEN 21 THEN pg.totalbs ELSE 0 END) AS '21'     
                ,SUM(CASE DAY(pg.created_at) WHEN 22 THEN pg.totalbs ELSE 0 END) AS '22'     
                ,SUM(CASE DAY(pg.created_at) WHEN 23 THEN pg.totalbs ELSE 0 END) AS '23'     
                ,SUM(CASE DAY(pg.created_at) WHEN 24 THEN pg.totalbs ELSE 0 END) AS '24'     
                ,SUM(CASE DAY(pg.created_at) WHEN 25 THEN pg.totalbs ELSE 0 END) AS '25'     
                ,SUM(CASE DAY(pg.created_at) WHEN 26 THEN pg.totalbs ELSE 0 END) AS '26'     
                ,SUM(CASE DAY(pg.created_at) WHEN 27 THEN pg.totalbs ELSE 0 END) AS '27'     
                ,SUM(CASE DAY(pg.created_at) WHEN 28 THEN pg.totalbs ELSE 0 END) AS '28'     
                ,SUM(CASE DAY(pg.created_at) WHEN 29 THEN pg.totalbs ELSE 0 END) AS '29'     
                ,SUM(CASE DAY(pg.created_at) WHEN 30 THEN pg.totalbs ELSE 0 END) AS '30'     
                ,SUM(CASE DAY(pg.created_at) WHEN 31 THEN pg.totalbs ELSE 0 END) AS '31'    
                ,SUM(pg.totalbs) AS Total     
                FROM personas per
                INNER JOIN proyectogenerals pg ON per.id=pg.persona_id 
                INNER JOIN categoriagenerals cat ON cat.id=pg.categoriageneral_id
                WHERE MONTH(pg.created_at) = MONTH(NOW()) 
                AND YEAR(pg.created_at) = YEAR(NOW())
                AND pg.deleted_at IS NULL
                GROUP BY cat.id

                UNION

                SELECT
                s.nombre AS Detalle
                ,SUM(CASE DAY(vs.created_at) WHEN 1 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '1'
                ,SUM(CASE DAY(vs.created_at) WHEN 2 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '2'
                ,SUM(CASE DAY(vs.created_at) WHEN 3 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '3'
                ,SUM(CASE DAY(vs.created_at) WHEN 4 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '4'
                ,SUM(CASE DAY(vs.created_at) WHEN 5 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '5'
                ,SUM(CASE DAY(vs.created_at) WHEN 6 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '6'
                ,SUM(CASE DAY(vs.created_at) WHEN 7 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '7'
                ,SUM(CASE DAY(vs.created_at) WHEN 8 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '8'
                ,SUM(CASE DAY(vs.created_at) WHEN 9 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '9'     
                ,SUM(CASE DAY(vs.created_at) WHEN 10 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '10'     
                ,SUM(CASE DAY(vs.created_at) WHEN 11 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '11'     
                ,SUM(CASE DAY(vs.created_at) WHEN 12 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '12'     
                ,SUM(CASE DAY(vs.created_at) WHEN 13 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '13'     
                ,SUM(CASE DAY(vs.created_at) WHEN 14 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '14'     
                ,SUM(CASE DAY(vs.created_at) WHEN 15 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '15'     
                ,SUM(CASE DAY(vs.created_at) WHEN 16 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '16'     
                ,SUM(CASE DAY(vs.created_at) WHEN 17 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '17'     
                ,SUM(CASE DAY(vs.created_at) WHEN 18 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '18'
                ,SUM(CASE DAY(vs.created_at) WHEN 19 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '19'     
                ,SUM(CASE DAY(vs.created_at) WHEN 20 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '20'     
                ,SUM(CASE DAY(vs.created_at) WHEN 21 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '21'     
                ,SUM(CASE DAY(vs.created_at) WHEN 22 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '22'     
                ,SUM(CASE DAY(vs.created_at) WHEN 23 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '23'     
                ,SUM(CASE DAY(vs.created_at) WHEN 24 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '24'     
                ,SUM(CASE DAY(vs.created_at) WHEN 25 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '25'     
                ,SUM(CASE DAY(vs.created_at) WHEN 26 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '26'     
                ,SUM(CASE DAY(vs.created_at) WHEN 27 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '27'     
                ,SUM(CASE DAY(vs.created_at) WHEN 28 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '28'     
                ,SUM(CASE DAY(vs.created_at) WHEN 29 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '29'     
                ,SUM(CASE DAY(vs.created_at) WHEN 30 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '30'     
                ,SUM(CASE DAY(vs.created_at) WHEN 31 THEN (dv.precio * dv.cantidad) ELSE 0 END) AS '31'    
                ,SUM((dv.precio * dv.cantidad)) AS Total     
                FROM personas p
                INNER JOIN  ventaservicios vs ON p.id = vs.persona_id AND vs.deleted_at IS NULL 
                INNER JOIN detalleventaservicios dv ON vs.id = dv.ventaservicio_id AND dv.deleted_at IS NULL
                INNER JOIN servicios s ON s.id=dv.servicio_id
                WHERE MONTH(vs.created_at) = MONTH(NOW()) 
                AND YEAR(vs.created_at) = YEAR(NOW())
                GROUP BY s.id;
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
        Schema::dropIfExists('ingresos_mensuales');
    }
}
