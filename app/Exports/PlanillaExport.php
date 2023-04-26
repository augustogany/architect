<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PlanillaExport implements WithMultipleSheets
{
    protected $fechaInicio;
    protected $fechaFin;

    public function __construct($fechaInicio, $fechaFin)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }

    public function sheets(): array
    {
        $sheets = [];

        // Hoja de trabajo para ingresos diarios
        array_push($sheets, new Planilla($this->fechaInicio,$this->fechaFin));
        // Hoja de trabajo para ingresos del mes actual
        array_push($sheets, new IngresosMensuales());

        return $sheets;
    }
}
