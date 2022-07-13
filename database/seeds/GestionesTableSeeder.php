<?php

use Illuminate\Database\Seeder;

class GestionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('gestiones')->delete();
        
        \DB::table('gestiones')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2000',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:43:43',
                'updated_at' => '2022-07-12 14:43:43',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2001',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:43:53',
                'updated_at' => '2022-07-12 14:46:38',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2002',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:44:03',
                'updated_at' => '2022-07-12 14:44:03',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2003',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:44:15',
                'updated_at' => '2022-07-12 14:44:15',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2004',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:44:26',
                'updated_at' => '2022-07-12 14:44:26',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2005',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:44:37',
                'updated_at' => '2022-07-12 14:44:37',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2006',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:45:06',
                'updated_at' => '2022-07-12 14:45:06',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2007',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:45:56',
                'updated_at' => '2022-07-12 14:46:02',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2008',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:43:43',
                'updated_at' => '2022-07-12 14:43:43',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2009',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:43:53',
                'updated_at' => '2022-07-12 14:46:38',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2010',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:44:03',
                'updated_at' => '2022-07-12 14:44:03',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2011',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:44:15',
                'updated_at' => '2022-07-12 14:44:15',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2012',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:44:26',
                'updated_at' => '2022-07-12 14:44:26',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2013',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:44:37',
                'updated_at' => '2022-07-12 14:44:37',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2014',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:45:06',
                'updated_at' => '2022-07-12 14:45:06',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2015',
                'mensualidad' => '30.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:45:56',
                'updated_at' => '2022-07-12 14:46:02',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2015',
                'mensualidad' => '50.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:43:53',
                'updated_at' => '2022-07-12 14:46:38',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2016',
                'mensualidad' => '50.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:44:03',
                'updated_at' => '2022-07-12 14:44:03',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2017',
                'mensualidad' => '50.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:44:15',
                'updated_at' => '2022-07-12 14:44:15',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2018',
                'mensualidad' => '50.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:44:26',
                'updated_at' => '2022-07-12 14:44:26',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2019',
                'mensualidad' => '50.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:44:37',
                'updated_at' => '2022-07-12 14:44:37',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2020',
                'mensualidad' => '50.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:45:06',
                'updated_at' => '2022-07-12 14:45:06',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2021',
                'mensualidad' => '50.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:45:56',
                'updated_at' => '2022-07-12 14:46:02',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'user_id' => 1,
                'sucursal_id' => 1,
                'gestion' => '2022',
                'mensualidad' => '50.00',
                'observacion' => NULL,
                'created_at' => '2022-07-12 14:45:56',
                'updated_at' => '2022-07-12 14:46:02',
                'deleted_at' => NULL,
            ),
        ));
    }
}
