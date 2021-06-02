<div class="row">
    <div class="col-md-12">
        <h5>Additional Information</h5>
        <hr class="mt-1 mb-1">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <dl class="row mt-4">
            <dt class="col-sm-3 col-xl-3">Factory Name</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->factory_name }}</dd>
            <dt class="col-sm-3 col-xl-3">Entity Type</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->entity_type }}</dd>
            <dt class="col-sm-3 col-xl-3">Business Activity</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->business_activity }}</dd>
            <dt class="col-sm-3 col-xl-3">Product Tax</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->product_tax }}</dd>
            <dt class="col-sm-3 col-xl-3">Facility Applied</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->facility_applied }}</dd>
            <dt class="col-sm-3 col-xl-3">Local Marketing</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->local_marketing }}</dd>
            <dt class="col-sm-3 col-xl-3">Statement</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->statement }}</dd>
            <dt class="col-sm-3 col-xl-3">Statement Status</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->statement_status }}</dd>
            <dt class="col-sm-3 col-xl-3">Uncomplience Type</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->uncomplience_type }}</dd>
        </dl>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h5>Current Address & Contact Person</h5>
        <hr class="mt-1 mb-1">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <dl class="row mt-4">
            <dt class="col-sm-3 col-xl-3">Address</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->getCDNAddress() }}</dd>
            <dt class="col-sm-3 col-xl-3">Officer In Charge</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->cdn_officer }}</dd>
            <dt class="col-sm-3 col-xl-3">Phone No</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->cdn_phone_no }}</dd>
            <dt class="col-sm-3 col-xl-3">Email Address</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->cdn_email }}</dd>
        </dl>
    </div>
</div>
<div class="text-right">
    <a href="{{ URL::to('tax/' . $tax->id . '/edit?section=additional') }}" class="btn btn-sm btn-primary" style="height: 33px">
        Update
    </a>
</div>
