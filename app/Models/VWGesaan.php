<?php

namespace App\Models;

class VWGesaan extends \Eloquent
{

    protected $table = 'vw_gesaan';

    public function taxRecord()
    {
        return $this->hasOne('App\Models\TAXRecords', 'id', 'tax_record_id');
    }
}
