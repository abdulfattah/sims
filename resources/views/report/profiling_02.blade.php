@extends("main")

@section("content")
    <div class="card">
        <div class="card-header">
            <div class="mt-1 float-left">
                <strong>Profile 02</strong>
            </div>
            <div class="float-right" style="display: flex;flex-direction: row;">
                <button class="btn btn-primary btn-sm grid-btn-refresh" type="button" data-for="profiling_02" style="margin-right: 4px;">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('icons/free.svg#cil-reload') }}"></use>
                    </svg>
                </button>
                <div data-dx="tooltip" class="d-none">Reset List</div>
                <button class="btn btn-primary btn-sm grid-btn-excel" type="button" style="margin-right: 4px;" data-for="profiling_02">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('icons/free.svg#cil-cloud-download') }}"></use>
                    </svg>
                </button>
                <div data-dx="tooltip" class="d-none">Download Excel</div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="background-color: #ffffff">
                <div id="grid" data-for="profiling_02"></div>
            </div>
            @csrf
            <strong>Petunjuk</strong>
            <dl class="row">
                <dt class="col-md-1">S1</dt>
                <dd class="col-md-11">: Jenis entiti</dd>
                <dt class="col-md-1">S2</dt>
                <dd class="col-md-11">: Jenis bangunan yang didiami oleh syarikat/perniagaan</dd>
                <dt class="col-md-1">S3</dt>
                <dd class="col-md-11">: Hak milik bangunan / premis</dd>
                <dt class="col-md-1">S4</dt>
                <dd class="col-md-11">: Jenis aktiviti</dd>
                <dt class="col-md-1">S5</dt>
                <dd class="col-md-11">: Jenis kemudahan yang diberi</dd>
                <dt class="col-md-1">S6</dt>
                <dd class="col-md-11">: Kegagalan mengemukakan penyata atau membuat pembayaran cukai.</dd>
                <dt class="col-md-1">S7</dt>
                <dd class="col-md-11">: Cara pemasaran keluaran barang siap</dd>
                <dt class="col-md-1">S8</dt>
                <dd class="col-md-11">: Kegagalan mengemukakan penyata stok pembelian bahan mentah, komponen, bahan pembungkusan (3 bulan sekali)</dd>
                <dt class="col-md-1">S9</dt>
                <dd class="col-md-11">: Cara pelupusan sisa, hampas, bahan mentah, komponen dan barang siap rosak</dd>
                <dt class="col-md-1">S10</dt>
                <dd class="col-md-11">: Kekerapan verifikasi ke atas entiti</dd>
                <dt class="col-md-1">S11</dt>
                <dd class="col-md-11">: Tahap pematuhan ke atas pemeriksaan semasa yang dilakukan oleh pegawai</dd>
                <dt class="col-md-1">S12</dt>
                <dd class="col-md-11">: Profil dan rekod dengan Jabatan</dd>
            </dl>
        </div>
    </div>
@stop
