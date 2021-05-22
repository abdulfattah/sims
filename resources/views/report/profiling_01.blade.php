@extends("main")

@section("content")
    <div class="card">
        <div class="card-header">
            <div class="mt-1 float-left">
                <strong>Profile 01</strong>
            </div>
            <div class="float-right" style="display: flex;flex-direction: row;">
                <button class="btn btn-primary btn-sm grid-btn-refresh" type="button" data-for="profiling_01" style="margin-right: 4px;">
                    <svg class="c-icon">
                        <use xlink:href="{!! asset('icons/free.svg#cil-reload') !!}"></use>
                    </svg>
                </button>
                <div data-dx="tooltip" class="d-none">Reset List</div>
                <button class="btn btn-primary btn-sm grid-btn-excel" type="button" style="margin-right: 4px;" data-for="profiling_01">
                    <svg class="c-icon">
                        <use xlink:href="{!! asset('icons/free.svg#cil-cloud-download') !!}"></use>
                    </svg>
                </button>
                <div data-dx="tooltip" class="d-none">Download Excel</div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="background-color: #ffffff">
                <div id="grid" data-for="profiling_01"></div>
            </div>
            @csrf
            <strong>Petunjuk</strong>
            <dl class="row">
                <dt class="col-md-1">S1</dt>
                <dd class="col-md-11">: Jenis aktiviti perniagaan</dd>
                <dt class="col-md-1">S2</dt>
                <dd class="col-md-11">: Adakah pengilang menjalankan kerja sub-kontrak?</dd>
                <dt class="col-md-1">S3</dt>
                <dd class="col-md-11">: Sekiranya ya, apakah jenis pembekalan barang yang diterima?</dd>
                <dt class="col-md-1">S4</dt>
                <dd class="col-md-11">: Adakah caj nilai jualan barang yang dikilangkan mengikut Seksyen 9(3) Akta Cukai Jualan 2018?</dd>
                <dt class="col-md-1">S5</dt>
                <dd class="col-md-11">: Hubungan pembeli dengan pengilang berdaftar</dd>
                <dt class="col-md-1">S6</dt>
                <dd class="col-md-11">: Status pembeli/pemasar kepada pengilang berdaftar</dd>
                <dt class="col-md-1">S7</dt>
                <dd class="col-md-11">: Cara pemasaran keluaran barang siap</dd>
                <dt class="col-md-1">S8</dt>
                <dd class="col-md-11">: Adakah terdapat perubahan harga jualan tempatan sebelum pelaksanaan SST dengan semasa pelaksanaan SST?</dd>
                <dt class="col-md-1">S9</dt>
                <dd class="col-md-11">: Adakah terdapat perbezaan harga jualan antara setiap pembeli?</dd>
                <dt class="col-md-1">S10</dt>
                <dd class="col-md-11">: Jenis kemudahan pengecualian yang digunakan oleh syarikat</dd>
                <dt class="col-md-1">S11</dt>
                <dd class="col-md-11">: Kegagalan mengemukakan penyata atau membuat pembayaran cukai</dd>
                <dt class="col-md-1">S12</dt>
                <dd class="col-md-11">: Profil dan rekod dengan jabatan</dd>
            </dl>
        </div>
    </div>
@stop
