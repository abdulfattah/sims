<?php

namespace App\Jobs;

use App\Excel\Imports\CompaniesImport;
use App\Models\SYSSetting;
use App\Models\TAXCompany;
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
        $companies = Excel::toCollection(new CompaniesImport($this->setting),
            storage_path('assets') . DIRECTORY_SEPARATOR . 'syncronize' . DIRECTORY_SEPARATOR . $this->filename);
        foreach ($companies as $key => $value) {
            foreach ($value as $k => $v) {
                $check = TAXCompany::where('sst_no', $v[4])->get()->first();
                if ($check != null) {
                    $company = $check;
                } else {
                    $company = new TAXCompany();
                }
                
                $company->registration_status      = $v[0];
                $company->registration_date        = $v[1] != null ? date('Y-m-d', strtotime($v[1])) : null;
                $company->cancellation_approval    = $v[2] != null ? date('Y-m-d', strtotime($v[2])) : null;
                $company->cancellation_approval    = $v[3] != null ? date('Y-m-d', strtotime($v[3])) : null;
                $company->sst_no                   = $v[4];
                $company->station_code             = $v[5];
                $company->station_name             = $v[6];
                $company->gst_no                   = $v[7];
                $company->brn_no                   = $v[8];
                $company->business_name            = $v[9];
                $company->trade_name               = $v[10];
                $company->sst_type                 = $v[11];
                $company->email_address            = $v[12];
                $company->telephone_no             = $v[13];
                $company->company_address_1        = $v[14];
                $company->company_address_2        = $v[15];
                $company->company_address_3        = $v[16];
                $company->company_postcode         = $v[17];
                $company->company_city             = $v[18];
                $company->company_state            = $v[19];
                $company->correspondence_address_1 = $v[20];
                $company->correspondence_address_2 = $v[21];
                $company->correspondence_address_3 = $v[22];
                $company->correspondence_postcode  = $v[23];
                $company->correspondence_city      = $v[24];
                $company->correspondence_state     = $v[25];
                $company->save();

                $processedRow         = $k++;
                $this->setting->value = round(($processedRow / count($value)) * 100);
                $this->setting->save();
            }
        }
        $this->setting->delete();
    }
}
