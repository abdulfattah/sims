<div class="row">
    <div class="col-md-12">
        <h5>Maklumat Gesaan</h5>
        <hr class="mt-1 mb-1">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <dl class="row mt-4">
            <dt class="col-sm-3 col-xl-3">Business Name</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->business_name }}</dd>
            <dt class="col-sm-3 col-xl-3">SST No</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->sst_no }}</dd>
            <dt class="col-sm-3 col-xl-3">Address</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->getCompanyAddress() }}</dd>
            <dt class="col-sm-3 col-xl-3">Taxable Period</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_taxable_period }}</dd>
            <dt class="col-sm-3 col-xl-3">Due Date</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_due_date != null ? date('d M Y', strtotime($tax->crs_due_date)) : null }}</dd>
            <dt class="col-sm-3 col-xl-3">Submission Status</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_submission_status }}</dd>
            <dt class="col-sm-3 col-xl-3">Tax Payable</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;RM{{ number_format($tax->crs_tax_payable, 2) }}</dd>
            <dt class="col-sm-3 col-xl-3">Receipt Amount</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;RM{{ number_format($tax->crs_receipt_amt, 2) }}</dd>
            <dt class="col-sm-3 col-xl-3">Receipt Date</dt>
            <dd class="col-sm-9 col-xl-8">&nbsp;{{ $tax->crs_receipt_date != null ? date('d M Y', strtotime($tax->crs_receipt_date)) : null }}</dd>
        </dl>
        <div class="text-right mb-2">
            <button type="button" id="add-gesaan" class="btn btn-sm btn-primary" style="height: 33px" disabled>
                Add New
            </button>
        </div>
        <div style="overflow-x: auto;">
            <span class="text-muted"><i>Put your cursor on the table and use Shift + Mouse Scroll to scroll horizontally</i></span>
            <table class="table table-bordered table-hover m-0" style="min-width: 1600px">
                <thead class="thead-themed">
                <tr>
                    <th rowspan="2" class="text-center" style="width: 100px;">#</th>
                    <th rowspan="2" class="text-center" style="width: 120px;">Jenis</th>
                    <th colspan="2" class="text-center">Submission Status</th>
                    <th rowspan="2" class="text-center" style="width: 250px;">Pegawai</th>
                    <th rowspan="2" class="text-center" style="width: 150px;">Tarikh Ikrar Penyata</th>
                    <th colspan="2" class="text-center">Email</th>
                    <th colspan="2" class="text-center">Telefon</th>
                    <th colspan="2" class="text-center">Whatsapp</th>
                    <th colspan="2" class="text-center">Lawatan</th>
                    <th colspan="4" class="text-center">B.O.D</th>
                    <th rowspan="2" style="width: 200px;">Catatan</th>
                    <th rowspan="2" style="width: 100px;">&nbsp;</th>
                </tr>
                <tr>
                    <th class="text-center" style="width: 100px;">Tarikh</th>
                    <th class="text-center" style="width: 100px;">Status</th>
                    <th class="text-center" style="width: 130px;">Tarikh</th>
                    <th class="text-center" style="width: 100px;">Masa</th>
                    <th class="text-center" style="width: 130px;">Tarikh</th>
                    <th class="text-center" style="width: 100px;">Masa</th>
                    <th class="text-center" style="width: 130px;">Tarikh</th>
                    <th class="text-center" style="width: 100px;">Masa</th>
                    <th class="text-center" style="width: 130px;">Tarikh</th>
                    <th class="text-center" style="width: 100px;">Masa</th>
                    <th class="text-center" style="width: 100px;">Penalty Rate</th>
                    <th class="text-center" style="width: 100px;">Penalty Amount</th>
                    <th class="text-center" style="width: 100px;">Status</th>
                    <th class="text-center" style="width: 130px;">ABT</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tax->gesaans as $key => $gesaan)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $gesaan->push_type }}</td>
                        <td>{{ $gesaan->push_gesaan_date != null ? date('d-m-Y', strtotime($gesaan->push_gesaan_date)) : null }}</td>
                        <td>{{ $gesaan->push_status_penyata != null ? date('d-m-Y', strtotime($gesaan->push_status_penyata)) : null }}</td>
                        <td>{{ $gesaan->push_pic }}</td>
                        <td>{{ $gesaan->push_ikrar_penyata_date != null ? date('d-m-Y', strtotime($gesaan->push_ikrar_penyata_date)) : null }}</td>
                        <td>{{ $gesaan->push_email_date != null ? date('d-m-Y', strtotime($gesaan->push_email_date)) : null }}</td>
                        <td>{{ $gesaan->push_email_time != null ? date('H:i', strtotime($gesaan->push_email_time)) : null }}</td>
                        <td>{{ $gesaan->push_phone_date != null ? date('d-m-Y', strtotime($gesaan->push_phone_date)) : null }}</td>
                        <td>{{ $gesaan->push_phone_time != null ? date('H:i', strtotime($gesaan->push_phone_time)) : null }}</td>
                        <td>{{ $gesaan->push_whatsapp_date != null ? date('d-m-Y', strtotime($gesaan->push_whatsapp_date)) : null }}</td>
                        <td>{{ $gesaan->push_whatsapp_time != null ? date('H:i', strtotime($gesaan->push_whatsapp_time)) : null }}</td>
                        <td>{{ $gesaan->push_visit_date != null ? date('d-m-Y', strtotime($gesaan->push_visit_date)) : null }}</td>
                        <td>{{ $gesaan->push_visit_time != null ? date('H:i', strtotime($gesaan->push_visit_time)) : null }}</td>
                        <td>{{ $gesaan->push_bod_penalty_rate }}</td>
                        <td>{{ $gesaan->push_bod_penalty_amount }}</td>
                        <td>{{ $gesaan->push_bod_status }}</td>
                        <td>{{ $gesaan->push_bod_abt != null ? date('d-m-Y', strtotime($gesaan->push_bod_abt)) : null }}</td>
                        <td>{{ $gesaan->push_note }}</td>
                        <td style="text-align: right">
                            <a href="javascript:void(0)" data-id="{{ $gesaan->id }}" class="edit-gesaan mr-2">
                                <i class="fal fa-pencil text-primary"></i>
                            </a>
                            <a href="javascript:void(0)" data-id="{{ $gesaan->id }}" data-tax-id="{{ $gesaan->tax_record_id }}" class="delete-gesaan">
                                <i class="fal fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="modal-gesaan" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" style="margin: 10px auto;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="title-gesaan" class="modal-title">Add Gesaan</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ \URL::to('tax?section=gesaan') }}" id="form-gesaan" class="form-horizontal" enctype="multipart/form-data" novalidate>
                            @csrf
                            <input type="hidden" name="tax_record_id" value="{{ $tax->id }}"/>
                            <input id="method-gesaan" type="hidden" name="_method" value=""/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_type">Jenis</label>
                                        <div data-dx="selectbox" data-name="push_type" data-source="pushType" data-value-exp="id" data-value=""></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_ikrar_penyata_date">Tarikh Ikrar Penyata</label>
                                        <div data-dx="datebox" data-name="push_ikrar_penyata_date" data-display-format="dd MMM YYYY" data-value=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="push_pic">Pegawai</label>
                                        <div data-dx="textbox" data-name="push_pic" data-mode="text" data-value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_gesaan_date">Tarikh Gesaan</label>
                                        <div data-dx="datebox" data-name="push_gesaan_date" data-display-format="dd MMM YYYY" data-value=""></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_status_penyata">Status Penyata</label>
                                        <div data-dx="selectbox" data-name="push_status_penyata" data-source="statusPenyata" data-value-exp="id" data-value=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_email_date">Email (Tarikh)</label>
                                        <div data-dx="datebox" data-name="push_email_date" data-display-format="dd MMM YYYY" data-value=""></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_email_time">Email (Masa)</label>
                                        <div data-dx="timebox" data-name="push_email_time" data-value=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_phone_date">Telefon (Tarikh)</label>
                                        <div data-dx="datebox" data-name="push_phone_date" data-display-format="dd MMM YYYY" data-value=""></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_phone_time">Telefon (Masa)</label>
                                        <div data-dx="timebox" data-name="push_phone_time" data-value=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_whatsapp_date">Whatsapp (Tarikh)</label>
                                        <div data-dx="datebox" data-name="push_whatsapp_date" data-display-format="dd MMM YYYY" data-value=""></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_whatsapp_time">Whatsapp (Masa)</label>
                                        <div data-dx="timebox" data-name="push_whatsapp_time" data-value=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_visit_date">Lawatan (Tarikh)</label>
                                        <div data-dx="datebox" data-name="push_visit_date" data-display-format="dd MMM YYYY" data-value=""></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_visit_time">Lawatan (Masa)</label>
                                        <div data-dx="timebox" data-name="push_visit_time" data-value=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_bod_penalty_rate">B.O.D (Penalty Rate)</label>
                                        <div data-dx="selectbox" data-name="push_bod_penalty_rate" data-source="bodPenaltyRate" data-value-exp="id" data-value=""></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_bod_penalty_amount">B.O.D (Penalty Amount)</label>
                                        <div data-dx="textbox" data-name="push_bod_penalty_amount" data-mode="text" data-value=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_bod_status">B.O.D (Status)</label>
                                        <div data-dx="selectbox" data-name="push_bod_status" data-source="bodStatus" data-value-exp="id" data-value="" data-accept-custom-value="true"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="push_bod_abt">B.O.D (ABT)</label>
                                        <div data-dx="datebox" data-name="push_bod_abt" data-display-format="dd MMM YYYY" data-value=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="push_pic">Catatan</label>
                                        <div data-dx="textarea" data-name="push_note" data-mode="text" data-value="" data-height="50">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="javascript: void(0)" data-dismiss="modal" class="text-danger mr-3">Cancel</a>
                                <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="false" data-validation-group="gesaan" data-form="form-gesaan"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
