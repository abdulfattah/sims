<?php

namespace App\Jobs;

use App\Excel\Imports\TaxImportStatement;
use App\Models\SYSSetting;
use App\Models\TAXRecords;
use Carbon\Carbon;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessExcelStatement implements ShouldQueue
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
        $taxRecords = Excel::toCollection(new TaxImportStatement($this->setting),
                                          storage_path('assets') . DIRECTORY_SEPARATOR . 'synchronize' . DIRECTORY_SEPARATOR . $this->filename);
        foreach ($taxRecords as $records) {
            foreach ($records as $k => $v) {
                $tax = TAXRecords::where('sst_no', $v[4])->withTrashed()->get()->first();
                if ($tax != null) {
                    $tax->smk_no                 = $v[5];
                    $tax->undeclaration_duration = $v[11];

                    $reminderDate                = null;
                    if (strpos($v[12], '/') !== false) {
                        $reminderDate = str_replace(' ', '', $v[12]);
                        $reminderDate = Carbon::createFromFormat('d/m/Y', $reminderDate)->format('Y-m-d');
                    } else {
                        if (!empty($v[12])) {
                            $reminderDate = Carbon::parse($v[12])->format('Y-m-d');
                            if ($reminderDate == '1970-01-01') {
                                $reminderDate = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($v[12]));
                                $reminderDate = $reminderDate->format('Y-m-d');
                            }
                        }
                    }
                    $tax->reminder_date = $reminderDate;

                    $tax->save();

                    activity('tax')
                        ->causedBy($this->user)
                        ->performedOn($tax)
                        ->log('Update statement');
                }

                $processedRow         = $k++;
                $this->setting->value = round(($processedRow / count($records)) * 100);
                $this->setting->save();
            }
        }
        $this->setting->delete();
    }
}
