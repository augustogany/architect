<?php

use Illuminate\Database\Seeder;
use App\Tipopago;
class TipoPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipopago::create([
            'user_id' => 1,
            'sucursal_id' => 1,
            'nombrepago' => 'ATRASADOS',
            'gestion' => 0,
            'monto' => 0,
            'monto_aux' => 0,
            'descuentoporcentaje' => 0,
            'descuentobs' => 0,
            'cuotas' => 0,
            'clientIP' => '127.0.0.1',
            'clientIP_update' => '127.0.0.1'
        ]);
    }
}
