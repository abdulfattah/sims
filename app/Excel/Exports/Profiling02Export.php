<?php

namespace App\Excel\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Profiling02Export implements FromCollection, ShouldAutoSize, WithHeadings, WithColumnFormatting, WithEvents
{
    use Exportable;

    private $data, $column;

    public function __construct($data, $column)
    {
        $this->data   = $data;
        $this->column = $column;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        $cols    = [
            'business_name' => 'Business Name',
            'brn_no'        => 'BRN No',
            'mark_01'         => 'S1',
            'mark_02'         => 'S2',
            'mark_03'         => 'S3',
            'mark_04'         => 'S4',
            'mark_05'         => 'S5',
            'mark_06'         => 'S6',
            'mark_07'         => 'S7',
            'mark_08'         => 'S8',
            'mark_09'         => 'S9',
            'mark_10'         => 'S10',
            'mark_11'         => 'S11',
            'mark_12'         => 'S12',
            'risk_level_text' => 'Risk Level',
        ];
        $newCols = [];
        foreach ($this->column as $col) {
            array_push($newCols, $cols[$col]);
        }

        return $newCols;
    }

    public function columnFormats(): array
    {
        return [
            'A'  => NumberFormat::FORMAT_TEXT,
            'B'  => NumberFormat::FORMAT_TEXT,
            'C'  => NumberFormat::FORMAT_TEXT,
            'D'  => NumberFormat::FORMAT_TEXT,
            'E'  => NumberFormat::FORMAT_TEXT,
            'F'  => NumberFormat::FORMAT_TEXT,
            'G'  => NumberFormat::FORMAT_TEXT,
            'H'  => NumberFormat::FORMAT_TEXT,
            'I'  => NumberFormat::FORMAT_TEXT,
            'J'  => NumberFormat::FORMAT_TEXT,
            'K'  => NumberFormat::FORMAT_TEXT,
            'L'  => NumberFormat::FORMAT_TEXT,
            'M'  => NumberFormat::FORMAT_TEXT,
            'N'  => NumberFormat::FORMAT_TEXT,
            'O'  => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);
                //set by array
                $event->sheet->getDelegate()->getStyle('A1:O1')->applyFromArray([
                                                                                     'font'      => [
                                                                                         'name'   => 'Calibri',
                                                                                         'bold'   => true,
                                                                                         'italic' => false,
                                                                                         'size'   => 12,
                                                                                     ],
                                                                                     'alignment' => [
                                                                                         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                                                                         'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                                                                                     ],
                                                                                 ]
                );
            },
        ];
    }
}
