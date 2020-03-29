<?php
namespace App\Models;

class SYSAsset extends \Eloquent
{
    protected $table = 'sys_asset';

    public function uploader()
    {
        return $this->hasOne('App\Models\USRUsers', 'id', 'upload_by');
    }
}
