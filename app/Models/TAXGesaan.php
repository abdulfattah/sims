<?php

namespace App\Models;

class TAXGesaan extends \Eloquent
{

    protected $table = 'tax_gesaan';

    public function crs()
    {
        return $this->hasOne('App\Models\TAXCurrentReturnStatus', 'id', 'tax_record_id');
    }
}
