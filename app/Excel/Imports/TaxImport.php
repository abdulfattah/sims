<?php

namespace App\Excel\Imports;

use App\Models\SYSSetting;
use App\Models\TAXRecords;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TaxImport implements ToModel, WithStartRow, WithBatchInserts
{
    protected $setting;

    public function __construct(SYSSetting $setting)
    {
        $this->setting = $setting;
    }

    public function model(array $row)
    {
        return new TAXRecords([
            'registration_status'      => $row[0],
            'registration_date'        => $row[1],
            'cancellation_approval'    => $row[2],
            'cancellation_effective'   => $row[3],
            'sst_no'                   => $row[4],
            'station_code'             => $row[5],
            'station_name'             => $row[6],
            'gst_no'                   => $row[7],
            'brn_no'                   => $row[8],
            'business_name'            => $row[9],
            'trade_name'               => $row[10],
            'sst_type'                 => $row[11],
            'email_address'            => $row[12],
            'telephone_no'             => $row[13],
            'company_address_1'        => $row[14],
            'company_address_2'        => $row[15],
            'company_address_3'        => $row[16],
            'company_postcode'         => $row[17],
            'company_city'             => $row[18],
            'company_state'            => $row[19],
            'correspondence_address_1' => $row[20],
            'correspondence_address_2' => $row[21],
            'correspondence_address_3' => $row[22],
            'correspondence_postcode'  => $row[23],
            'correspondence_city'      => $row[24],
            'correspondence_state'     => $row[25]
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function batchSize(): int
    {
        return 100;
    }
}
