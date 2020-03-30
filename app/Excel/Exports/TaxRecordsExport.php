<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class TaxRecordsExport implements FromCollection, ShouldAutoSize, WithHeadings, WithColumnFormatting, WithEvents
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
        $cols = [
            'registration_status'      => 'Registration Status',
            'registration_date'        => 'Registration Date',
            'cancellation_approval'    => 'Cancellation Approval',
            'cancellation_effective'   => 'Cancellation Effective',
            'sst_no'                   => 'SST No',
            'station_code'             => 'Station Code',
            'station_name'             => 'Station Name',
            'gst_no'                   => 'GST No',
            'brn_no'                   => 'BRN No',
            'business_name'            => 'Business Name',
            'trade_name'               => 'Trade Name',
            'sst_type'                 => 'SST Type',
            'email_address'            => 'Email Address',
            'telephone_no'             => 'Telephone No',
            'company_address_1'        => 'Company Address 1',
            'company_address_2'        => 'Company Address 2',
            'company_address_3'        => 'Company Address 3',
            'company_postcode'         => 'Company Postcode',
            'company_city'             => 'Company City',
            'company_state'            => 'Company State',
            'correspondence_address_1' => 'Correspondence Address 1',
            'correspondence_address_2' => 'Correspondence Address 2',
            'correspondence_address_3' => 'Correspondence Address 3',
            'correspondence_postcode'  => 'Correspondence Postcode',
            'correspondence_city'      => 'Correspondence City',
            'correspondence_state'     => 'Correspondence State',
            'factory_name'             => 'Favtory Name',
            'entity_type'              => 'Entity Type',
            'business_activity'        => 'Business Activity',
            'product_tax'              => 'Product Tax',
            'facility_applied'         => 'Facility Applied',
            'local_marketing'          => 'Local Marketing',
            'statement'                => 'Statement',
            'statement_status'         => 'Statement Status',
            'uncomplience_type'        => 'Uncomplience Type',
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
                // $event->sheet->getDelegate()->getStyle('A1:C1')->applyFromArray([
                //     'font'      => [
                //         'name'   => 'Calibri',
                //         'bold'   => false,
                //         'italic' => false,
                //         'size'   => 12,
                //     ],
                //     'fill'      => [
                //         'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                //         'startColor' => [
                //             'rgb' => '23AAF2',
                //         ],

                //     ],
                //     'alignment' => [
                //         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                //         'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                //     ],
                // ]
                // );
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
