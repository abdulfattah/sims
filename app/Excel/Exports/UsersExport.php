<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Hyperlink;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Str;

class UsersExport implements FromCollection, ShouldAutoSize, WithHeadings, WithColumnFormatting, WithEvents
{
    use Exportable;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'Fullname',
            'Email',
            'Role'
        ];
    }

    public function columnFormats(): array
    {
        return [
            // 'F' => NumberFormat::FORMAT_TEXT,
            // 'G' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                //set font size
                //$event->sheet->getDelegate()->getStyle('A1:H1')->getFont()->setSize(12);
                //set background color
                //$event->sheet->getDelegate()->getStyle('A1:H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('23AAF2');
                //set row height
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);
                //set by array
                $event->sheet->getDelegate()->getStyle('A1:C1')->applyFromArray([
                    'font'      => [
                        'name'   => 'Calibri',
                        'bold'   => false,
                        'italic' => false,
                        'size'   => 12,
                    ],
                    'fill'      => [
                        'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '23AAF2',
                        ],

                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]
                );
                //set hyperlink mailto
                foreach ($event->sheet->getColumnIterator('B') as $row) {
                    foreach ($row->getCellIterator() as $cell) {
                        if (Str::contains($cell->getValue(), '@')) {
                            $cell->setHyperlink(new Hyperlink('mailto:' . $cell->getValue(), 'Klik untuk hantar email'));
                        }
                    }
                }
            },
        ];
    }
}
