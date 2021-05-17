<?php

namespace App\Models;

class TAXNote extends \Eloquent
{
    protected $table = 'tax_notes';

    public function writer()
    {
        return $this->hasOne('App\Models\USRUsers', 'id', 'note_by');
    }
}
