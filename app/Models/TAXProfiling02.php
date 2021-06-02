<?php

namespace App\Models;

class TAXProfiling02 extends \Eloquent
{
    protected $table = 'tax_profiling_02';

    public function preparedBy()
    {
        return $this->hasOne('App\Models\USRUsers', 'id', 'prepared_by');
    }

    public function checkedBy()
    {
        return $this->hasOne('App\Models\USRUsers', 'id', 'checked_by');
    }
}
