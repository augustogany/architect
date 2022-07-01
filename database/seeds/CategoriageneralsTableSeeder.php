<?php

use Illuminate\Database\Seeder;

class CategoriageneralsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categoriagenerals')->delete();
        
        \DB::table('categoriagenerals')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'VIVIENDA',
                'costo' => '0.80',
                'condicion' => 1,
                'created_at' => '2020-06-09 11:34:33',
                'updated_at' => '2020-07-02 01:51:23',
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'EQUIPAMIENTOS Y SERVICIOS BASICOS',
                'costo' => '1.80',
                'condicion' => 1,
                'created_at' => '2020-06-09 11:34:33',
                'updated_at' => '2020-07-02 01:51:57',
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'COMERCIO Y OFICINAS',
                'costo' => '1.00',
                'condicion' => 1,
                'created_at' => '2020-06-09 11:39:09',
                'updated_at' => '2020-07-02 01:51:41',
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'INDUSTRIAS',
                'costo' => '1.80',
                'condicion' => 1,
                'created_at' => '2020-06-09 11:39:09',
                'updated_at' => '2020-06-09 11:39:09',
            ),
        ));
        
        
    }
}