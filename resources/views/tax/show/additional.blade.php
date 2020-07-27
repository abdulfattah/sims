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
                <form method="POST" action="{!! isset($tax) ? \URL::to('tax', $tax->id) : \URL::to('tax') !!}" id="form-tax" class="form-horizontal" enctype="multipart/form-data" novalidate>
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