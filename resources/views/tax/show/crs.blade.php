<div class="row">
    <div class="col-md-12">
        <h5>Current return Status</h5>
        <hr class="mt-1 mb-1">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <dl class="row mt-4">
            <dt class="col-sm-3 col-xl-3">Taxable Period</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_taxable_period }}</dd>
            <dt class="col-sm-3 col-xl-3">Due Date</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_due_date != null ? date('d M Y', strtotime($tax->crs_due_date)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Submission Status</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_submission_status }}</dd>
            <dt class="col-sm-3 col-xl-3">SST-02 No</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_sst_02_no }}</dd>
            <dt class="col-sm-3 col-xl-3">Submit Date</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_submit_date != null ? date('d M Y', strtotime($tax->crs_submit_date)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Mode of Submission</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_mode_of_submission }}</dd>
            <dt class="col-sm-3 col-xl-3">Tax Payable</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_tax_payable }}</dd>
            <dt class="col-sm-3 col-xl-3">Receipt No</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_receipt_no }}</dd>
            <dt class="col-sm-3 col-xl-3">Receipt Date</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_receipt_date != null ? date('d M Y', strtotime($tax->crs_receipt_date)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Receipt Amt</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_receipt_amt }}</dd>
            <dt class="col-sm-3 col-xl-3">Mode of Payment</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_mode_of_payment }}</dd>
            <dt class="col-sm-3 col-xl-3">Penalty Rate</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_penalty_rate }}</dd>
            <dt class="col-sm-3 col-xl-3">Penalty Smt</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_penalty_amt }}</dd>
            <dt class="col-sm-3 col-xl-3">Bod Status</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_bod_status }}</dd>
            <dt class="col-sm-3 col-xl-3">Bod Rcpt No</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_bod_receipt_no }}</dd>
            <dt class="col-sm-3 col-xl-3">Bod Tax Paid</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_bod_tax_paid }}</dd>
            <dt class="col-sm-3 col-xl-3">Bod Total Tax</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_bod_total_tax }}</dd>
            <dt class="col-sm-3 col-xl-3">Bod Penalty Paid</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_bod_penalty_paid }}</dd>
            <dt class="col-sm-3 col-xl-3">Bod Total Penalty</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_bod_total_penalty }}</dd>
        </dl>
    </div>
</div>



