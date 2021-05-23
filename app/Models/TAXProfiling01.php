<?php

namespace App\Models;

class TAXProfiling01 extends \Eloquent
{
    protected $table = 'tax_profiling_01';

    public function preparedBy()
    {
        return $this->hasOne('App\Models\USRUsers', 'id', 'prepared_by');
    }

    public function checkedBy()
    {
        return $this->hasOne('App\Models\USRUsers', 'id', 'checked_by');
    }
}
