<form method="POST" action="{!! \URL::to('tax/' . $tax->id . '?section=additional') !!}" id="form-tax" class="form-horizontal" enctype="multipart/form-data" novalidate>
    @csrf
    @if (isset($tax)) <input type="hidden" name="_method" value="PUT" /> @endif
    <div class="row">
        <div class="col-md-12">
            <h5>Update Additional Information</h5>
            <hr class="mt-1 mb-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Factory Name</label>
                        <div class="col-md-8">
                            <div data-dx="textbox" data-name="factory_name" data-mode="text" data-value="{!! \Request::old('factory_name', isset($tax) ? $tax->factory_name : NULL) !!}">
                            </div>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="modal-footer">
                        <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="false" data-validation-group="form" data-form="form-tax"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>