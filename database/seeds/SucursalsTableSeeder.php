<?php

use Illuminate\Database\Seeder;

class SucursalsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sucursals')->delete();
        
        \DB::table('sucursals')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sucursal' => 'COL. ARQUITECTOS TRINIDAD',
                'ubicacion' => 'TRINIDAD',
                'condicion' => 1,
                'created_at' => '2020-07-23 09:48:33',
                'updated_at' => '2020-07-23 09:48:33',
            ),
            1 => 
            array (
                'id' => 2,
                'sucursal' => 'COL. ARQUITECTOS RIBERALTA',
                'ubicacion' => 'RIBERALTA',
                'condicion' => 1,
                'created_at' => '2020-07-23 09:48:52',
                'updated_at' => '2020-07-23 09:48:52',
            ),
        ));
        
        
    }
}