<?php

namespace App\Models;

class TAXCurrentReturnStatus extends \Eloquent
{

    protected $table = 'tax_current_return_status';

    public function taxRecord()
    {
        return $this->hasOne('App\Models\TAXRecords', 'id', 'tax_record_id');
    }

    public function gesaans()
    {
        return $this->hasMany('App\Models\TAXGesaan', 'tax_crs_id', 'id');
    }
}
