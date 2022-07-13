<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(CategoriageneralsTableSeeder::class);
        $this->call(CategoriaurbanizacionsTableSeeder::class);
        $this->call(ExpedicionsTableSeeder::class);
        $this->call(MesesTableSeeder::class);
        $this->call(PersonasTableSeeder::class);
        $this->call(ServiciosTableSeeder::class);
        $this->call(SucursalsTableSeeder::class);
        $this->call(SucursalUserTableSeeder::class);
        $this->call(TipoPagoTableSeeder::class);
        $this->call(GestionesTableSeeder::class);
    }
}
