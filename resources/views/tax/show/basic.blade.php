<div class="row">
    <div class="col-md-12">
        <span class="badge badge-success float-right"
              style="padding: 0.50em 0.6em;">Last synchronize at &nbsp;{{ $tax->syncronizing_at != null ? date('d-M-Y h:i:s A', strtotime($tax->syncronizing_at)) : null }}</span>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <dl class="row mt-4">
            <dt class="col-sm-3 col-xl-3">Business Name</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->business_name }}</dd>
            <dt class="col-sm-3 col-xl-3">Trade Name</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->trade_name }}</dd>
            <dt class="col-sm-3 col-xl-3">Company Address</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->getCompanyAddress() }}</dd>
            <dt class="col-sm-3 col-xl-3">Correspondence Address</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->getCorrespondenceAddress() }}</dd>
            <dt class="col-sm-3 col-xl-3">SST No</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->sst_no }}</dd>
            <dt class="col-sm-3 col-xl-3">GST No</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->gst_no }}</dd>
            <dt class="col-sm-3 col-xl-3">Registration Status</dt>
            <dd class="col-sm-9 col-xl-8">
                @if($tax->registration_status == 'CANCEL')
                    <span class="badge badge-danger">&nbsp;{{ $tax->registration_status }}</span>
                @else
                    <span class="badge badge-info">&nbsp;{{ $tax->registration_status }}</span>
                @endif
            </dd>
            <dt class="col-sm-3 col-xl-3">Registration Date</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->registration_date != null ? date('d M Y', strtotime($tax->registration_date)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Cancellation Approval</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->cancellation_approval != null ? date('d M Y', strtotime($tax->cancellation_approval)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Cancellation Effective</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->cancellation_effective != null ? date('d M Y', strtotime($tax->cancellation_effective)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Station Code</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->station_code }}</dd>
            <dt class="col-sm-3 col-xl-3">Station Name</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->station_name }}</dd>
            <dt class="col-sm-3 col-xl-3">BRN No</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->brn_no }}</dd>
            <dt class="col-sm-3 col-xl-3">SST Type</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->sst_type }}</dd>
            <dt class="col-sm-3 col-xl-3">Email Address</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;<a href="mailto:&nbsp;{{ $tax->email_address }}" target="_blank" class="text-navy">{{ $tax->email_address }}</a></dd>
            <dt class="col-sm-3 col-xl-3">Telephone No</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->telephone_no }}</dd>
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
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->smk_no }}</dd>
            <dt class="col-sm-3 col-xl-3">Undeclaration Duration</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->undeclaration_duration }}</dd>
            <dt class="col-sm-3 col-xl-3">Reminder Notice</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->reminder_date != null ? date('d M Y', strtotime($tax->reminder_date)) : null }}</dd>
        </dl>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h5>CDN Status</h5>
        <hr class="mt-1 mb-1">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <dl class="row">
            <dt class="col-sm-3 col-xl-3">Current Status</dt>
            <dd class="col-sm-9 col-xl-8">
                @if($tax->cdn_status == 'PERMOHONAN PEMBATALAN')
                    <span class="badge badge-warning">&nbsp;{{ $tax->cdn_status }}</span>
                @else
                    <span class="badge badge-info">&nbsp;{{ $tax->cdn_status }}</span>
                @endif
            </dd>
            <dt class="col-sm-3 col-xl-3">Status Description</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->cdn_status_desc }}</dd>
        </dl>
        <div class="text-right">
            <a href="javascript:void(0)" data-id="{{ $tax->id }}" class="btn btn-sm btn-primary edit-cdn-status">
                Change Status
            </a>
        </div>
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
                <form method="POST" action="{{ \URL::to('tax/' . $tax->id . '?section=basic') }}" id="form-cdn-status" class="form-horizontal" novalidate>
                    @csrf
                    <input id="method-cdn-status" type="hidden" name="_method" value="PUT"/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">New Status</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="cdn_status">
                                        <option @if($tax->cdn_status == '' || $tax->cdn_status == null) @endif value=""></option>
                                        <option @if($tax->cdn_status == 'PERMOHONAN PEMBATALAN') selected @endif value="PERMOHONAN PEMBATALAN">PERMOHONAN PEMBATALAN</option>
                                    </select>
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
                <a href="javascript: void(0)" data-dismiss="modal" class="text-danger mr-3">Cancel</a>
                <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="false" data-validation-group="cdn-status" data-form="form-cdn-status"></div>
            </div>
        </div>
    </div>
</div>
