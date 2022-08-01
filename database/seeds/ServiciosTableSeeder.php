<?php

use Illuminate\Database\Seeder;

class ServiciosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('servicios')->delete();
        
        \DB::table('servicios')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'VISACION PROYECTO ARQUITECTONICO',
                'precio' => '120.00',
                'condicion' => 1,
                'estado' => 'activo',
                'created_at' => '2021-04-03 06:37:11',
                'updated_at' => '2021-06-01 16:43:29',
                'deleted_at' => NULL
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'VISACION PROYECTO URBANIZACION',
                'precio' => '70.00',
                'condicion' => 1,
                'estado' => 'activo',
                'created_at' => '2021-04-03 06:37:11',
                'updated_at' => '2022-02-19 19:18:05',
                'deleted_at' => NULL
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'CERTIFICADO DE REGISTRO',
                'precio' => '70.00',
                'condicion' => 1,
                'estado' => 'activo',
                'created_at' => '2021-04-03 06:37:11',
                'updated_at' => '2021-04-03 06:37:11',
                'deleted_at' => NULL
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'CERTIFICADO DE PROPIEDAD INTELECTUAL',
                'precio' => '70.00',
                'condicion' => 1,
                'estado' => 'activo',
                'created_at' => '2021-04-03 06:37:11',
                'updated_at' => '2021-04-03 06:37:11',
                'deleted_at' => NULL
            ),
            4 => 
            array (
                'id' => 5,
            'nombre' => 'VALORES (TIMBRES, CONTRATO)',
                'precio' => '80.00',
                'condicion' => 1,
                'estado' => 'activo',
                'created_at' => '2021-04-03 06:37:11',
                'updated_at' => '2021-04-03 06:37:11',
                'deleted_at' => NULL
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'CARPETA PARA TRANSFERENCIA',
                'precio' => '90.00',
                'condicion' => 1,
                'estado' => 'activo',
                'created_at' => '2021-04-03 06:37:11',
                'updated_at' => '2022-02-19 19:18:00',
                'deleted_at' => NULL
            ),
        ));
        
        
    }
}