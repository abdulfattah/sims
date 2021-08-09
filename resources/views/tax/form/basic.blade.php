<span class="badge badge-success float-right" style="margin-top: -15px; padding: 0.50em 0.6em;">Last synchronize at {{ $tax->syncronizing_at != null ? date('d-M-Y h:i:s A',
    strtotime($tax->syncronizing_at)) : null }}</span>
<dl class="row mt-4">
    <dt class="col-sm-3 col-xl-3 pl-5">Business Name</dt>
    <dd class="col-sm-9 col-xl-8">{{ $tax->business_name }}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Trade Name</dt>
    <dd class="col-sm-9 col-xl-8">{{ $tax->trade_name }}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Company Address</dt>
    <dd class="col-sm-9 col-xl-8">{{ $tax->getCompanyAddress() }}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Correspondence Address</dt>
    <dd class="col-sm-9 col-xl-8">{{ $tax->getCorrespondenceAddress() }}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">SST No</dt>
    <dd class="col-sm-9 col-xl-8">{{ $tax->sst_no }}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">GST No</dt>
    <dd class="col-sm-9 col-xl-8">{{ $tax->gst_no }}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Registration Status</dt>
    <dd class="col-sm-9 col-xl-8">@if($tax->registration_status == 'CANCEL')<span class="badge badge-danger">{{ $tax->registration_status }}</span>@else<span
                class="badge badge-info">{{
            $tax->registration_status }}</span>@endif</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Registration Date</dt>
    <dd class="col-sm-9 col-xl-8">{{ $tax->registration_date != null ? date('d M Y', strtotime($tax->registration_date)) : null }}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Cancellation Approval</dt>
    <dd class="col-sm-9 col-xl-8">{{ $tax->cancellation_approval != null ? date('d M Y', strtotime($tax->cancellation_approval)) : null }}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Cancellation Effective</dt>
    <dd class="col-sm-9 col-xl-8">{{ $tax->cancellation_effective != null ? date('d M Y', strtotime($tax->cancellation_effective)) : null }}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Station Code</dt>
    <dd class="col-sm-9 col-xl-8">{{ $tax->station_code }}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Station Name</dt>
    <dd class="col-sm-9 col-xl-8">{{ $tax->station_name }}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">BRN No</dt>
    <dd class="col-sm-9 col-xl-8">{{ $tax->brn_no }}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">SST Type</dt>
    <dd class="col-sm-9 col-xl-8">{{ $tax->sst_type }}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Email Address</dt>
    <dd class="col-sm-9 col-xl-8">: <a href="mailto:{{ $tax->email_address }}" target="_blank" class="text-navy">{{ $tax->email_address }}</a></dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Telephone No</dt>
    <dd class="col-sm-9 col-xl-8">{{ $tax->telephone_no }}</dd>
</dl>
