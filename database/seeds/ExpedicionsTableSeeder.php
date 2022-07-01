<?php

use Illuminate\Database\Seeder;

class ExpedicionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('expedicions')->delete();
        
        \DB::table('expedicions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'BENI',
                'condicion' => 1,
                'created_at' => '2019-08-14 18:46:18',
                'updated_at' => '2019-08-14 18:46:18',
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'SANTA CRUZ',
                'condicion' => 1,
                'created_at' => '2019-08-14 18:46:18',
                'updated_at' => '2019-08-14 18:46:18',
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'PANDO',
                'condicion' => 1,
                'created_at' => '2019-08-14 18:46:18',
                'updated_at' => '2019-08-14 18:46:18',
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'ORURO',
                'condicion' => 1,
                'created_at' => '2019-08-14 18:46:18',
                'updated_at' => '2019-08-14 18:46:18',
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'TARIJA',
                'condicion' => 1,
                'created_at' => '2019-08-14 18:46:18',
                'updated_at' => '2019-08-14 18:46:18',
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'CHUQUISACA',
                'condicion' => 1,
                'created_at' => '2019-08-14 18:46:18',
                'updated_at' => '2019-08-14 18:46:18',
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'COCHABAMBA',
                'condicion' => 1,
                'created_at' => '2019-08-14 18:46:18',
                'updated_at' => '2019-08-14 18:46:18',
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'LA PAZ',
                'condicion' => 1,
                'created_at' => '2019-08-14 18:46:18',
                'updated_at' => '2019-08-14 18:46:18',
            ),
            8 => 
            array (
                'id' => 9,
                'nombre' => 'POTOSI',
                'condicion' => 1,
                'created_at' => '2019-08-14 18:46:18',
                'updated_at' => '2019-08-14 18:46:18',
            ),
        ));
        
        
    }
}