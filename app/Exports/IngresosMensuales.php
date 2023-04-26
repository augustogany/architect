<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
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
        $data = collect(DB::select('CALL ingresos_mensuales()'));
        // Calcular la suma de cada columna
        $total_score = $data->sum('1');
        $total_column3 = $data->sum('2');
        $total_column4 = $data->sum('3');
        $total_column5 = $data->sum('4');
        $total_column6 = $data->sum('5');
        $total_column7 = $data->sum('6');
        $total_column8 = $data->sum('7');
        $total_column9 = $data->sum('8');
        $total_column10 = $data->sum('9');
        $total_column11 = $data->sum('10');
        $total_column12 = $data->sum('11');
        $total_column13 = $data->sum('12');
        $total_column14 = $data->sum('13');
        $total_column15 = $data->sum('14');
        $total_column16 = $data->sum('15');
        $total_column17 = $data->sum('16');
        $total_column18 = $data->sum('17');
        $total_column19 = $data->sum('18');
        $total_column20 = $data->sum('19');
        $total_column21 = $data->sum('20');
        $total_column22 = $data->sum('21');
        $total_column23 = $data->sum('22');
        $total_column24 = $data->sum('23');
        $total_column25 = $data->sum('24');
        $total_column26 = $data->sum('25');
        $total_column27 = $data->sum('26');
        $total_column28 = $data->sum('27');
        $total_column29 = $data->sum('28');
        $total_column30 = $data->sum('29');
        $total_column31 = $data->sum('30');
        $total_column32 = $data->sum('31');
        $total_column33 = $data->sum('Total');
        // Crear una nueva fila con los totales de cada columna
        $total_row = ['Total Ingresos',$total_score, $total_column3, $total_column4, 
            $total_column5, $total_column6,$total_column7, $total_column8
            ,$total_column9, $total_column10, $total_column11, $total_column12
            ,$total_column13,$total_column14,$total_column15,$total_column16,$total_column17,$total_column18
            ,$total_column19,$total_column20,$total_column21,$total_column22,$total_column23,$total_column24
            ,$total_column25,$total_column26,$total_column27,$total_column28,$total_column29
            ,$total_column30,$total_column31,$total_column32,$total_column33
        ];

        // Agregar la nueva fila al final de la colección de datos
        $data->push($total_row);

        //agregar 1 filas vacias
        $row_emty = ['','','','','','','', '','','', '', '','', '', ''
                ,'','','','','','','', '','','', '', '','', '', '','','',''
        ];
        $data->push($row_emty);
        //agregar filas para total otros ingresos
        $row_total = ['OTROS IGRESOS','0','0','0','0','0','0', '0','0','0', '0', '0','0', '0', '0'
                ,'0','0','0','0','0','0','0', '0','0','0', '0', '0','0', '0', '0','0','0','0'
        ];
        $data->push($row_total);
        //agregar filas para total GASTOS
        $row_total = ['TOTAL GASTOS','0','0','0','0','0','0', '0','0','0', '0', '0','0', '0', '0'
                ,'0','0','0','0','0','0','0', '0','0','0', '0', '0','0', '0', '0','0','0','0'
        ];
        $data->push($row_total);
        //agregar filas para trasferencias
        $row_total = ['TRANSFERENCIAS','0','0','0','0','0','0', '0','0','0', '0', '0','0', '0', '0'
                ,'0','0','0','0','0','0','0', '0','0','0', '0', '0','0', '0', '0','0','0','0'
        ];
        $data->push($row_total);
        //agregar filas para total efectivo caja
        $row_total = ['TOTAL EFEC. CAJA','0','0','0','0','0','0', '0','0','0', '0', '0','0', '0', '0'
                ,'0','0','0','0','0','0','0', '0','0','0', '0', '0','0', '0', '0','0','0','0'
        ];
        $data->push($row_total);
        //agregar filas para total deposito cta corriente
        $row_total = ['DEPOSITO CUENTA CORRIENTE','0','0','0','0','0','0', '0','0','0', '0', '0','0', '0', '0'
                ,'0','0','0','0','0','0','0', '0','0','0', '0', '0','0', '0', '0','0','0','0'
        ];
        $data->push($row_total);
        //agregar filas para total deposito BNB procede
        $row_total = ['DEPOSITO BNB(PROCEDE)','0','0','0','0','0','0', '0','0','0', '0', '0','0', '0', '0'
                ,'0','0','0','0','0','0','0', '0','0','0', '0', '0','0', '0', '0','0','0','0'
        ];
        $data->push($row_total);
        //agregar filas para total deposito bnb ins dep
        $row_total = ['DEPOSITO DEPOSITO BNB(INS. DEP.)','0','0','0','0','0','0', '0','0','0', '0', '0','0', '0', '0'
                ,'0','0','0','0','0','0','0', '0','0','0', '0', '0','0', '0', '0','0','0','0'
        ];
        $data->push($row_total);
        // agregar 1 fila vecia
        $row_emty = ['','','','','','','', '','','', '', '','', '', ''
                ,'','','','','','','', '','','', '', '','', '', '','','',''
        ];
        $data->push($row_emty);

        //agregar filas para total ingresos
        $row_total = ['TOTAL IGRESOS',$total_column33,'','','','','', '','','', '', '','', '', ''
                ,'','','','','','','', '','','', '', '','', '', '','','',''
            ];
        $data->push($row_total);
        //agregar filas para total transferecias
        $row_transf = ['TRASFERENCIAS','0','','','','','', '','','', '', '','', '', ''
                ,'','','','','','','', '','','', '', '','', '', '','','',''
            ];
        $data->push($row_transf);
        //agregar filas para total gastos directos de caja
        $row_caja = ['GASTOS DIRECTOS DE CAJA','0','','','','','', '','','', '', '','', '', ''
                ,'','','','','','','', '','','', '', '','', '', '','','',''
            ];
        $data->push($row_caja);
        //agregar filas para total gastos retiros
        $row_retiros = ['GASTOS POR RETIROS DE CTA BANCO','0','','','','','', '','','', '', '','', '', ''
                ,'','','','','','','', '','','', '', '','', '', '','','',''
            ];
        $data->push($row_retiros);
        //agregar filas para total utilidad mensual
        $row_retiros = ['UTILIDAD MENSUAL',$total_column33,'','','','','', '','','', '', '','', '', ''
                ,'','','','','','','', '','','', '', '','', '', '','','',''
            ];
        $data->push($row_retiros);
        return $data;
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
                $event->sheet->getStyle('A8:AG8')->applyFromArray($this->getStyleArray());
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

    protected function getStyleArray(): array
    {
        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 12,
                'color' => ['argb' => 'FFFDFD'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['argb' => 'ABA5A5'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '8A8888'],
                ],
            ],
            'wrapText' => true,
        ];

        return $styleArray;
    }
}
