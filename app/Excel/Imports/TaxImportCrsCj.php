<?php

namespace App\Excel\Imports;

use App\Models\SYSSetting;
use App\Models\TAXRecords;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TaxImportCrsCj implements ToModel, WithStartRow, WithBatchInserts
{
    protected $setting;

    public function __construct(SYSSetting $setting)
    {
        $this->setting = $setting;
    }

    public function model(array $row)
    {
        return new TAXRecords([
                                  'sst_no'                 => $row[2],
                                  'crs_taxable_period'     => $row[11],
                                  'crs_due_date'           => $row[12],
                                  'crs_submission_status'  => $row[13],
                                  'crs_sst_02_no'          => $row[14],
                                  'crs_submit_date'        => $row[15],
                                  'crs_mode_of_submission' => $row[16],
                                  'crs_tax_payable'        => $row[17],
                                  'crs_receipt_no'         => $row[18],
                                  'crs_receipt_date'       => $row[19],
                                  'crs_receipt_amt'        => $row[20],
                                  'crs_mode_of_payment'    => $row[21],
                                  'crs_penalty_rate'       => $row[22],
                                  'crs_penalty_amt'        => $row[23],
                                  'crs_bod_status'         => $row[24],
                                  'crs_bod_receipt_no'     => $row[25],
                                  'crs_bod_tax_paid'       => $row[26],
                                  'crs_bod_total_tax'      => $row[27],
                                  'crs_bod_penalty_paid'   => $row[28],
                                  'crs_bod_total_penalty'  => $row[29],

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
