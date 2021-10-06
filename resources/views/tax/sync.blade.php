@extends("main")

@section("content")
    <div class="row">
        <div class="col-12">
            <div id="panel-6" class="panel">
                <div class="panel-hdr">
                    <h2>Import Data From SST System</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="card-body">
                            <h2>Import base record from SST system</h2>
                            <form method="POST" action="{{ \URL::to('tax/sync') }}" id="form-sync-base" class="form-horizontal" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($syncBase)
                                            <div class="text-danger">
                                                <div id="progress-label-base">Please wait for other user to finish their sync.</div>
                                                <div class="progress mb-3 mt-2">
                                                    <div id="progress-bar-base" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @else
                                            @if($uploadBase)
                                                <div>
                                                    <p><code>Please select an excel file to synchronize</code></p>
                                                </div>
                                                <div data-dx="fileuploader" data-name="excelBase" data-multiple="false" data-mode="useForm"></div>
                                                <a href="{{ asset('images/base_column.png') }}" data-lightbox="1" class="font-weight-bold text-danger" style="font-size: 17px">Show column on the excel file</a>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-sm btn-primary">Import Base Record</button>
                                                </div>
                                            @else
                                                <div id="progress-label-base">Processing data (<strong>PLEASE WAIT & DO NOT REFRESH THIS PAGE</strong>)</div>
                                                <div class="progress mb-3 mt-2">
                                                    <div id="progress-bar-base" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            @endif
                                        @endif
                                        <hr>
                                    </div>
                                </div>
                            </form>
                            <h2>Import statements record</h2>
                            <form method="POST" action="{{ \URL::to('tax/sync') }}" id="form-sync-statement" class="form-horizontal" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($syncStatement)
                                            <div class="text-danger">
                                                <div id="progress-label-statement">Please wait for other user to finish their sync.</div>
                                                <div class="progress mb-3 mt-2">
                                                    <div id="progress-bar-statement" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @else
                                            @if($uploadStatement)
                                                <div>
                                                    <p><code>Please select an excel file to synchronize.</code></p>
                                                </div>
                                                <div data-dx="fileuploader" data-name="excelStatement" data-multiple="false" data-mode="useForm"></div>
                                                <a href="{{ asset('images/statement_column.png') }}" data-lightbox="2" class="font-weight-bold text-danger" style="font-size: 17px">Show column on the excel file</a>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-sm btn-primary">Import Statement</button>
                                                </div>
                                            @else
                                                <div id="progress-label-statement">Processing data (<strong>PLEASE WAIT & DO NOT REFRESH THIS PAGE</strong>)</div>
                                                <div class="progress mb-3 mt-2">
                                                    <div id="progress-bar-statement" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            @endif
                                        @endif
                                        <hr>
                                    </div>
                                </div>
                            </form>
                            <h2>Import Current Return Status <b>(CP)</b></h2>
                            <form method="POST" action="{{ \URL::to('tax/sync') }}" id="form-sync-crs-cp" class="form-horizontal" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($syncCrsCp)
                                            <div class="text-danger">
                                                <div id="progress-label-crs-cp">Please wait for other user to finish their sync.</div>
                                                <div class="progress mb-3 mt-2">
                                                    <div id="progress-bar-crs-cp" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @else
                                            @if($uploadCrsCp)
                                                <div>
                                                    <p><code>Please select an excel file to synchronize.</code></p>
                                                </div>
                                                <div data-dx="fileuploader" data-name="excelCrsCp" data-multiple="false" data-mode="useForm"></div>
                                                <a href="{{ asset('images/crs_CP.png') }}" data-lightbox="3" class="font-weight-bold text-danger" style="font-size: 17px">Show column on the excel file</a>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-sm btn-primary">Import Curent Return Status (CP)</button>
                                                </div>
                                            @else
                                                <div id="progress-label-crs-cp">Processing data (<strong>PLEASE WAIT & DO NOT REFRESH THIS PAGE</strong>)</div>
                                                <div class="progress mb-3 mt-2">
                                                    <div id="progress-bar-crs-cp" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            @endif
                                        @endif
                                        <hr>
                                    </div>
                                </div>
                            </form>
                            <h2>Import Current Return Status <b>(CJ)</b></h2>
                            <form method="POST" action="{{ \URL::to('tax/sync') }}" id="form-sync-crs-cj" class="form-horizontal" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($syncCrsCj)
                                            <div class="text-danger">
                                                <div id="progress-label-crs-cj">Please wait for other user to finish their sync.</div>
                                                <div class="progress mb-3 mt-2">
                                                    <div id="progress-bar-crs-cj" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @else
                                            @if($uploadCrsCj)
                                                <div>
                                                    <p><code>Please select an excel file to synchronize.</code></p>
                                                </div>
                                                <div data-dx="fileuploader" data-name="excelCrsCj" data-multiple="false" data-mode="useForm"></div>
                                                <a href="{{ asset('images/crs_CJ.png') }}" data-lightbox="3" class="font-weight-bold text-danger" style="font-size: 17px">Show column on the excel file</a>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-sm btn-primary">Import Curent Return Status (CJ)</button>
                                                </div>
                                            @else
                                                <div id="progress-label-crs-cj">Processing data (<strong>PLEASE WAIT & DO NOT REFRESH THIS PAGE</strong>)</div>
                                                <div class="progress mb-3 mt-2">
                                                    <div id="progress-bar-crs-cj" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            @endif
                                        @endif
                                        <hr>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
