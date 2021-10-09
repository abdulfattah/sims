<?php

namespace App\Jobs;

use App\Excel\Imports\TaxImportCrsCj;
use App\Models\SYSSetting;
use App\Models\TAXCurrentReturnStatus;
use App\Models\TAXRecords;
use Carbon\Carbon;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessExcelCrsCj implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 1800;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 10;

    protected $setting, $filename, $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SYSSetting $setting, $filename, $user)
    {
        $this->setting  = $setting;
        $this->filename = $filename;
        $this->user     = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $taxRecords = Excel::toCollection(new TaxImportCrsCj($this->setting),
                                          storage_path('assets') . DIRECTORY_SEPARATOR . 'synchronize' . DIRECTORY_SEPARATOR . $this->filename);
        foreach ($taxRecords as $records) {
            foreach ($records as $k => $v) {
                $tax = TAXRecords::where('sst_no', $v[2])->withTrashed()->get()->first();
                if ($tax != null) {
                    $crs = TAXCurrentReturnStatus::where('tax_record_id', $tax->id)->where('crs_taxable_period', $v[11])->get()->first();
                    if ($crs == null) {
                        $crs                     = new TAXCurrentReturnStatus();
                        $crs->tax_record_id      = $tax->id;
                        $crs->tax_sst_no         = $tax->sst_no;
                        $crs->excel_type         = 'CJ';
                        $crs->crs_taxable_period = $v[11];
                    }
                    $crsDueDate = null;
                    if (strpos($v[12], '/') !== false) {
                        $crsDueDate = str_replace(' ', '', $v[12]);
                        $crsDueDate = Carbon::createFromFormat('d/m/Y', $crsDueDate)->format('Y-m-d');
                    } else {
                        if (!empty($v[12])) {
                            $crsDueDate = Carbon::parse($v[12])->format('Y-m-d');
                            if ($crsDueDate == '1970-01-01') {
                                $crsDueDate = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($v[12]));
                                $crsDueDate = $crsDueDate->format('Y-m-d');
                            }
                        }
                    }
                    $crs->crs_due_date          = $crsDueDate;
                    $crs->crs_submission_status = $v[13];
                    $crs->crs_sst_02_no         = $v[14];
                    $crsSubmitDate              = null;
                    if (strpos($v[15], '/') !== false) {
                        $crsSubmitDate = str_replace(' ', '', $v[15]);
                        $crsSubmitDate = Carbon::createFromFormat('d/m/Y', $crsSubmitDate)->format('Y-m-d');
                    } else {
                        if (!empty($v[15])) {
                            $crsSubmitDate = Carbon::parse($v[15])->format('Y-m-d');
                            if ($crsSubmitDate == '1970-01-01') {
                                $crsSubmitDate = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($v[15]));
                                $crsSubmitDate = $crsSubmitDate->format('Y-m-d');
                            }
                        }
                    }
                    $crs->crs_submit_date        = $crsSubmitDate;
                    $crs->crs_mode_of_submission = $v[16];
                    $crs->crs_tax_payable        = $v[17];
                    $crs->crs_receipt_no         = $v[18];
                    $crsReceiptDate              = null;
                    if (strpos($v[19], '/') !== false) {
                        $crsReceiptDate = str_replace(' ', '', $v[19]);
                        $crsReceiptDate = Carbon::createFromFormat('d/m/Y', $crsReceiptDate)->format('Y-m-d');
                    } else {
                        if (!empty($v[19])) {
                            $crsReceiptDate = Carbon::parse($v[19])->format('Y-m-d');
                            if ($crsReceiptDate == '1970-01-01') {
                                $crsReceiptDate = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($v[19]));
                                $crsReceiptDate = $crsReceiptDate->format('Y-m-d');
                            }
                        }
                    }
                    $crs->crs_receipt_date      = $crsReceiptDate;
                    $crs->crs_receipt_amt       = $v[20];
                    $crs->crs_mode_of_payment   = $v[21];
                    $crs->crs_penalty_rate      = $v[22];
                    $crs->crs_penalty_amt       = $v[23];
                    $crs->crs_bod_status        = $v[24];
                    $crs->crs_bod_receipt_no    = $v[25];
                    $crs->crs_bod_tax_paid      = $v[26];
                    $crs->crs_bod_total_tax     = $v[27];
                    $crs->crs_bod_penalty_paid  = $v[28];
                    $crs->crs_bod_total_penalty = $v[29];
                    $crs->save();

                    activity('tax')
                        ->causedBy($this->user)
                        ->performedOn($tax)
                        ->log('Update CRS');
                }

                $processedRow         = $k++;
                $this->setting->value = round(($processedRow / count($records)) * 100);
                $this->setting->save();
            }
        }
        $this->setting->delete();
    }
}
