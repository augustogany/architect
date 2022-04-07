<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SucursalUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sucursal_user')->delete();
        
        \DB::table('sucursal_user')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sucursal_id' => 1,
                'user_id' => 2,
                'created_at' => '2020-07-23 09:53:38',
                'updated_at' => '2020-07-23 09:53:38',
            ),
            1 => 
            array (
                'id' => 2,
                'sucursal_id' => 2,
                'user_id' => 2,
                'created_at' => '2020-07-23 09:53:46',
                'updated_at' => '2020-07-23 09:53:46',
            ),
            2 => 
            array (
                'id' => 3,
                'sucursal_id' => 1,
                'user_id' => 3,
                'created_at' => '2020-07-23 09:53:53',
                'updated_at' => '2020-07-23 09:53:53',
            ),
            3 => 
            array (
                'id' => 4,
                'sucursal_id' => 2,
                'user_id' => 4,
                'created_at' => '2020-07-23 09:54:02',
                'updated_at' => '2020-07-23 09:54:02',
            ),
            4 => 
            array (
                'id' => 5,
                'sucursal_id' => 1,
                'user_id' => 1,
                'created_at' => '2020-07-30 22:13:04',
                'updated_at' => '2020-07-30 22:13:04',
            ),
            5 => 
            array (
                'id' => 6,
                'sucursal_id' => 2,
                'user_id' => 1,
                'created_at' => '2020-07-30 22:13:12',
                'updated_at' => '2020-07-30 22:13:12',
            ),
            6 => 
            array (
                'id' => 7,
                'sucursal_id' => 1,
                'user_id' => 7,
                'created_at' => '2022-02-21 23:51:18',
                'updated_at' => '2022-02-21 23:51:18',
            ),
        ));
        
        
    }
}