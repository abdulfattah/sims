<span class="badge badge-success float-right" style="margin-top: -15px; padding: 0.50em 0.6em;">Last Updated at {!! $tax->updated_at != null ? date('d-M-Y h:i:s A',
    strtotime($tax->updated_at)) : null !!}</span>
<dl class="row mt-4">
    <dt class="col-sm-3 col-xl-3 pl-5">Factory Name</dt>
    <dd class="col-sm-9 col-xl-8">: {!! $tax->factory_name !!}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Entity Type</dt>
    <dd class="col-sm-9 col-xl-8">: {!! $tax->entity_type !!}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Business Activity</dt>
    <dd class="col-sm-9 col-xl-8">: {!! $tax->business_activity !!}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Product Tax</dt>
    <dd class="col-sm-9 col-xl-8">: {!! $tax->product_tax !!}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Facility Applied</dt>
    <dd class="col-sm-9 col-xl-8">: {!! $tax->facility_applied !!}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Local Marketing</dt>
    <dd class="col-sm-9 col-xl-8">: {!! $tax->local_marketing !!}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Statement</dt>
    <dd class="col-sm-9 col-xl-8">: {!! $tax->statement !!}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Statement Status</dt>
    <dd class="col-sm-9 col-xl-8">: {!! $tax->statement_status !!}</dd>
    <dt class="col-sm-3 col-xl-3 pl-5">Uncomplience Type</dt>
    <dd class="col-sm-9 col-xl-8">: {!! $tax->uncomplience_type !!}</dd>
</dl>
<div class="text-right">
    <a href="{{ URL::to('tax/' . $tax->id . '/edit?section=additional') }}" class="btn btn-sm btn-primary" style="height: 33px">
        Update
    </a>
</div>