@extends('main')
@section('content')

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header"><strong>Basic Information</strong></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Business Name</label>
                                <div data-dx="textbox" data-name="business_name" data-mode="text"
                                     data-value="{{ \Request::old('business_name', isset($tax) ? $tax->business_name : NULL) }}"
                                     data-readonly="true"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Trade Name</label>
                                <div data-dx="textbox" data-name="trade_name" data-mode="text"
                                     data-value="{{ \Request::old('trade_name', isset($tax) ? $tax->trade_name : NULL) }}"
                                     data-readonly="true"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>SST No</label>
                                <div data-dx="textbox" data-name="sst_no" data-mode="text" data-value="{{ \Request::old('sst_no', isset($tax) ? $tax->sst_no : NULL) }}"
                                     data-readonly="true">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>SST Type</label>
                                <div data-dx="textbox" data-name="sst_type" data-mode="text" data-value="{{ \Request::old('sst_type', isset($tax) ? $tax->sst_type : NULL) }}"
                                     data-readonly="true"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>GST No</label>
                                <div data-dx="textbox" data-name="gst_no" data-mode="text" data-value="{{ \Request::old('gst_no', isset($tax) ? $tax->gst_no : NULL) }}"
                                     data-readonly="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Station Code</label>
                                <div data-dx="textbox" data-name="station_code" data-mode="text"
                                     data-value="{{ \Request::old('station_code', isset($tax) ? $tax->station_code : NULL) }}"
                                     data-readonly="true"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Station Name</label>
                                <div data-dx="textbox" data-name="station_name" data-mode="text"
                                     data-value="{{ \Request::old('station_name', isset($tax) ? $tax->station_name : NULL) }}"
                                     data-readonly="true"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Registration Status</label>
                                <div data-dx="textbox" data-name="registration_status" data-mode="text"
                                     data-value="{{ \Request::old('registration_status', isset($tax) ? $tax->registration_status : NULL) }}" data-readonly="true"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Registration Date</label>
                                <div data-dx="datebox" data-name="registration_date" data-display-format="dd MMM y"
                                     data-value="{{ \Request::old('registration_date', isset($tax) ? $tax->registration_date : NULL) }}" data-readonly="true"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Cancellation Approval</label>
                                <div data-dx="datebox" data-name="cancellation_approval" data-display-format="dd MMM y"
                                     data-value="{{ \Request::old('cancellation_approval', isset($tax) ? $tax->cancellation_approval : NULL) }}" data-readonly="true"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Cancellation Effective</label>
                                <div data-dx="datebox" data-name="cancellation_effective" data-display-format="dd MMM y"
                                     data-value="{{ \Request::old('cancellation_effective', isset($tax) ? $tax->cancellation_effective : NULL) }}" data-readonly="true"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <div data-dx="textbox" data-name="email_address" data-mode="text"
                                     data-value="{{ \Request::old('email_address', isset($tax) ? $tax->email_address : NULL) }}"
                                     data-readonly="true"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Telephone No</label>
                                <div data-dx="textbox" data-name="telephone_no" data-mode="text"
                                     data-value="{{ \Request::old('telephone_no', isset($tax) ? $tax->telephone_no : NULL) }}"
                                     data-readonly="true"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header"><strong>Address Informationz</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Company Address (Line 1)</label>
                        <div data-dx="textbox" data-name="business_name" data-mode="text"
                             data-value="{{ \Request::old('company_address_1', isset($tax) ? $tax->company_address_1 : NULL) }}"
                             data-readonly="true"></div>
                    </div>
                    <div class="form-group">
                        <label>Company Address (Line 1)</label>
                        <div data-dx="textbox" data-name="company_address_2" data-mode="text"
                             data-value="{{ \Request::old('company_address_2', isset($tax) ? $tax->company_address_2 : NULL) }}" data-readonly="true"></div>
                    </div>
                    <div class="form-group">
                        <label>Company Address (Line 1)</label>
                        <div data-dx="textbox" data-name="company_address_3" data-mode="text"
                             data-value="{{ \Request::old('company_address_3', isset($tax) ? $tax->company_address_3 : NULL) }}" data-readonly="true"></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>Company Postcode</label>
                            <div data-dx="textbox" data-name="company_postcode" data-mode="text"
                                 data-value="{{ \Request::old('company_postcode', isset($tax) ? $tax->company_postcode : NULL) }}" data-readonly="true"></div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Company City</label>
                            <div data-dx="textbox" data-name="company_city" data-mode="text"
                                 data-value="{{ \Request::old('company_city', isset($tax) ? $tax->company_city : NULL) }}"
                                 data-readonly="true"></div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Company State</label>
                            <div data-dx="textbox" data-name="company_state" data-mode="text"
                                 data-value="{{ \Request::old('company_state', isset($tax) ? $tax->company_state : NULL) }}"
                                 data-readonly="true"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Correspondence Address (Line 1)</label>
                        <div data-dx="textbox" data-name="business_name" data-mode="text"
                             data-value="{{ \Request::old('correspondence_address_1', isset($tax) ? $tax->correspondence_address_1 : NULL) }}" data-readonly="true"></div>
                    </div>
                    <div class="form-group">
                        <label>Correspondence Address (Line 1)</label>
                        <div data-dx="textbox" data-name="correspondence_address_2" data-mode="text"
                             data-value="{{ \Request::old('correspondence_address_2', isset($tax) ? $tax->correspondence_address_2 : NULL) }}" data-readonly="true"></div>
                    </div>
                    <div class="form-group">
                        <label>Correspondence Address (Line 1)</label>
                        <div data-dx="textbox" data-name="correspondence_address_3" data-mode="text"
                             data-value="{{ \Request::old('correspondence_address_3', isset($tax) ? $tax->correspondence_address_3 : NULL) }}" data-readonly="true"></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>Correspondence Postcode</label>
                            <div data-dx="textbox" data-name="correspondence_postcode" data-mode="text"
                                 data-value="{{ \Request::old('correspondence_postcode', isset($tax) ? $tax->correspondence_postcode : NULL) }}" data-readonly="true"></div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Correspondence City</label>
                            <div data-dx="textbox" data-name="correspondence_city" data-mode="text"
                                 data-value="{{ \Request::old('correspondence_city', isset($tax) ? $tax->correspondence_city : NULL) }}" data-readonly="true"></div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Correspondence State</label>
                            <div data-dx="textbox" data-name="correspondence_state" data-mode="text"
                                 data-value="{{ \Request::old('correspondence_state', isset($tax) ? $tax->correspondence_state : NULL) }}" data-readonly="true"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><strong>Others Information</strong></div>
        <div class="card-body">
            <form method="POST" action="{{ isset($tax) ? \URL::to('tax', $tax->id) : \URL::to('tax') }}" id="form-tax" class="form-horizontal" enctype="multipart/form-data"
                  novalidate>
                @csrf
                @if (isset($tax)) <input type="hidden" name="_method" value="PUT"/> @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Factory Name</label>
                            <div class="col-md-6">
                                <div data-dx="textbox" data-name="factory_name" data-mode="text"
                                     data-value="{{ \Request::old('factory_name', isset($tax) ? $tax->factory_name : NULL) }}"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Entity Type</label>
                            <div class="col-md-6">
                                <div data-dx="selectbox" data-name="entity_type" data-source="entityType" data-value-exp="id"
                                     data-value="{{ \Request::old('entity_type', isset($tax) ? $tax->entity_type : NULL) }}"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Business Activity</label>
                            <div class="col-md-6">
                                <div data-dx="selectbox" data-name="business_activity" data-source="businessActivity" data-value-exp="id"
                                     data-value="{{ \Request::old('business_activity', isset($tax) ? $tax->business_activity : NULL) }}"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Tax</label>
                            <div class="col-md-6">
                                <div data-dx="selectbox" data-name="product_tax" data-source="productTax" data-value-exp="id"
                                     data-value="{{ \Request::old('product_tax', isset($tax) ? $tax->product_tax : NULL) }}"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Facility Applied</label>
                            <div class="col-md-6">
                                <div data-dx="selectbox" data-name="facility_applied" data-source="facilityApplied" data-value-exp="id"
                                     data-value="{{ \Request::old('facility_applied', isset($tax) ? $tax->facility_applied : NULL) }}"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Local Marketing</label>
                            <div class="col-md-6">
                                <div data-dx="selectbox" data-name="local_marketing" data-source="localMarketing" data-value-exp="id"
                                     data-value="{{ \Request::old('local_marketing', isset($tax) ? $tax->local_marketing : NULL) }}"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Statement</label>
                            <div class="col-md-6">
                                <div data-dx="selectbox" data-name="statement" data-source="statement" data-value-exp="id"
                                     data-value="{{ \Request::old('statement', isset($tax) ? $tax->statement : NULL) }}"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Statement Status</label>
                            <div class="col-md-6">
                                <div data-dx="selectbox" data-name="statement_status" data-source="statementStatus" data-value-exp="id"
                                     data-value="{{ \Request::old('statement_status', isset($tax) ? $tax->statement_status : NULL) }}"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Uncomplience Type</label>
                            <div class="col-md-6">
                                <div data-dx="selectbox" data-name="uncomplience_type" data-source="uncomplienceType" data-value-exp="id"
                                     data-value="{{ \Request::old('uncomplience_type', isset($tax) ? $tax->uncomplience_type : NULL) }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-right">
            <a href="{{ URL::to('tax') }}" class="btn btn-ghost-danger">Cancel</a>
            <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="false" data-validation-group="form" data-form="form-tax"></div>
        </div>
    </div>
@stop
