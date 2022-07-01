<?php

namespace App\Exports;

use App\Persona;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PersonasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Persona::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'nombre',
            'apaterno',
            'amaterno',
            'numeroregistro',
            'telefonodomicilio',
            'telefonooficina',
            'telefonocelular',
            'direccion',
            'correo',
            'condicion',
            'estado',
            'created_at',
            'updated_at',
        ];
    }
}
