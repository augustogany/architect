<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;
use \DB;

class IngresosMensuales implements FromCollection,WithHeadings,
ShouldAutoSize,WithCustomStartCell,WithTitle,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(DB::select('CALL ingresos_mensuales()'));
    }
    public function headings(): array
    {
        $mesActual = Carbon::now()->monthName;
        $anioActual = Carbon::now()->year;
        return[
            [
                'DETALLE',
                '1','2','3','4','5','6','7','8','9','10','11','12',
                '13','14','15','16','17','18','19','20','21','22',
                '23','24','25','26','27','28','29','30','31',
                'Total'
            ]
        ];
    }
    public function startCell(): string
    {
        return 'A8';
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
        // Alinear a la derecha
        $colRigth = [
            'alignment' => [
                'horizontal' => 'rigth'
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
                ['D5:S5',
                'A2:C2' // Fila intermedia
                ]);
                $mesActual = Carbon::now()->monthName;
                $anioActual = Carbon::now()->year;
                $event->sheet->setCellValue('A2', 'COLEGIO DE ARQUITECTOS DEL BENI');
                $event->sheet->setCellValue('A3', 'Av. 6 de agosto # 541');
                $event->sheet->setCellValue('A4', 'Telf.: 4621299');
                $event->sheet->setCellValue('D5', 'PLANILLA DE INGRESOS EN BS');
                $event->sheet->setCellValue('AE6', 'MES');
                $event->sheet->setCellValue('AE7', 'AÑO');
                $event->sheet->setCellValue('AF6', strtoupper($mesActual));
                $event->sheet->setCellValue('AF7', $anioActual);
                $event->sheet->getDelegate()->freezePane('A7'); //Congela las filas anteriores
                $event->sheet->getStyle('A2:C2')->ApplyFromArray($colCenter);
                $event->sheet->getStyle('A3:A4')->ApplyFromArray($colCenter);
                $event->sheet->getStyle('D5:S5')->ApplyFromArray($colCenter);
               
                // Encabezado
                $event->sheet->getStyle('D5:S5')->ApplyFromArray($borderThin);
                //$event->sheet->getStyle('A5:P5')->ApplyFromArray($borderThin);
            }
        ];
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'INGRESO MES';
    }
}
