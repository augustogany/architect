<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function ingresos_planillas_index(){
        return view('reportes.ingresosplanillas.index');
    }
}
