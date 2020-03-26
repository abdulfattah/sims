@extends('main')
@section('content')
<div class="card">
    <div class="card-header">
        Show User's Information
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5>Basic Information</h5>
                <hr class="mt-1 mb-4">
                <dl class="row mt-2">
                    <dt class="col-sm-3 col-xl-3 pl-5">Business Name</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->business_name !!}</dd>
                    <dt class="col-sm-3 col-xl-3 pl-5">Trade Name</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->trade_name !!}</dd>
                    <dt class="col-sm-3 col-xl-3 pl-5">SST No</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->sst_no !!}</dd>
                    <dt class="col-sm-3 col-xl-3 pl-5">GST No</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->gst_no !!}</dd>
                    <dt class="col-sm-3 col-xl-3 pl-5">Registration Status</dt>
                    <dd class="col-sm-9 col-xl-8">: @if($tax->registration_status == 'CANCEL')<span class="badge badge-danger">{!! $tax->registration_status !!}</span>@else<span
                            class="badge badge-info">{!! $tax->registration_status !!}</span>@endif</dd>
                    <dt class="col-sm-3 col-xl-3 pl-5">Registration Date</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->registration_date != null ? date('d M Y', strtotime($tax->registration_date)) : null !!}</dd>
                    <dt class="col-sm-3 col-xl-3 pl-5">Cancellation Approval</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->cancellation_approval != null ? date('d M Y', strtotime($tax->cancellation_approval)) : null !!}</dd>
                    <dt class="col-sm-3 col-xl-3 pl-5">Cancellation Effective</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->cancellation_effective != null ? date('d M Y', strtotime($tax->cancellation_effective)) : null !!}</dd>
                    <dt class="col-sm-3 col-xl-3 pl-5">Station Code</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->station_code !!}</dd>
                    <dt class="col-sm-3 col-xl-3 pl-5">Station Name</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->station_name !!}</dd>
                    <dt class="col-sm-3 col-xl-3 pl-5">BRN No</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->brn_no !!}</dd>
                    <dt class="col-sm-3 col-xl-3 pl-5">SST Type</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->sst_type !!}</dd>
                    <dt class="col-sm-3 col-xl-3 pl-5">Email Address</dt>
                    <dd class="col-sm-9 col-xl-8">: <a href="mailto:{!! $tax->email_address !!}" target="_blank" class="text-navy">{!! $tax->email_address !!}</a></dd>
                    <dt class="col-sm-3 col-xl-3 pl-5">Telephone No</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->telephone_no !!}</dd>
                </dl>
                
                <h5>Address Information</h5>
                <hr class="mt-1 mb-4">
                <dl class="row mt-2">
                    <dt class="col-sm-3 col-xl-3 pl-5">Company Address</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->getCompanyAddress() !!}</dd>
                    <dt class="col-sm-3 col-xl-3 pl-5">Correspondence Address</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->getCorrespondenceAddress() !!}</dd>
                </dl>
                
                <h5>Others Information</h5>
                <hr class="mt-1 mb-4">
                <dl class="row mt-2">
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
                    <dt class="col-sm-3 col-xl-3 pl-5">Last Syncronize</dt>
                    <dd class="col-sm-9 col-xl-8">: {!! $tax->syncronizing_at != null ? date('d M Y', strtotime($tax->syncronizing_at)) : null !!}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="card-footer text-right">
        <button type="button" class="btn btn-sm btn-primary" style="height: 33px;width: 35px;" data-toggle="tooltip" data-placement="top" data-title="Back"
            onclick="location.href = '{{ URL::to('tax') }}';">
            <svg class="c-icon mr-2">
                <use xlink:href="{!! asset('icons/free.svg#cil-chevron-left') !!}"></use>
            </svg>
        </button>
        <button type="button" class="btn btn-sm btn-primary" style="height: 33px" onclick="location.href = '{{ URL::to('tax/' . $tax->id . '/edit') }}';">
            Update
        </button>
    </div>
</div>
@stop