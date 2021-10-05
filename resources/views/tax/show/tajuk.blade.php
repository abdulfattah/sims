<div class="row">
    <div class="col-md-12">
        <h5>Maklumat Gesaan</h5>
        <hr class="mt-1 mb-1">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <dl class="row mt-4">
            <dt class="col-sm-3 col-xl-3">Jenis (B.O.D / Penyata / Bayaran)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_type }}</dd>
            <dt class="col-sm-3 col-xl-3">Business Name</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->business_name }}</dd>
            <dt class="col-sm-3 col-xl-3">SST No</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->sst_no }}</dd>
            <dt class="col-sm-3 col-xl-3">Address</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->getCompanyAddress() }}</dd>
            <dt class="col-sm-3 col-xl-3">Taxable Period</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_taxable_period }}</dd>
            <dt class="col-sm-3 col-xl-3">Due Date)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_due_date != null ? date('d M Y', strtotime($tax->crs_due_date)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Submission Date (Kalendar)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_submission_date_1 != null ? date('d M Y', strtotime($tax->push_submission_date_1)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Submission Date (Kalendar)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_submission_date_2 != null ? date('d M Y', strtotime($tax->push_submission_date_2)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">PIC</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_pic }}</dd>
            <dt class="col-sm-3 col-xl-3">Submission Status</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_submission_status }}</dd>
            <dt class="col-sm-3 col-xl-3">Summit Date</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_summit_date != null ? date('d M Y', strtotime($tax->push_summit_date)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Tax Payable</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;RM{{ number_format($tax->crs_tax_payable, 2) }}</dd>
            <dt class="col-sm-3 col-xl-3">Receipt Amount</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;RM{{ number_format($tax->crs_receipt_amt, 2) }}</dd>
            <dt class="col-sm-3 col-xl-3">Receipt Date</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_receipt_date != null ? date('d M Y', strtotime($tax->crs_receipt_date)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Email (Tarikh)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_email_date != null ? date('d M Y', strtotime($tax->push_email_date)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Email (Masa)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_email_time }}</dd>
            <dt class="col-sm-3 col-xl-3">Telefon (Tarikh)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_phone_date != null ? date('d M Y', strtotime($tax->push_phone_date)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Telefon (Masa)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_phone_time }}</dd>
            <dt class="col-sm-3 col-xl-3">Whatsapp (Tarikh)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_whatsapp_date != null ? date('d M Y', strtotime($tax->push_whatsapp_date)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Whatsapp (Masa)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_whatsapp_time }}</dd>
            <dt class="col-sm-3 col-xl-3">Lawatan (Tarikh)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_visit_date != null ? date('d M Y', strtotime($tax->push_visit_date)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Lawatan (Masa)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_visit_time }}</dd>
            <dt class="col-sm-3 col-xl-3">B.O.D (Penalty Rate)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_bod_penalty_rate }}</dd>
            <dt class="col-sm-3 col-xl-3">B.O.D (Penalty Amount)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_bod_penalty_amount }}</dd>
            <dt class="col-sm-3 col-xl-3">B.O.D (Status)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_bod_status }}</dd>
            <dt class="col-sm-3 col-xl-3">B.O.D (ABT)</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->push_bod_abt }}</dd>
        </dl>
    </div>
</div>
<div class="text-right">
    <a href="{{ URL::to('tax/' . $tax->id . '/edit?section=tajuk') }}" class="btn btn-sm btn-primary" style="height: 33px">
        Update
    </a>
</div>
