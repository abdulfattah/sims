@extends('main')
@section('content')
<div class="nav-tabs-boxed">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><a class="nav-link @if(\Request::get('tab') == 1) active @endif" data-toggle="tab" href="#basic" role="tab" aria-controls="basic">Basic Information</a></li>
        <li class="nav-item"><a class="nav-link @if(\Request::get('tab') == 2) active @endif" data-toggle="tab" href="#additional" role="tab" aria-controls="additional">Additional
                Information</a></li>
        <li class="nav-item"><a class="nav-link @if(\Request::get('tab') == 3) active @endif" data-toggle="tab" href="#attachment" role="tab" aria-controls="attachment">Attachment</a></li>
        <li class="nav-item"><a class="nav-link @if(\Request::get('tab') == 4) active @endif" data-toggle="tab" href="#note" role="tab" aria-controls="note">Note</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane @if(\Request::get('tab') == 1) active @endif" id="basic" role="tabpanel">
            <span class="badge badge-success float-right" style="margin-top: -15px; padding: 0.50em 0.6em;">Last Syncronize at {!! $tax->syncronizing_at != null ? date('d-M-Y h:i:s A',
                strtotime($tax->syncronizing_at)) : null !!}</span>
            <dl class="row mt-4">
                <dt class="col-sm-3 col-xl-3 pl-5">Business Name</dt>
                <dd class="col-sm-9 col-xl-8">: {!! $tax->business_name !!}</dd>
                <dt class="col-sm-3 col-xl-3 pl-5">Trade Name</dt>
                <dd class="col-sm-9 col-xl-8">: {!! $tax->trade_name !!}</dd>
                <dt class="col-sm-3 col-xl-3 pl-5">Company Address</dt>
                <dd class="col-sm-9 col-xl-8">: {!! $tax->getCompanyAddress() !!}</dd>
                <dt class="col-sm-3 col-xl-3 pl-5">Correspondence Address</dt>
                <dd class="col-sm-9 col-xl-8">: {!! $tax->getCorrespondenceAddress() !!}</dd>
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
        </div>
        <div class="tab-pane @if(\Request::get('tab') == 2) active @endif" id="additional" role="tabpanel">
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
            <div class="modal fade" id="modal-additional-info" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" style="margin: 10px auto;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update Additional Information</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{!! isset($tax) ? \URL::to('tax', $tax->id) : \URL::to('tax') !!}" id="form-tax" class="form-horizontal" enctype="multipart/form-data"
                                novalidate>
                                @csrf
                                @if (isset($tax)) <input type="hidden" name="_method" value="PUT" /> @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Factory Name</label>
                                            <div class="col-md-8">
                                                <div data-dx="textbox" data-name="factory_name" data-mode="text"
                                                    data-value="{!! \Request::old('factory_name', isset($tax) ? $tax->factory_name : NULL) !!}"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Entity Type</label>
                                            <div class="col-md-8">
                                                <div data-dx="selectbox" data-name="entity_type" data-source="entityType" data-value-exp="id"
                                                    data-value="{!! \Request::old('entity_type', isset($tax) ? $tax->entity_type : NULL) !!}"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Business Activity</label>
                                            <div class="col-md-8">
                                                <div data-dx="selectbox" data-name="business_activity" data-source="businessActivity" data-value-exp="id"
                                                    data-value="{!! \Request::old('business_activity', isset($tax) ? $tax->business_activity : NULL) !!}"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Product Tax</label>
                                            <div class="col-md-8">
                                                <div data-dx="selectbox" data-name="product_tax" data-source="productTax" data-value-exp="id"
                                                    data-value="{!! \Request::old('product_tax', isset($tax) ? $tax->product_tax : NULL) !!}"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Facility Applied</label>
                                            <div class="col-md-8">
                                                <div data-dx="selectbox" data-name="facility_applied" data-source="facilityApplied" data-value-exp="id"
                                                    data-value="{!! \Request::old('facility_applied', isset($tax) ? $tax->facility_applied : NULL) !!}"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Local Marketing</label>
                                            <div class="col-md-8">
                                                <div data-dx="selectbox" data-name="local_marketing" data-source="localMarketing" data-value-exp="id"
                                                    data-value="{!! \Request::old('local_marketing', isset($tax) ? $tax->local_marketing : NULL) !!}"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Statement</label>
                                            <div class="col-md-8">
                                                <div data-dx="selectbox" data-name="statement" data-source="statement" data-value-exp="id"
                                                    data-value="{!! \Request::old('statement', isset($tax) ? $tax->statement : NULL) !!}"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Statement Status</label>
                                            <div class="col-md-8">
                                                <div data-dx="selectbox" data-name="statement_status" data-source="statementStatus" data-value-exp="id"
                                                    data-value="{!! \Request::old('statement_status', isset($tax) ? $tax->statement_status : NULL) !!}"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Uncomplience Type</label>
                                            <div class="col-md-8">
                                                <div data-dx="selectbox" data-name="uncomplience_type" data-source="uncomplienceType" data-value-exp="id"
                                                    data-value="{!! \Request::old('uncomplience_type', isset($tax) ? $tax->uncomplience_type : NULL) !!}"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="close" type="button" class="btn btn-ghost-danger" data-dismiss="modal">Cancel</button>
                            <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="false" data-validation-group="form" data-form="form-tax"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="button" id="update-addtional-info" class="btn btn-sm btn-primary" style="height: 33px">
                    Update
                </button>
            </div>
        </div>
        <div class="tab-pane @if(\Request::get('tab') == 3) active @endif" id="attachment" role="tabpanel">
            <div class="text-right">
                <button type="button" id="upload-attachment" class="btn btn-sm btn-primary" style="height: 33px">
                    Upload
                </button>
            </div>
            <table class="table table-responsive-sm table-sm mt-3">
                <thead>
                    <tr>
                        <th style="width: 250px;">Title</th>
                        <th>Description</th>
                        <th style="width: 200px;">Upload By</th>
                        <th style="width: 180px;">Datetime</th>
                        <th style="width: 70px;">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tax->attachments as $attachment)
                    <tr>
                        <td><a href="{!! URL::to('asset/file?in=attachment' . DIRECTORY_SEPARATOR . $attachment->for_id .'&filename=' .
                                                                  \App\Libs\App::getFilename('attachment', $attachment) . '&actualname=' .
                                                                  $attachment->asset_name) !!}" target="_blank">{!! $attachment->title !!}</a></td>
                        <td>{!! $attachment->description !!}</td>
                        <td>{!! $attachment->uploader != null ? $attachment->uploader->fullname : null !!}</td>
                        <td>{!! $attachment->created_at != null ? date('d-M-Y h:i:s A', strtotime($attachment->created_at)) : null !!}</td>
                        <th style="text-align: right">
                            <a href="javascript:void(0)" data-id="{!! $attachment->id !!}" class="edit-attachment"><i class="c-icon cil-pencil"></i></a>
                            <a href="javascript:void(0)" data-id="{!! $attachment->id !!}" class="delete-attachment"><i class="c-icon cil-trash text-danger"></i></a>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="modal fade" id="modal-attachment" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" style="margin: 10px auto;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 id="title-attachment" class="modal-title">Upload Attachment</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{!! \URL::to('attachment') !!}" id="form-attachment" class="form-horizontal" enctype="multipart/form-data" novalidate>
                                @csrf
                                <input type="hidden" name="tax_record_id" value="{!! $tax->id !!}" />
                                <input id="method-attachment" type="hidden" name="_method" value="" />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Title</label>
                                            <div class="col-md-8">
                                                <div data-dx="textbox" data-name="title" data-mode="text" data-value=""></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Description</label>
                                            <div class="col-md-8">
                                                <div data-dx="textarea" data-name="description" data-height="150" data-value=""></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">File</label>
                                            <div class="col-md-8">
                                                <div data-dx="fileuploader" data-name="filename" data-multiple="false" data-mode="useForm" data-validate="true"
                                                    data-validation-type="required" data-validation-group="attachment"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="close" type="button" class="btn btn-ghost-danger" data-dismiss="modal">Cancel</button>
                            <div data-dx="btn-submit" data-type="default" data-text="Upload" data-disabled="false" data-validation-group="attachment" data-form="form-attachment"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane @if(\Request::get('tab') == 4) active @endif" id="note" role="tabpanel">
            <div class="text-right">
                <button type="button" id="add-note" class="btn btn-sm btn-primary" style="height: 33px">
                    Create Note
                </button>
            </div>
            <table class="table table-responsive-sm table-sm mt-3">
                <thead>
                    <tr>
                        <th>Note</th>
                        <th style="width: 300px;">Note By</th>
                        <th style="width: 180px;">Date</th>
                        <th style="width: 70px">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tax->notes as $note)
                    <tr>
                        <td>{!! $note->note !!}</td>
                        <td>{!! $note->writer != null ? $note->writer->fullname : null !!}</td>
                        <td>{!! $note->created_at != null ? date('d-M-Y h:i:s A', strtotime($note->created_at)) : null !!}</td>
                        <th style="text-align: right">
                            <a href="javascript:void(0)" data-id="{!! $note->id !!}" class="edit-note"><i class="c-icon cil-pencil"></i></a>
                            <a href="javascript:void(0)" data-id="{!! $note->id !!}" class="delete-note"><i class="c-icon cil-trash text-danger"></i></a>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="modal fade" id="modal-note" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" style="margin: 10px auto;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 id="title-note" class="modal-title">Add Note</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{!! \URL::to('note') !!}" id="form-note" class="form-horizontal" novalidate>
                                @csrf
                                <input type="hidden" name="tax_record_id" value="{!! $tax->id !!}" />
                                <input id="method-note" type="hidden" name="_method" value="" />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div data-dx="textarea" data-name="note" data-height="200" data-validate="true" data-validation-type="required" data-validation-group="note"
                                                    data-value="{!! \Request::old('description', isset($tax) ? $tax->description : NULL) !!}"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="close" type="button" class="btn btn-ghost-danger" data-dismiss="modal">Cancel</button>
                            <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="false" data-validation-group="note" data-form="form-note"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop