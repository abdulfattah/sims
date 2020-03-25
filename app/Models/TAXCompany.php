<?php
namespace App\Models;

class TAXCompany extends \Eloquent
{
    protected $table = 'tax_companies';

    // public function properties()
    // {
    //     return $this->belongsToMany('App\Models\PROProperty', 'pro_property_owner', 'owner_id', 'property_id');
    // }

    // public function avatar()
    // {
    //     return $this->hasOne('App\Models\SYSAsset', 'for_id', 'id')->where('for', 'Owner Avatar');
    // }
}
