@extends("main")

@section("content")
    <div class="card">
        <div class="card-header">
            <div class="mt-1 float-left">
                <strong>Profile 03</strong>
            </div>
            <div class="float-right" style="display: flex;flex-direction: row;">
                <button class="btn btn-primary btn-sm grid-btn-refresh" type="button" data-for="profiling_03" style="margin-right: 4px;">
                    <svg class="c-icon">
                        <use xlink:href="{!! asset('icons/free.svg#cil-reload') !!}"></use>
                    </svg>
                </button>
                <div data-dx="tooltip" class="d-none">Reset List</div>
                <button class="btn btn-primary btn-sm grid-btn-excel" type="button" style="margin-right: 4px;" data-for="profiling_03">
                    <svg class="c-icon">
                        <use xlink:href="{!! asset('icons/free.svg#cil-cloud-download') !!}"></use>
                    </svg>
                </button>
                <div data-dx="tooltip" class="d-none">Download Excel</div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="background-color: #ffffff">
                <div id="grid" data-for="profiling_03"></div>
            </div>
            @csrf
            <strong>Petunjuk</strong>
            <dl class="row">
                <dt class="col-md-1">S1</dt>
                <dd class="col-md-11">: Jenis Perniagaan</dd>
                <dt class="col-md-1">S2</dt>
                <dd class="col-md-11">: Jenis Tempat Perniagaan Orang Berdaftar</dd>
                <dt class="col-md-1">S3</dt>
                <dd class="col-md-11">: Pengauditan atas akaun Orang Berdaftar</dd>
                <dt class="col-md-1">S4</dt>
                <dd class="col-md-11">: Sistem Pengurusan</dd>
                <dt class="col-md-1">S5</dt>
                <dd class="col-md-11">: Penyelenggaraan rekod dan dokumen</dd>
                <dt class="col-md-1">S6</dt>
                <dd class="col-md-11">: Kegagalan mengemukakan penyata atau membuat pembayaran cukai</dd>
                <dt class="col-md-1">S7</dt>
                <dd class="col-md-11">: Profil dan rekod syarikat</dd>
                <dt class="col-md-1">S8</dt>
                <dd class="col-md-11">: Jenis bangunan yang didiami oleh syarikat/perniagaan</dd>
                <dt class="col-md-1">S9</dt>
                <dd class="col-md-11">: Hak milik bangunan / premis</dd>
            </dl>
        </div>
    </div>
@stop
