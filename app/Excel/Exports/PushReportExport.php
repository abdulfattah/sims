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

class PushReportExport implements FromCollection, ShouldAutoSize, WithHeadings, WithColumnFormatting, WithEvents
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
            'push_type'               => 'JENIS',
            'business_name'           => 'BUSINESS NAME',
            'sst_no'                  => 'SST NO',
            'email_address'           => 'EMAIL ADDRESS',
            'telephone_no'            => 'TELEPHONE',
            'crs_taxable_period'      => 'TAXABLE PERIOD',
            'crs_due_date'            => 'DUE DATE',
            'push_gesaan_date'        => 'TARIKH GESAAN',
            'push_status_penyata'     => 'STATUS PENYATA',
            'push_pic'                => 'PEGAWAI',
            'push_email_date'         => 'EMAIL (TARIKH)',
            'push_email_time'         => 'EMAIL (MASA)',
            'push_phone_date'         => 'TELEFON (TARIKH)',
            'push_phone_time'         => 'TELEFON (MASA)',
            'push_whatsapp_date'      => 'WHATSAPP (TARIKH)',
            'push_whatsapp_time'      => 'WHATSAPP (MASA)',
            'push_visit_date'         => 'LAWATAN (TARIKH)',
            'push_visit_time'         => 'LAWATAN (MASA)',
            'push_bod_penalty_rate'   => 'B.O.D (PENALTY RATE)',
            'push_bod_penalty_amount' => 'B.O.D (PENALTY AMOUNT)',
            'push_bod_status'         => 'B.O.D (STATUS)',
            'push_bod_abt'            => 'B.O.D (ABT)',
            'push_bod_no'             => 'B.O.D (NO)',
            'push_bod_tax_amount'     => 'B.O.D (TAX AMOUNT)'
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
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_TEXT,
            'K' => NumberFormat::FORMAT_TEXT,
            'L' => NumberFormat::FORMAT_TEXT,
            'M' => NumberFormat::FORMAT_TEXT,
            'N' => NumberFormat::FORMAT_TEXT,
            'O' => NumberFormat::FORMAT_TEXT,
            'P' => NumberFormat::FORMAT_TEXT,
            'Q' => NumberFormat::FORMAT_TEXT,
            'R' => NumberFormat::FORMAT_TEXT,
            'S' => NumberFormat::FORMAT_TEXT,
            'T' => NumberFormat::FORMAT_TEXT,
            'U' => NumberFormat::FORMAT_TEXT,
            'V' => NumberFormat::FORMAT_TEXT,
            'W' => NumberFormat::FORMAT_TEXT,
            'X' => NumberFormat::FORMAT_TEXT
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
                $event->sheet->getDelegate()->getStyle('A1:X1')->applyFromArray([
                                                                                     'font'      => [
                                                                                         'name'   => 'Calibri',
                                                                                         'bold'   => true,
                                                                                         'italic' => false,
                                                                                         'size'   => 12,
                                                                                     ],
                                                                                     // 'fill'      => [
                                                                                     //     'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                                                                     //     'startColor' => [
                                                                                     //         'rgb' => '23AAF2',
                                                                                     //     ],

                                                                                     // ],
                                                                                     'alignment' => [
                                                                                         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                                                                         'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                                                                                     ],
                                                                                 ]
                );
                //set hyperlink mailto
                // foreach ($event->sheet->getColumnIterator('B') as $row) {
                //     foreach ($row->getCellIterator() as $cell) {
                //         if (Str::contains($cell->getValue(), '@')) {
                //             $cell->setHyperlink(new Hyperlink('mailto:' . $cell->getValue(), 'Klik untuk hantar email'));
                //         }
                //     }
                // }
            },
        ];
    }
}
