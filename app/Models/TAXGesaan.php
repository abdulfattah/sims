<?php

namespace App\Models;

class TAXGesaan extends \Eloquent
{

    protected $table = 'tax_gesaan';

    public function taxRecord()
    {
        return $this->hasOne('App\Models\TAXRecords', 'id', 'tax_record_id');
    }
}
