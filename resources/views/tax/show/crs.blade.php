<div class="row">
    <div class="col-md-12">
        <h5>Current return Status</h5>
        <hr class="mt-1 mb-1">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <span class="text-muted"><i>Put your cursor on the table and use Shift + Mouse Scroll to scroll horizontally</i></span>
        <table class="table table-bordered m-1" style="min-width: 900px">
            <thead class="thead-themed">
            <tr>
                <th class="text-center" style="width: 40px;"></th>
                <th class="text-center" style="width: 30px;">No</th>
                <th class="text-center" style="width: 140px;">Taxable Period</th>
                <th class="text-center" style="width: 90px;">Due Date</th>
                <th class="text-center" style="width: 100px;">Submission Status</th>
                <th class="text-center" style="width: 90px;">SST-02 No</th>
                <th class="text-center" style="width: 90px;">Submit Date</th>
                <th class="text-center" style="width: 180px;">Mode of Submission</th>
                <th class="text-center" style="width: 70px;">Tax Payable</th>
                <th class="text-center" style="width: 80px;">Receipt No</th>
                {{--                    <th class="text-center" style="width: 80px;">Receipt Date</th>--}}
                {{--                    <th class="text-center" style="width: 80px;">Receipt Amount</th>--}}
                {{--                    <th class="text-center" style="width: 100px;">Mode of Payment</th>--}}
                {{--                    <th class="text-center" style="width: 100px;">Penalty Rate</th>--}}
                {{--                    <th class="text-center" style="width: 100px;">Penalty Amount</th>--}}
                {{--                    <th class="text-center" style="width: 130px;">B.O.D Status</th>--}}
                {{--                    <th class="text-center" style="width: 130px;">B.O.D Rcpt No</th>--}}
                {{--                    <th class="text-center" style="width: 130px;">B.O.D Tax Paid</th>--}}
                {{--                    <th class="text-center" style="width: 130px;">B.O.D Total Tax</th>--}}
                {{--                    <th class="text-center" style="width: 130px;">B.O.D Penalty Paid</th>--}}
                {{--                    <th class="text-center" style="width: 130px;">B.O.D Total Penalty</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($tax->crs as $key => $returnStatus)
                <tr>
                    <td style="text-align: center">
                        <a href="javascript:void(0)" data-id="{{ $returnStatus->id }}" class="mr-1" onclick="showHideRow('row{{ $key }}');" title="Show gesaan">
                            Gesaan
                        </a>
                    </td>
                    <td style="text-align: center">{{ ++$key }}</td>
                    <td>
                        <a href="javascript:void(0)" data-id="{{ $returnStatus->id }}" class="mr-1 show-crs"
                           title="Show details Current Return Status">
                            {{ $returnStatus->crs_taxable_period }}
                        </a>
                    </td>
                    <td>{{ $returnStatus->crs_due_date != null ? date('d-m-Y', strtotime($returnStatus->crs_due_date)) : null }}</td>
                    <td>{{ $returnStatus->crs_submission_status }}</td>
                    <td>{{ $returnStatus->crs_sst_02_no }}</td>
                    <td>{{ $returnStatus->crs_submit_date != null ? date('d-m-Y', strtotime($returnStatus->crs_submit_date)) : null }}</td>
                    <td>{{ $returnStatus->crs_mode_of_submission }}</td>
                    <td>{{ $returnStatus->crs_tax_payable }}</td>
                    <td>{{ $returnStatus->crs_receipt_no }}</td>
                    {{--                        <td>{{ $returnStatus->crs_receipt_date != null ? date('d M Y', strtotime($returnStatus->crs_receipt_date)) : null }}</td>--}}
                    {{--                        <td>{{ $returnStatus->crs_receipt_amt }}</td>--}}
                    {{--                        <td>{{ $returnStatus->crs_mode_of_payment }}</td>--}}
                    {{--                        <td>{{ $returnStatus->crs_penalty_rate }}</td>--}}
                    {{--                        <td>{{ $returnStatus->crs_penalty_amt }}</td>--}}
                    {{--                        <td>{{ $returnStatus->crs_bod_status }}</td>--}}
                    {{--                        <td>{{ $returnStatus->crs_bod_receipt_no }}</td>--}}
                    {{--                        <td>{{ $returnStatus->crs_bod_tax_paid }}</td>--}}
                    {{--                        <td>{{ $returnStatus->crs_bod_total_tax }}</td>--}}
                    {{--                        <td>{{ $returnStatus->crs_bod_penalty_paid }}</td>--}}
                    {{--                        <td>{{ $returnStatus->crs_bod_total_penalty }}</td>--}}
                </tr>
                <tr id="row{{ ($key - 1) }}" @if(request()->get('crsid') != $returnStatus->id) class="hidden_row" @endif>
                    <td colspan="10" class="p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 style="padding-top: 10px">Maklumat Gesaan</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="text-right mb-2">
                                    <button type="button" class="btn btn-sm btn-primary add-gesaan" data-crs-id="{{ $returnStatus->id }}" style="height: 33px" disabled>
                                        Add New
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="mt-1 mb-1">
                                @if ($returnStatus->gesaans->count() > 0)
                                    <span class="text-muted"><i>Put your cursor on the table and use Shift + Mouse Scroll to scroll horizontally</i></span>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover m-0 table">
                                            <thead class="thead-themed">
                                            <tr>
                                                <th rowspan="2" style="width: 100px;">&nbsp;</th>
                                                <th rowspan="2" class="text-center" style="width: 100px;">#</th>
                                                <th rowspan="2" class="text-center" style="width: 120px;">Jenis</th>
                                                <th colspan="2" class="text-center" style="width: 200px;">Submission Status</th>
                                                <th rowspan="2" class="text-center" style="width: 250px;">Pegawai</th>
                                                <th rowspan="2" class="text-center" style="width: 150px;">Tarikh Ikrar Penyata</th>
                                                <th colspan="2" class="text-center" style="width: 230px;">Email</th>
                                                <th colspan="2" class="text-center" style="width: 230px;">Telefon</th>
                                                <th colspan="2" class="text-center" style="width: 230px;">Whatsapp</th>
                                                <th colspan="2" class="text-center" style="width: 230px;">Lawatan</th>
                                                <th colspan="6" class="text-center" style="width: 630px;">B.O.D</th>
                                                <th rowspan="2" style="width: 200px;">Catatan</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Tarikh</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Tarikh</th>
                                                <th class="text-center">Masa</th>
                                                <th class="text-center">Tarikh</th>
                                                <th class="text-center">Masa</th>
                                                <th class="text-center">Tarikh</th>
                                                <th class="text-center">Masa</th>
                                                <th class="text-center">Tarikh</th>
                                                <th class="text-center">Masa</th>
                                                <th class="text-center">Penalty Rate</th>
                                                <th class="text-center">Penalty Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">ABT</th>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Tax Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($returnStatus->gesaans as $key => $gesaan)
                                                <tr>
                                                    <td style="text-align: center">
                                                        <a href="javascript:void(0)" data-id="{{ $gesaan->id }}" class="edit-gesaan mr-2">
                                                            <i class="fal fa-pencil text-primary"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" data-id="{{ $gesaan->id }}" data-tax-id="{{ $gesaan->tax_record_id }}" class="delete-gesaan">
                                                            <i class="fal fa-trash text-danger"></i></a>
                                                    </td>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $gesaan->push_type }}</td>
                                                    <td>{{ $gesaan->push_gesaan_date != null ? date('d-m-Y', strtotime($gesaan->push_gesaan_date)) : null }}</td>
                                                    <td>{{ $gesaan->push_status_penyata }}</td>
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
                                                    <td>{{ $gesaan->push_bod_penalty_amount != null ? number_format($gesaan->push_bod_penalty_amount, 2) : null }}</td>
                                                    <td>{{ $gesaan->push_bod_status }}</td>
                                                    <td>{{ $gesaan->push_bod_abt != null ? date('d-m-Y', strtotime($gesaan->push_bod_abt)) : null }}</td>
                                                    <td>{{ $gesaan->push_bod_no }}</td>
                                                    <td>{{ $gesaan->push_bod_tax_amount != null ? number_format($gesaan->push_bod_tax_amount, 2) : null }}</td>
                                                    <td>{{ $gesaan->push_note }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="modal-crs" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" style="margin: 10px auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Details Current Return Status</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <dl class="row">
                            <dt class="col-sm-3 col-xl-3">Taxable Period</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_taxable_period"></dd>
                            <dt class="col-sm-3 col-xl-3">Due Date</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_due_date"></dd>
                            <dt class="col-sm-3 col-xl-3">Submission Status</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_submission_status"></dd>
                            <dt class="col-sm-3 col-xl-3">SST-02 No</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_sst_02_no"></dd>
                            <dt class="col-sm-3 col-xl-3">Submit Date</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_submit_date"></dd>
                            <dt class="col-sm-3 col-xl-3">Mode of Submission</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_mode_of_submission"></dd>
                            <dt class="col-sm-3 col-xl-3">Tax Payable</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_tax_payable"></dd>
                            <dt class="col-sm-3 col-xl-3">Receipt No</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_receipt_no"></dd>
                            <dt class="col-sm-3 col-xl-3">Receipt Date</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_receipt_date"></dd>
                            <dt class="col-sm-3 col-xl-3">Receipt Amt</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_receipt_amt"></dd>
                            <dt class="col-sm-3 col-xl-3">Mode of Payment</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_mode_of_payment"></dd>
                            <dt class="col-sm-3 col-xl-3">Penalty Rate</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_penalty_rate"></dd>
                            <dt class="col-sm-3 col-xl-3">Penalty Smt</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_penalty_amt"></dd>
                            <dt class="col-sm-3 col-xl-3">Bod Status</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_bod_status"></dd>
                            <dt class="col-sm-3 col-xl-3">Bod Rcpt No</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_bod_receipt_no"></dd>
                            <dt class="col-sm-3 col-xl-3">Bod Tax Paid</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_bod_tax_paid"></dd>
                            <dt class="col-sm-3 col-xl-3">Bod Total Tax</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_bod_total_tax"></dd>
                            <dt class="col-sm-3 col-xl-3">Bod Penalty Paid</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_bod_penalty_paid"></dd>
                            <dt class="col-sm-3 col-xl-3">Bod Total Penalty</dt>
                            <dd class="col-sm-9 col-xl-8" id="details_crs_bod_total_penalty"></dd>
                        </dl>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="javascript: void(0)" data-dismiss="modal" class="text-danger mr-3">Close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <input type="hidden" name="tax_crs_id" value=""/>
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="push_email_date">Email (Tarikh)</label>
                                    <div data-dx="datebox" data-name="push_email_date" data-display-format="dd MMM YYYY" data-value=""></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="push_email_time">Email (Masa)</label>
                                    <div data-dx="timebox" data-name="push_email_time" data-value=""></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="push_phone_date">Telefon (Tarikh)</label>
                                    <div data-dx="datebox" data-name="push_phone_date" data-display-format="dd MMM YYYY" data-value=""></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="push_phone_time">Telefon (Masa)</label>
                                    <div data-dx="timebox" data-name="push_phone_time" data-value=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="push_whatsapp_date">Whatsapp (Tarikh)</label>
                                    <div data-dx="datebox" data-name="push_whatsapp_date" data-display-format="dd MMM YYYY" data-value=""></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="push_whatsapp_time">Whatsapp (Masa)</label>
                                    <div data-dx="timebox" data-name="push_whatsapp_time" data-value=""></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="push_visit_date">Lawatan (Tarikh)</label>
                                    <div data-dx="datebox" data-name="push_visit_date" data-display-format="dd MMM YYYY" data-value=""></div>
                                </div>
                            </div>
                            <div class="col-md-3">
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
                                    <div data-dx="numberbox" data-name="push_bod_penalty_amount" data-mode="text" data-value=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="push_bod_status">B.O.D (Status)</label>
                                    <div data-dx="selectbox" data-name="push_bod_status" data-source="bodStatus" data-value-exp="id" data-value=""
                                         data-accept-custom-value="true"></div>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="push_bod_no">No B.O.D</label>
                                    <div data-dx="textbox" data-name="push_bod_no" data-mode="text" data-value=""></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="push_bod_tax_amount">B.O.D (Tax Amount)</label>
                                    <div data-dx="numberbox" data-name="push_bod_tax_amount" data-mode="text" data-value=""></div>
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



