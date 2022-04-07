<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_user')->delete();
        
        \DB::table('role_user')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'user_id' => 1,
                'created_at' => '2020-07-23 09:41:14',
                'updated_at' => '2020-07-23 09:41:14',
            ),
            1 => 
            array (
                'id' => 3,
                'role_id' => 3,
                'user_id' => 3,
                'created_at' => '2021-04-18 14:54:27',
                'updated_at' => '2021-04-18 14:54:27',
            ),
            2 => 
            array (
                'id' => 4,
                'role_id' => 3,
                'user_id' => 4,
                'created_at' => '2021-04-18 14:54:33',
                'updated_at' => '2021-04-18 14:54:33',
            ),
            3 => 
            array (
                'id' => 5,
                'role_id' => 5,
                'user_id' => 2,
                'created_at' => '2022-04-03 21:25:48',
                'updated_at' => '2022-04-03 21:25:48',
            ),
        ));
        
        
    }
}