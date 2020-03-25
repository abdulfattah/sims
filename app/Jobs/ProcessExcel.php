<?php

namespace App\Jobs;

use App\Excel\Imports\TaxImport;
use App\Models\SYSSetting;
use App\Models\TAXRecords;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $setting, $filename;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SYSSetting $setting, $filename)
    {
        $this->setting  = $setting;
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $taxRecords = Excel::toCollection(new TaxImport($this->setting),
            storage_path('assets') . DIRECTORY_SEPARATOR . 'syncronize' . DIRECTORY_SEPARATOR . $this->filename);
        foreach ($taxRecords as $records) {
            foreach ($records as $k => $v) {
                $check = TAXRecords::where('sst_no', $v[4])->get()->first();
                if ($check != null) {
                    $tax = $check;
                } else {
                    $tax = new TAXRecords();
                }
                
                $tax->registration_status      = $v[0];
                $tax->registration_date        = $v[1] != null ? date('Y-m-d', strtotime($v[1])) : null;
                $tax->cancellation_approval    = $v[2] != null ? date('Y-m-d', strtotime($v[2])) : null;
                $tax->cancellation_approval    = $v[3] != null ? date('Y-m-d', strtotime($v[3])) : null;
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
                $tax->save();

                $processedRow         = $k++;
                $this->setting->value = round(($processedRow / count($value)) * 100);
                $this->setting->save();
            }
        }
        $this->setting->delete();
    }
}