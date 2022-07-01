<?php

use Illuminate\Database\Seeder;

class MesesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('meses')->delete();
        
        \DB::table('meses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'ENERO',
                'condicion' => 1,
                'condicion_aux' => 1,
                'created_at' => '2021-04-02 00:34:54',
                'updated_at' => '2021-04-02 00:34:54',
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'FEBRERO',
                'condicion' => 1,
                'condicion_aux' => 1,
                'created_at' => '2021-04-02 00:34:54',
                'updated_at' => '2021-04-02 00:34:54',
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'MARZO',
                'condicion' => 1,
                'condicion_aux' => 1,
                'created_at' => '2021-04-02 00:34:54',
                'updated_at' => '2021-04-02 00:34:54',
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'ABRIL',
                'condicion' => 1,
                'condicion_aux' => 1,
                'created_at' => '2021-04-02 00:34:54',
                'updated_at' => '2021-04-02 00:34:54',
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'MAYO',
                'condicion' => 1,
                'condicion_aux' => 1,
                'created_at' => '2021-04-02 00:34:54',
                'updated_at' => '2021-04-02 00:34:54',
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'JUNIO',
                'condicion' => 1,
                'condicion_aux' => 1,
                'created_at' => '2021-04-02 00:34:54',
                'updated_at' => '2021-04-02 00:34:54',
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'JULIO',
                'condicion' => 1,
                'condicion_aux' => 1,
                'created_at' => '2021-04-02 00:34:54',
                'updated_at' => '2021-04-02 00:34:54',
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'AGOSTO',
                'condicion' => 1,
                'condicion_aux' => 1,
                'created_at' => '2021-04-02 00:34:54',
                'updated_at' => '2021-04-02 00:34:54',
            ),
            8 => 
            array (
                'id' => 9,
                'nombre' => 'SEPTIEMBRE',
                'condicion' => 1,
                'condicion_aux' => 1,
                'created_at' => '2021-04-02 00:34:54',
                'updated_at' => '2021-04-02 00:34:54',
            ),
            9 => 
            array (
                'id' => 10,
                'nombre' => 'OCTUBRE',
                'condicion' => 1,
                'condicion_aux' => 1,
                'created_at' => '2021-04-02 00:34:54',
                'updated_at' => '2021-04-02 00:34:54',
            ),
            10 => 
            array (
                'id' => 11,
                'nombre' => 'NOVIEMBRE',
                'condicion' => 1,
                'condicion_aux' => 1,
                'created_at' => '2021-04-02 00:34:54',
                'updated_at' => '2021-04-02 00:34:54',
            ),
            11 => 
            array (
                'id' => 12,
                'nombre' => 'DICIEMBRE',
                'condicion' => 1,
                'condicion_aux' => 1,
                'created_at' => '2021-04-02 00:34:54',
                'updated_at' => '2021-04-02 00:34:54',
            ),
        ));
        
        
    }
}