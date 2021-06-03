@extends("main")

@section("content")
    <div class="card">
        <div class="card-body">
            <div class="float-right" style="display: flex;flex-direction: row;">
                <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed mr-1 grid-btn-refresh" data-for="risk_person">Reset List</button>
                <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed mr-1 grid-btn-excel" data-for="risk_person">Export</button>
            </div>
            <div class="table-responsive" style="background-color: #ffffff">
                <div id="grid" data-for="risk_person"></div>
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
