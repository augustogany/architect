<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Axsy1LwRzIcG5DSsS3q...K/MrF6Sm3PJLgkLqd76OQ5dBSgiRuRq',
                'persona_id' => 0,
                'remember_token' => 'dzA8EaUnQRlZyvAI0V1RO4S0satNAYyr1W09wRpmE7e8cK0UtOqae3h1BL2V',
                'created_at' => '2020-07-23 09:37:49',
                'updated_at' => '2020-07-23 09:37:49',
            ),
            2 => 
            array (
                'id' => 2,
                'name' => 'escritorTrinidad',
                'email' => 'escritortrinidad@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Axsy1LwRzIcG5DSsS3q...K/MrF6Sm3PJLgkLqd76OQ5dBSgiRuRq',
                'persona_id' => 0,
                'remember_token' => NULL,
                'created_at' => '2020-07-23 09:51:01',
                'updated_at' => '2020-07-23 09:51:01',
            ),
            3 => 
            array (
                'id' => 3,
                'name' => 'escritorRiberalta',
                'email' => 'escritorriberalta@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Axsy1LwRzIcG5DSsS3q...K/MrF6Sm3PJLgkLqd76OQ5dBSgiRuRq',
                'persona_id' => 0,
                'remember_token' => NULL,
                'created_at' => '2020-07-23 09:51:59',
                'updated_at' => '2020-07-23 09:51:59',
            )
        ));
        
        
    }
}