<div class="row">
    <div class="col-md-12">
        <h5>From SST System</h5>
        <hr class="mt-1 mb-3">
        <span class="badge badge-success float-right" style="margin-top: -15px; padding: 0.50em 0.6em;">Last Syncronize at {!! $tax->syncronizing_at != null ? date('d-M-Y h:i:s A',
            strtotime($tax->syncronizing_at)) : null !!}</span>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <dl class="row mt-4">
            <dt class="col-sm-3 col-xl-3">Business Name</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->business_name !!}</dd>
            <dt class="col-sm-3 col-xl-3">Trade Name</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->trade_name !!}</dd>
            <dt class="col-sm-3 col-xl-3">Company Address</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->getCompanyAddress() !!}</dd>
            <dt class="col-sm-3 col-xl-3">Correspondence Address</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->getCorrespondenceAddress() !!}</dd>
            <dt class="col-sm-3 col-xl-3">SST No</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->sst_no !!}</dd>
            <dt class="col-sm-3 col-xl-3">GST No</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->gst_no !!}</dd>
            <dt class="col-sm-3 col-xl-3">Registration Status</dt>
            <dd class="col-sm-9 col-xl-8">: 
                @if($tax->registration_status == 'CANCEL')
                <span class="badge badge-danger">{!! $tax->registration_status !!}</span>
                @else
                <span class="badge badge-info">{!! $tax->registration_status !!}</span>
                @endif
            </dd>
            <dt class="col-sm-3 col-xl-3">Registration Date</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->registration_date != null ? date('d M Y', strtotime($tax->registration_date)) : null !!}</dd>
            <dt class="col-sm-3 col-xl-3">Cancellation Approval</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->cancellation_approval != null ? date('d M Y', strtotime($tax->cancellation_approval)) : null !!}</dd>
            <dt class="col-sm-3 col-xl-3">Cancellation Effective</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->cancellation_effective != null ? date('d M Y', strtotime($tax->cancellation_effective)) : null !!}</dd>
            <dt class="col-sm-3 col-xl-3">Station Code</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->station_code !!}</dd>
            <dt class="col-sm-3 col-xl-3">Station Name</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->station_name !!}</dd>
            <dt class="col-sm-3 col-xl-3">BRN No</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->brn_no !!}</dd>
            <dt class="col-sm-3 col-xl-3">SST Type</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->sst_type !!}</dd>
            <dt class="col-sm-3 col-xl-3">Email Address</dt>
            <dd class="col-sm-9 col-xl-8">: <a href="mailto:{!! $tax->email_address !!}" target="_blank" class="text-navy">{!! $tax->email_address !!}</a></dd>
            <dt class="col-sm-3 col-xl-3">Telephone No</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->telephone_no !!}</dd>
        </dl>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h5>Statement</h5>
        <hr class="mt-1 mb-1">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <dl class="row">
            <dt class="col-sm-3 col-xl-3">SMK No</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->smk_no !!}</dd>
            <dt class="col-sm-3 col-xl-3">Undeclaration Duration</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->undeclaration_duration !!}</dd>
            <dt class="col-sm-3 col-xl-3">Reminder Notice</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->reminder_date != null ? date('d M Y', strtotime($tax->reminder_date)) : null !!}</dd>
        </dl>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h5>CDN Status</h5>
        <hr class="mt-1 mb-1">
        <div class="text-right">
            <a href="javascript:void(0)" data-id="{!! $tax->id !!}" class="btn btn-sm btn-primary edit-cdn-status">
                Change
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <dl class="row">
            <dt class="col-sm-3 col-xl-3">Current Status</dt>
            <dd class="col-sm-9 col-xl-8">: 
                @if($tax->cdn_status == 'PERMOHONAN PEMBATALAN')
                <span class="badge badge-warning">{!! $tax->cdn_status !!}</span>
                @else
                <span class="badge badge-info">{!! $tax->cdn_status !!}</span>
                @endif
            </dd>
            <dt class="col-sm-3 col-xl-3">Status Description</dt>
            <dd class="col-sm-9 col-xl-8">: {!! $tax->cdn_status_desc !!}</dd>
        </dl>
    </div>
</div>

<div class="modal fade" id="modal-cdn-status" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="margin: 10px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="title-cdn-status" class="modal-title">Change Status</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{!! \URL::to('tax/' . $tax->id . '?section=basic') !!}" id="form-cdn-status" class="form-horizontal" novalidate>
                    @csrf
                    <input id="method-cdn-status" type="hidden" name="_method" value="PUT" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">New Status</label>
                                <div class="col-md-8">
                                    <div data-dx="selectbox" data-name="cdn_status" data-source="cdnStatus" data-value-exp="id"
                                        data-value="{{ $tax->cdn_status }}"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Status Description</label>
                                <div class="col-md-8">
                                    <div data-dx="textarea" data-name="cdn_status_desc" data-height="150" data-value=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-ghost-danger" data-dismiss="modal">Cancel</button>
                <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="false" data-validation-group="cdn-status" data-form="form-cdn-status"></div>
            </div>
        </div>
    </div>
</div>