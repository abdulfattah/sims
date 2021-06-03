@extends("main")

@section("content")
    <div class="card">
        <div class="card-body">
            <div class="float-right" style="display: flex;flex-direction: row;">
                <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed mr-1 grid-btn-refresh" data-for="risk_entity">Reset List</button>
                <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed mr-1 grid-btn-excel" data-for="risk_entity">Export</button>
            </div>
            <div class="table-responsive" style="background-color: #ffffff">
                <div id="grid" data-for="risk_entity"></div>
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
