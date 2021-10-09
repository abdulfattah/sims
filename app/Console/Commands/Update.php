<?php

namespace App\Console\Commands;

use App\Libs\App;
use App\Models\SPDMarks;
use App\Models\TAXCurrentReturnStatus;
use App\Models\TAXGesaan;
use App\Models\TAXRecords;
use Illuminate\Console\Command;

class Update extends Command
{

    use App;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update apps';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $gesaans = TAXGesaan::all(); //kena masukka exam_id dan school id kat sini
        foreach ($gesaans as $gesaan) {
            $taxRecord = TAXRecords::find($gesaan->tax_record_id);
            if ($taxRecord != null) {
                $taxCrs = TAXCurrentReturnStatus::where('tax_record_id', $taxRecord->id)->where('crs_taxable_period', $taxRecord->crs_taxable_period)->get()->first();
                if ($taxCrs != null) {
                    $gesaan->tax_crs_id = $taxCrs->id;
                    $gesaan->save();
                } else {
                    $taxCrs = TAXCurrentReturnStatus::where('tax_record_id', $taxRecord->id)->orderBy('id')->get()->last();
                    if ($taxCrs != null) {
                        $gesaan->tax_crs_id = $taxCrs->id;
                        $gesaan->save();
                    }
                }
            }
        }
    }
}
