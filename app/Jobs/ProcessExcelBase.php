<?php

namespace App\Jobs;

use App\Excel\Imports\TaxImportBase;
use App\Models\SYSSetting;
use App\Models\TAXRecords;
use Carbon\Carbon;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessExcelBase implements ShouldQueue
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
        $taxRecords = Excel::toCollection(new TaxImportBase($this->setting),
                                          storage_path('assets') . DIRECTORY_SEPARATOR . 'synchronize' . DIRECTORY_SEPARATOR . $this->filename);
        foreach ($taxRecords as $records) {
            foreach ($records as $k => $v) {
                $check = TAXRecords::where('sst_no', $v[4])->withTrashed()->get()->first();
                if ($check != null) {
                    $tax = $check;
                } else {
                    $tax = new TAXRecords();
                }

                $tax->registration_status      = $v[0];
                $registrationDate = null;
                if (strpos($v[1], '/') !== false) {
                    $registrationDate = str_replace(' ', '', $v[1]);
                    $registrationDate = Carbon::createFromFormat('d/m/Y', $registrationDate)->format('Y-m-d');
                } else {
                    if (!empty($v[1])) {
                        $registrationDate = Carbon::parse($v[1])->format('Y-m-d');
                        if ($registrationDate == '1970-01-01') {
                            $registrationDate = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($v[1]));
                            $registrationDate = $registrationDate->format('Y-m-d');
                        }
                    }
                }
                $tax->registration_date = $registrationDate;

                $cancellationApproval = null;
                if (strpos($v[2], '/') !== false) {
                    $cancellationApproval = str_replace(' ', '', $v[2]);
                    $cancellationApproval = Carbon::createFromFormat('d/m/Y', $cancellationApproval)->format('Y-m-d');
                } else {
                    if (!empty($v[2])) {
                        $cancellationApproval = Carbon::parse($v[2])->format('Y-m-d');
                        if ($cancellationApproval == '1970-01-01') {
                            $cancellationApproval = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($v[2]));
                            $cancellationApproval = $cancellationApproval->format('Y-m-d');
                        }
                    }
                }
                $tax->cancellation_approval = $cancellationApproval;

                $cancellationEffective = null;
                if (strpos($v[3], '/') !== false) {
                    $cancellationEffective = str_replace(' ', '', $v[3]);
                    $cancellationEffective = Carbon::createFromFormat('d/m/Y', $cancellationEffective)->format('Y-m-d');
                } else {
                    if (!empty($v[3])) {
                        $cancellationEffective = Carbon::parse($v[3])->format('Y-m-d');
                        if ($cancellationEffective == '1970-01-01') {
                            $cancellationEffective = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($v[3]));
                            $cancellationEffective = $cancellationEffective->format('Y-m-d');
                        }
                    }
                }
                $tax->cancellation_effective = $cancellationEffective;

                $tax->sst_no                   = $v[4];
                $tax->station_code             = $v[5];
                $tax->station_name             = $v[6];
                $tax->gst_no                   = $v[7];
                $tax->brn_no                   = $v[8];
                $tax->business_name            = $v[9];
                $tax->trade_name               = $v[10];
                $tax->sst_type                 = $v[11];
                $tax->email_address            = $v[12];
                $tax->telephone_no             = $v[13];
                $tax->company_address_1        = $v[14];
                $tax->company_address_2        = $v[15];
                $tax->company_address_3        = $v[16];
                $tax->company_postcode         = $v[17];
                $tax->company_city             = $v[18];
                $tax->company_state            = $v[19];
                $tax->correspondence_address_1 = $v[20];
                $tax->correspondence_address_2 = $v[21];
                $tax->correspondence_address_3 = $v[22];
                $tax->correspondence_postcode  = $v[23];
                $tax->correspondence_city      = $v[24];
                $tax->correspondence_state     = $v[25];
                $tax->syncronizing_at          = date('Y-m-d H:i:s');
                $tax->save();

                activity('tax')
                    ->causedBy($this->user)
                    ->performedOn($tax)
                    ->log('Syncronization from SST System');

                $processedRow         = $k++;
                $this->setting->value = round(($processedRow / count($records)) * 100);
                $this->setting->save();
            }
        }
        $this->setting->delete();
    }
}
