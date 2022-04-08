<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Rol administrador',
                'created_at' => '2021-04-23 18:16:03',
                'updated_at' => '2021-04-23 18:16:03',
                'special' => 'all-access',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'supervisor',
                'slug' => 'supervisor.sistema',
                'description' => '-',
                'created_at' => '2020-07-23 09:43:26',
                'updated_at' => '2020-07-23 09:43:26',
                'special' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'escritor',
                'slug' => 'escritor.sistema',
                'description' => '-',
                'created_at' => '2020-07-23 09:47:54',
                'updated_at' => '2020-07-23 09:47:54',
                'special' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'invitado',
                'slug' => 'invitado.sistema',
                'description' => '-',
                'created_at' => '2020-11-28 23:55:24',
                'updated_at' => '2020-11-28 23:55:24',
                'special' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'arquitecto',
                'slug' => 'Arquitectos',
                'description' => 'arquitectos',
                'created_at' => '2022-04-03 21:25:14',
                'updated_at' => '2022-04-03 21:25:14',
                'special' => NULL,
            ),
        ));
        
        
    }
}