<?php

namespace App\Excel\Imports;

use App\Models\SYSSetting;
use App\Models\TAXRecords;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TaxImportStatement implements ToModel, WithStartRow, WithBatchInserts
{
    protected $setting;

    public function __construct(SYSSetting $setting)
    {
        $this->setting = $setting;
    }

    public function model(array $row)
    {
        return new TAXRecords([
                                  'smk_no'                 => $row[5],
                                  'undeclaration_duration' => $row[11],
                                  'reminder_date'          => $row[12],
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
