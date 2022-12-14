<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class TAXRecords extends \Eloquent
{
    use SoftDeletes;

    protected $table = 'tax_records';

    public function notes()
    {
        return $this->hasMany('App\Models\TAXNote', 'tax_record_id', 'id');
    }

    public function crs()
    {
        return $this->hasMany('App\Models\TAXCurrentReturnStatus', 'tax_record_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany('App\Models\SYSAsset', 'for_id', 'id')->where('for', 'Tax Attachment');
    }

    public function profiling01()
    {
        return $this->hasOne('App\Models\TAXProfiling01', 'tax_id', 'id');
    }

    public function profiling02()
    {
        return $this->hasOne('App\Models\TAXProfiling02', 'tax_id', 'id');
    }

    public function profiling03()
    {
        return $this->hasOne('App\Models\TAXProfiling03', 'tax_id', 'id');
    }

    public function getCompanyAddress()
    {
        $address = '';
        if ($this->company_address_1 != null or $this->company_address_1 != '') {
            $address .= substr($this->company_address_1, -1) != ',' ? $this->company_address_1 . ', ' : $this->company_address_1 . ' ';
        }
        if ($this->company_address_2 != null or $this->company_address_2 != '') {
            $address .= substr($this->company_address_2, -1) != ',' ? $this->company_address_2 . ', ' : $this->company_address_2 . ' ';
        }
        if ($this->company_address_3 != null or $this->company_address_3 != '') {
            $address .= substr($this->company_address_3, -1) != ',' ? $this->company_address_3 . ', ' : $this->company_address_3 . ' ';
        }
        if ($this->company_postcode != null or $this->company_postcode != '') {
            $address .= $this->company_postcode . ', ';
        }
        if ($this->company_city != null or $this->company_city != '') {
            $address .= $this->company_city . ', ';
        }
        if ($this->company_state != null or $this->company_state != '') {
            $address .= $this->company_state . ', ';
        }

        return substr($address, 0, -2);
    }

    public function getCorrespondenceAddress()
    {
        $address = '';
        if ($this->correspondence_address_1 != null or $this->correspondence_address_1 != '') {
            $address .= substr($this->correspondence_address_1, -1) != ',' ? $this->correspondence_address_1 . ', ' : $this->correspondence_address_1 . ' ';
        }
        if ($this->correspondence_address_2 != null or $this->correspondence_address_2 != '') {
            $address .= substr($this->correspondence_address_2, -1) != ',' ? $this->correspondence_address_2 . ', ' : $this->correspondence_address_2 . ' ';
        }
        if ($this->correspondence_address_3 != null or $this->correspondence_address_3 != '') {
            $address .= substr($this->correspondence_address_3, -1) != ',' ? $this->correspondence_address_3 . ', ' : $this->correspondence_address_3 . ' ';
        }
        if ($this->correspondence_postcode != null or $this->correspondence_postcode != '') {
            $address .= $this->correspondence_postcode . ', ';
        }
        if ($this->correspondence_city != null or $this->correspondence_city != '') {
            $address .= $this->correspondence_city . ', ';
        }
        if ($this->correspondence_state != null or $this->correspondence_state != '') {
            $address .= $this->correspondence_state . ', ';
        }

        return substr($address, 0, -2);
    }

    public function getCDNAddress()
    {
        $address = '';
        if ($this->cdn_address_1 != null or $this->cdn_address_1 != '') {
            $address .= substr($this->cdn_address_1, -1) != ',' ? $this->cdn_address_1 . ', ' : $this->cdn_address_1 . ' ';
        }
        if ($this->cdn_address_2 != null or $this->cdn_address_2 != '') {
            $address .= substr($this->cdn_address_2, -1) != ',' ? $this->cdn_address_2 . ', ' : $this->cdn_address_2 . ' ';
        }
        if ($this->cdn_postcode != null or $this->cdn_postcode != '') {
            $address .= $this->cdn_postcode . ', ';
        }
        if ($this->cdn_city != null or $this->cdn_city != '') {
            $address .= $this->cdn_city . ', ';
        }
        if ($this->cdn_state != null or $this->cdn_state != '') {
            $address .= $this->cdn_state . ', ';
        }

        return substr($address, 0, -2);
    }
}
