<form method="POST" action="{{ \URL::to('tax/' . $tax->id . '?section=tajuk') }}" id="form-tax" class="form-horizontal" enctype="multipart/form-data" novalidate>
    @csrf
    @if (isset($tax)) <input type="hidden" name="_method" value="PUT"/> @endif
    <div class="row">
        <div class="col-md-12">
            <h5>Maklumat Gesaan</h5>
            <hr class="mt-1 mb-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_type">Jenis</label>
                        <div data-dx="selectbox" data-name="push_type" data-source="pushType" data-value-exp="id"
                             data-value="{{ \Request::old('push_type', isset($tax) ? $tax->push_type : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label class="form-label" for="push_pic">PIC</label>
                        <div data-dx="textbox" data-name="push_pic" data-mode="text"
                             data-value="{{ \Request::old('push_pic', isset($tax) ? $tax->push_pic : NULL) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label" for="push_summit_date">Summit Date</label>
                    <div data-dx="datebox" data-name="push_summit_date" data-display-format="dd MMM YYYY"
                         data-value="{{ \Request::old('push_summit_date', isset($tax) ? $tax->push_summit_date : NULL) }}"></div>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_submission_date_1">Submission Date (Kalendar)</label>
                        <div data-dx="datebox" data-name="push_submission_date_1" data-display-format="dd MMM YYYY"
                             data-value="{{ \Request::old('push_submission_date_1', isset($tax) ? $tax->push_submission_date_1 : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_submission_date_2">Submission Date (Kalendar)</label>
                        <div data-dx="datebox" data-name="push_submission_date_2" data-display-format="dd MMM YYYY"
                             data-value="{{ \Request::old('push_submission_date_2', isset($tax) ? $tax->push_submission_date_2 : NULL) }}"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_email_date">Email (Tarikh)</label>
                        <div data-dx="datebox" data-name="push_email_date" data-display-format="dd MMM YYYY"
                             data-value="{{ \Request::old('push_email_date', isset($tax) ? $tax->push_email_date : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_email_time">Email (Masa)</label>
                        <div data-dx="timebox" data-name="push_email_time"
                             data-value="{{ \Request::old('push_email_time', isset($tax) ? $tax->push_email_time : NULL) }}"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_phone_date">Telefon (Tarikh)</label>
                        <div data-dx="datebox" data-name="push_phone_date" data-display-format="dd MMM YYYY"
                             data-value="{{ \Request::old('push_phone_date', isset($tax) ? $tax->push_phone_date : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_phone_time">Telefon (Masa)</label>
                        <div data-dx="timebox" data-name="push_phone_time"
                             data-value="{{ \Request::old('push_phone_time', isset($tax) ? $tax->push_phone_time : NULL) }}"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_whatsapp_date">Whatsapp (Tarikh)</label>
                        <div data-dx="datebox" data-name="push_whatsapp_date" data-display-format="dd MMM YYYY"
                             data-value="{{ \Request::old('push_whatsapp_date', isset($tax) ? $tax->push_whatsapp_date : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_whatsapp_time">Whatsapp (Masa)</label>
                        <div data-dx="timebox" data-name="push_whatsapp_time"
                             data-value="{{ \Request::old('push_whatsapp_time', isset($tax) ? $tax->push_whatsapp_time : NULL) }}"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_visit_date">Lawatan (Tarikh)</label>
                        <div data-dx="datebox" data-name="push_visit_date" data-display-format="dd MMM YYYY"
                             data-value="{{ \Request::old('push_visit_date', isset($tax) ? $tax->push_visit_date : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_visit_time">Lawatan (Masa)</label>
                        <div data-dx="timebox" data-name="push_visit_time"
                             data-value="{{ \Request::old('push_visit_time', isset($tax) ? $tax->push_visit_time : NULL) }}"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_bod_penalty_rate">B.O.D (Penalty Rate)</label>
                        <div data-dx="textbox" data-name="push_bod_penalty_rate" data-mode="text"
                             data-value="{{ \Request::old('push_bod_penalty_rate', isset($tax) ? $tax->push_bod_penalty_rate : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_bod_penalty_amount">B.O.D (Penalty Amount)</label>
                        <div data-dx="textbox" data-name="push_bod_penalty_amount" data-mode="text"
                             data-value="{{ \Request::old('push_bod_penalty_amount', isset($tax) ? $tax->push_bod_penalty_amount : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_bod_status">B.O.D (Status)</label>
                        <div data-dx="textbox" data-name="push_bod_status" data-mode="text"
                             data-value="{{ \Request::old('push_bod_status', isset($tax) ? $tax->push_bod_status : NULL) }}"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="push_bod_abt">B.O.D (ABT)</label>
                        <div data-dx="textbox" data-name="push_bod_abt" data-mode="text"
                             data-value="{{ \Request::old('push_bod_abt', isset($tax) ? $tax->push_bod_abt : NULL) }}"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="modal-footer">
                        <a href="{{ URL::to('tax/' . $tax->id . '?section=tajuk') }}" class="text-danger mr-3">Cancel</a>
                        <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="false" data-validation-group="form" data-form="form-tax"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
