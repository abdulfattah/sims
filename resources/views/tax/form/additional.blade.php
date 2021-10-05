<form method="POST" action="{{ \URL::to('tax/' . $tax->id . '?section=additional') }}" id="form-tax" class="form-horizontal" enctype="multipart/form-data" novalidate>
    @csrf
    @if (isset($tax)) <input type="hidden" name="_method" value="PUT"/> @endif
    <div class="row">
        <div class="col-md-12">
            <h5>Update Additional Information</h5>
            <hr class="mt-1 mb-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label" for="factory_name">Factory Name</label>
                        <div data-dx="textbox" data-name="factory_name" data-mode="text"
                             data-value="{{ \Request::old('factory_name', isset($tax) ? $tax->factory_name : NULL) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="entity_type">Entity Type</label>
                        <div data-dx="selectbox" data-name="entity_type" data-source="entityType" data-value-exp="id"
                             data-value="{{ \Request::old('entity_type', isset($tax) ? $tax->entity_type : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="business_activity">Business Activity</label>
                        <div data-dx="selectbox" data-name="business_activity" data-source="businessActivity" data-value-exp="id"
                             data-value="{{ \Request::old('business_activity', isset($tax) ? $tax->business_activity : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="product_tax">Product Tax</label>
                        <div data-dx="selectbox" data-name="product_tax" data-source="productTax" data-value-exp="id"
                             data-value="{{ \Request::old('product_tax', isset($tax) ? $tax->product_tax : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="facility_applied">Facility Applied</label>
                        <div data-dx="selectbox" data-name="facility_applied" data-source="facilityApplied" data-value-exp="id"
                             data-value="{{ \Request::old('facility_applied', isset($tax) ? $tax->facility_applied : NULL) }}"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="local_marketing">Local Marketing</label>
                        <div data-dx="selectbox" data-name="local_marketing" data-source="localMarketing" data-value-exp="id"
                             data-value="{{ \Request::old('local_marketing', isset($tax) ? $tax->local_marketing : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="statement">Statement</label>
                        <div data-dx="selectbox" data-name="statement" data-source="statement" data-value-exp="id"
                             data-value="{{ \Request::old('statement', isset($tax) ? $tax->statement : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="statement_status">Statement Status</label>
                        <div data-dx="selectbox" data-name="statement_status" data-source="statementStatus" data-value-exp="id"
                             data-value="{{ \Request::old('statement_status', isset($tax) ? $tax->statement_status : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="uncomplience_type">Uncomplience Type</label>
                        <div data-dx="selectbox" data-name="uncomplience_type" data-source="uncomplienceType" data-value-exp="id"
                             data-value="{{ \Request::old('uncomplience_type', isset($tax) ? $tax->uncomplience_type : NULL) }}"></div>
                    </div>
                </div>
            </div>
            <h5>Current Address & Contact Person</h5>
            <hr class="mt-1 mb-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label" for="cdn_address_1">Address (Line 1)</label>
                        <div data-dx="textbox" data-name="cdn_address_1" data-mode="text"
                             data-value="{{ \Request::old('cdn_address_1', isset($tax) ? $tax->cdn_address_1 : NULL) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label" for="cdn_address_2">Address (Line 2)</label>
                        <div data-dx="textbox" data-name="cdn_address_2" data-mode="text"
                             data-value="{{ \Request::old('cdn_address_2', isset($tax) ? $tax->cdn_address_2 : NULL) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="cdn_postcode">Postcode</label>
                        <div data-dx="textbox" data-name="cdn_postcode" data-mode="text"
                             data-value="{{ \Request::old('cdn_postcode', isset($tax) ? $tax->cdn_postcode : NULL) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="cdn_city">Town</label>
                        <div data-dx="textbox" data-name="cdn_city" data-mode="text" data-value="{{ \Request::old('cdn_city', isset($tax) ? $tax->cdn_city : NULL) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="cdn_state">State</label>
                        <div data-dx="selectbox" data-name="cdn_state" data-source="states" data-value-exp="id"
                             data-value="{{ \Request::old('cdn_state', isset($tax) ? $tax->cdn_state : NULL) }}"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="cdn_officer">Officer In Charge</label>
                        <div data-dx="textbox" data-name="cdn_officer" data-mode="text" data-value="{{ \Request::old('cdn_officer', isset($tax) ? $tax->cdn_officer : NULL) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="cdn_phone_no">Phone No</label>
                        <div data-dx="textbox" data-name="cdn_phone_no" data-mode="text"
                             data-value="{{ \Request::old('cdn_phone_no', isset($tax) ? $tax->cdn_phone_no : NULL) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="cdn_email">Email Address</label>
                        <div data-dx="textbox" data-case="lowercase" data-name="cdn_email" data-mode="text"
                             data-value="{{ \Request::old('cdn_email', isset($tax) ? $tax->cdn_email : NULL) }}" data-validate="true" data-validation-type="email"
                             data-validation-group="form">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="modal-footer">
                        <a href="{{ URL::to('tax/' . $tax->id . '?section=additional') }}" class="text-danger mr-3">Cancel</a>
                        <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="false" data-validation-group="form" data-form="form-tax"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
