<?php

namespace App\Jobs;

use App\Excel\Imports\TaxImportCrs;
use App\Models\SYSSetting;
use App\Models\TAXRecords;
use Carbon\Carbon;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessExcelCrs implements ShouldQueue
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
        $taxRecords = Excel::toCollection(new TaxImportCrs($this->setting),
                                          storage_path('assets') . DIRECTORY_SEPARATOR . 'synchronize' . DIRECTORY_SEPARATOR . $this->filename);
        foreach ($taxRecords as $records) {
            foreach ($records as $k => $v) {
                $tax = TAXRecords::where('sst_no', $v[2])->withTrashed()->get()->first();
                if ($tax != null) {
                    $tax->crs_taxable_period     = $v[12];
                    $crsDueDate                = null;
                    if (strpos($v[12], '/') != false) {
                        $crsDueDate = str_replace(' ', '', $v[13]);
                        $crsDueDate = Carbon::createFromFormat('d/m/Y', $crsDueDate)->format('Y-m-d');
                    }
                    $tax->crs_due_date = $crsDueDate;
                    $tax->crs_submission_status  = $v[14];
                    $tax->crs_sst_02_no          = $v[15];
                    $crsSubmitDate                = null;
                    if (strpos($v[16], '/') != false) {
                        $crsSubmitDate = str_replace(' ', '', $v[16]);
                        $crsSubmitDate = Carbon::createFromFormat('d/m/Y', $crsSubmitDate)->format('Y-m-d');
                    }
                    $tax->crs_submit_date = $crsSubmitDate;
                    $tax->crs_mode_of_submission = $v[17];
                    $tax->crs_tax_payable        = $v[18];
                    $tax->crs_receipt_no         = $v[19];
                    $crsReceiptDate                = null;
                    if (strpos($v[20], '/') != false) {
                        $crsReceiptDate = str_replace(' ', '', $v[20]);
                        $crsReceiptDate = Carbon::createFromFormat('d/m/Y', $crsReceiptDate)->format('Y-m-d');
                    }
                    $tax->crs_receipt_date = $crsReceiptDate;
                    $tax->crs_receipt_amt        = $v[21];
                    $tax->crs_mode_of_payment    = $v[22];
                    $tax->crs_penalty_rate       = $v[23];
                    $tax->crs_penalty_amt        = $v[24];
                    $tax->crs_bod_status         = $v[25];
                    $tax->crs_bod_receipt_no     = $v[26];
                    $tax->crs_bod_tax_paid       = $v[27];
                    $tax->crs_bod_total_tax      = $v[28];
                    $tax->crs_bod_penalty_paid   = $v[29];
                    $tax->crs_bod_total_penalty   = $v[30];
                    $tax->save();

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
