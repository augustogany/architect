<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use \DB;

class Planilla implements FromCollection,WithHeadings,ShouldAutoSize,
WithCustomStartCell,WithTitle,WithEvents,WithDrawings
{
    protected $fechaInicio;
    protected $fechaFin;

    public function __construct($fechaInicio, $fechaFin)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = collect(DB::select("CALL ingresos_planillas_procedures(?,?)",array($this->fechaInicio,$this->fechaFin)));
        // Calcular la suma de cada columna
        $total_score = $data->sum('VisacFamiliar');
        $total_column3 = $data->sum('VisacComercio');
        $total_column4 = $data->sum('VisacOtros');
        $total_column5 = $data->sum('CertRegistro');
        $total_column6 = $data->sum('TimbreFort');
        $total_column7 = $data->sum('CertInscripcion');
        $total_column8 = $data->sum('CertTraslado');
        $total_column9 = $data->sum('CarpTransferencia');
        $total_column10 = $data->sum('FormContrato');
        $total_column11 = $data->sum('CarpProyectos');
        $total_column12 = $data->sum('CarpAvaluo');
        $total_column13 = $data->sum('CuotaMensual');
        $total_column14 = $data->sum('CuotaAnual');
        $total_column15 = $data->sum('TotalIngresos');
        
        // Crear una nueva fila con los totales de cada columna
        $total_row = ['','',$total_score, $total_column3, $total_column4, 
            $total_column5, $total_column6,$total_column7, $total_column8
            ,$total_column9, $total_column10, $total_column11, $total_column12
            ,$total_column13, $total_column14, $total_column15
        ];

        // Agregar la nueva fila al final de la colección de datos
        $data->push($total_row);
        //agregar 7 filas vacias
        for ($i=0; $i < 7; $i++) { 
            $row_emty = ['','','','','','','','', '','','', '', '','', '', ''];
            $data->push($row_emty);
        }
        //agregar las cuetas
        $row_account = ['','','','','','','','', '','','', '', 'CUETA','DEPOSITO', '', 'TOTAL'];
        $data->push($row_account);
        //Agregar suma de la primer cuenta
        $row_account_CTA_CTE = ['','','','','',''
            ,'','', '','','', '', 'CTA CTE','BANCO NACIONAL DE BOLIVIA', 'Nº 80000-17095', '0'
        ];
        $data->push($row_account_CTA_CTE);
        //Agregar suma de la segunda cuenta
        $row_account_PROCEDE = ['','ELABORADO POR','','','',''
            ,'','', '','','', '', 'PROCEDE','BANCO NACIONAL DE BOLIVIA', 'Nº 850-0212226', '0'
        ];
        $data->push($row_account_PROCEDE);
        //Agregar suma de la tercer cuenta
        $row_account_FDODEP = ['','','','','',''
            ,'','', '','','', '', 'FDO DEP','BANCO NACIONAL DE BOLIVIA', 'Nº 850-0444887', '0'
        ];
        $data->push($row_account_FDODEP);
         //Agregar suma del total depositado
         $row_account_total = ['','','','','',''
         ,'','', '','','', '', '','TOTAL DEPOSITADO', '', $total_column15
     ];
     $data->push($row_account_total);
        return $data;
    }
    
    public function headings(): array
    {
        return[
            ['PLANILLA DE INGRESOS'],
            ['CORRESPONDIENTES AL MES ACTUAL'], 
            [''],
            [
                '#',
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
                ['A4:O4',
                'A5:O5' // Fila intermedia
                ]);
                $event->sheet->getStyle('A7:P7')->applyFromArray($this->getStyleArray());
                $event->sheet->getDelegate()->freezePane('A6'); //Congela las filas anteriores
                $event->sheet->getStyle('A4:O4')->ApplyFromArray($colCenter);
                $event->sheet->getStyle('A5:O5')->ApplyFromArray($colCenter);
                // Encabezado
                $event->sheet->getStyle('A4:O4')->ApplyFromArray($borderThin);
                $event->sheet->getStyle('A5:O5')->ApplyFromArray($borderThin);
            }
        ];
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'INGRESO DIA';
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
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('logo');
        $drawing->setPath(public_path('/theme/dist/img/logo.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('B1');

        return $drawing;
    }
}
