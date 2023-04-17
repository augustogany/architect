<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use \DB;

class Planilla implements FromCollection,WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(DB::select('CALL ingresos_planillas_procedures()'));
    }

    public function headings(): array
    {
        return[
            ['PLANILLA DE INGRESOS'],
            ['CORRESPONDIENTES AL MES ACTUAL'], 
            [
                'id',
                'Arquitecto',
                'VisacFamiliar',
                'VisacComercio',
                'VisacOtros',
                'CertRegistro',
                'TimbreFort',
                'CertInscripcion',
                'CertTraslado',
                'CarpTransferencia',
                'FormContrato',
                'CarpProyectos',
                'CarpAvaluo',
                'CuotaMensual',
                'CuotaAnual',
                'TotalIngresos'
            ]
        ];
    }

    public function startCell(): string
    {
        return 'A4';
    }

    public function registerEvents(): array
    {
        $borderDashed = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'dashed',
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];
         // Borde simple
        $borderThin = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];
        // Alinear al centro
        $colCenter = [
            'alignment' => [
                'horizontal' => 'center'
            ]
        ];
        $rowCenter = [
            'alignment' => [
                'vertical' => 'center'
            ]
        ];
        return [
            AfterSheet::class => function(AfterSheet $event) use($borderDashed,$colCenter,$rowCenter,$borderThin){
                $event->sheet->getDelegate()->setMergeCells( //Combina celdas
                ['A4:P4',
                'A5:P5' // Fila intermedia
                ]);
                $event->sheet->getDelegate()->freezePane('A6'); //Congela las filas anteriores
                $event->sheet->getStyle('A4:P4')->ApplyFromArray($colCenter);
                $event->sheet->getStyle('A5:P5')->ApplyFromArray($colCenter);
                // Encabezado
                $event->sheet->getStyle('A4:P4')->ApplyFromArray($borderThin);
                $event->sheet->getStyle('A5:P5')->ApplyFromArray($borderThin);
            }
        ];
    }
}
