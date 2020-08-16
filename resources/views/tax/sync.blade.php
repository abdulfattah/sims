@extends("main")

@section("content")
<div class="card">
    <div class="card-header">
        <div class="mt-1 float-left">
            <strong>Syncronize Tax Record From Excel File</strong>
        </div>
    </div>
    <div class="card-body">
        <h5>Import base record from SST system</h5>
        <hr class="mt-1 mb-4">
        <form method="POST" action="{!! \URL::to('tax/sync') !!}" id="form-sync-base" class="form-horizontal" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
                <div class="col-md-12">
                    @if ($syncBase)
                    <div class="text-danger">
                        <div id="progress-label-base">Please wait for other user to finish their sync.</div>
                        <div class="progress mb-3 mt-2">
                            <div id="progress-bar-base" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    @else
                    @if($uploadBase)
                    <div>
                        <p><code>Please select an excel file to syncronize.</code></p>
                    </div>
                    <div data-dx="fileuploader" data-name="excelBase" data-multiple="false" data-mode="useForm"></div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-sm btn-primary">Import</button>
                    </div>
                    @else
                    <div id="progress-label-base">Processing data (<strong>PLEASE WAIT & DO NOT REFRESH THIS PAGE</strong>)</div>
                    <div class="progress mb-3 mt-2">
                        <div id="progress-bar-base" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </form>

        <h5>Import statements record</h5>
        <hr class="mt-1 mb-4">
        <form method="POST" action="{!! \URL::to('tax/sync') !!}" id="form-sync-base" class="form-horizontal" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
                <div class="col-md-12">
                    @if ($syncStatement)
                    <div class="text-danger">
                        <div id="progress-label-statement">Please wait for other user to finish their sync.</div>
                        <div class="progress mb-3 mt-2">
                            <div id="progress-bar-statement" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    @else
                    @if($uploadStatement)
                    <div>
                        <p><code>Please select an excel file to syncronize.</code></p>
                    </div>
                    <div data-dx="fileuploader" data-name="excelStatement" data-multiple="false" data-mode="useForm"></div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-sm btn-primary">Import</button>
                    </div>
                    @else
                    <div>
                        <p><code>Please select an excel file to syncronize.</code></p>
                    </div>
                    <div data-dx="fileuploader" data-name="excel" data-multiple="false" data-mode="useForm"></div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-sm btn-primary">Import</button>
                    </div>
                    <div id="progress-label-statement">Processing data (<strong>PLEASE WAIT & DO NOT REFRESH THIS PAGE</strong>)</div>
                    <div class="progress mb-3 mt-2">
                        <div id="progress-bar-statement" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@stop