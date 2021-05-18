<form action="@if($tax->profiling02 == null) {!! \URL::to('tax?section=profiling_02') !!} @else {!! \URL::to('tax/' . $tax->id . '?section=profiling_02&id=' . $tax->profiling02->id) !!} @endif"
      method="POST" id="form-profiling" class="form-horizontal" novalidate>
    @if($tax->profiling02 != null)
        <input type="hidden" name="_method" value="PUT"/>
    @endif
    @csrf
    <input type="hidden" name="tax_id" value="{!! $tax->id !!}"/>
    <table class="table table-responsive-sm table-sm mt-3" style="border-style: hidden">
        <tbody>
        <tr>
            <td colspan="3" style="font-style: italic;text-align: right">
                Borang Profailing Penentuan Tahap Risiko Entiti Cukai Jualan<br>
                Bahagian Cukai Dalam Negeri (SST), Johor
            </td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: 700;text-align: center;border-style: hidden">
                <img class="c-sidebar-brand-minimized" width="130" src="{!! asset('images/logo.svg') !!}">
            </td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: 700;text-align: center">
                PENENTUAN TAHAP RISIKO ENTITI CUKAI JUALAN
            </td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: 700;text-align: center">
                <table class="table table-responsive-sm table-sm mt-3" style="border-style: hidden">
                    <tbody>
                    <tr>
                        <td style="border: 1px solid #eee;width: 250px">NAMA SYARIKAT</td>
                        <td colspan="2" style="border: 1px solid #eee;text-align: left">: {{ $tax->business_name }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #eee">NO. PENDAFTARAN SST</td>
                        <td colspan="2" style="border: 1px solid #eee;text-align: left">: {{ $tax->sst_no }}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>1. Jenis entiti</strong>
                <input type="hidden" name="answer_01" value="{{ $tax->profiling02 != null ? $tax->profiling02->answer_01 : null }}">
            </td>
            <td class="text-center"><strong>Markah</strong></td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Pemilik Tunggal</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q1i" type="radio" value="10"
                           name="mark_01" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_01 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q1i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Perkongsian</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q1ii" type="radio" value="7"
                           name="mark_01" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_01 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q1ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>
                <select class="form-control" id="answer_01_iii" style="width: 200px;height:29px;padding: 0rem 0.25rem;text-transform: none">
                    <option>Syarikat Berhad</option>
                    <option>Sendirian Berhad</option>
                </select>
            </td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q1iii" type="radio" value="4"
                           name="mark_01" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_01 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q1iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Entiti-entiti lain perniagaan seperti perbadanan & kelas</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q1iv" type="radio" value="1"
                           name="mark_01" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_01 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q1iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>2. Jenis bangunan yang didiami oleh syarikat/perniagaan</strong>
                <input type="hidden" name="answer_02" value="{{ $tax->profiling02 != null ? $tax->profiling02->answer_02 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Rumah kediaman</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q2i" type="radio" value="10"
                           name="mark_02" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_02 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q2i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Rumah Kedai</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q2ii" type="radio" value="7"
                           name="mark_02" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_02 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q2ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>Premis / Bangunan Kilang (Sewaan)</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q2iii" type="radio" value="4"
                           name="mark_02" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_02 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q2iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Premis / Bangunan Kilang (Sendiri)</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q2iv" type="radio" value="1"
                           name="mark_02" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_02 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q2iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>3. Hak milik bangunan / premis</strong>
                <input type="hidden" name="answer_03" value="{{ $tax->profiling02 != null ? $tax->profiling02->answer_03 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Sewa (bulanan)</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q3i" type="radio" value="10"
                           name="mark_03" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_03 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q3i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Sewa (leasing tahunan)</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q3ii" type="radio" value="7"
                           name="mark_03" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_03 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q3ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Kepunyaan sendiri (pinjaman bank)</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q3iii" type="radio" value="4"
                           name="mark_03" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_03 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q3iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Kepunyaan sendiri (tiada pinjaman)</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q3iv" type="radio" value="1"
                           name="mark_03" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_03 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q3iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>4. Jenis aktiviti</strong>
                <input type="hidden" name="answer_04" value="{{ $tax->profiling02 != null ? $tax->profiling02->answer_04 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Aktiviti pembungkusan semula (Repacking)</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q4i" type="radio" value="10"
                           name="mark_04" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_04 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q4i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Aktiviti kerja sub-kontrak</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q4ii" type="radio" value="7"
                           name="mark_04" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_04 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q4ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>
                <select class="form-control" id="answer_04_iii" style="width: 570px;height:29px;padding: 0rem 0.25rem;text-transform: none">
                    <option>Aktiviti pengilangan barang sendiri serta menjalankan kerja sub-kontrak</option>
                    <option>Aktiviti jual beli (trading)</option>
                </select>
            </td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q4iii" type="radio" value="4"
                           name="mark_04" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_04 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q4iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Aktiviti pengilangan barang sendiri sahaja</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q4iv" type="radio" value="1"
                           name="mark_04" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_04 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q4iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>5. Jenis kemudahan yang diberi</strong>
                <input type="hidden" name="answer_05" value="{{ $tax->profiling02 != null ? $tax->profiling02->answer_05 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Jadual A, Jadual B dan Jadual C</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q5i" type="radio" value="10"
                           name="mark_05" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_05 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q5i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td style="padding: 2px .40rem;">
                Jadual B dan Jadual C sahaja
            </td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q5ii" type="radio" value="7"
                           name="mark_05" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_05 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q5ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>Jadual A dan Jadual C sahaja</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q5iii" type="radio" value="4"
                           name="mark_05" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_05 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q5iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Jadual B sahaja / Jadual C sahaja</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q5iv" type="radio" value="1"
                           name="mark_05" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_05 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q5iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>6. Kegagalan mengemukakan penyata atau membuat pembayaran cukai.</strong>
                <input type="hidden" name="answer_06" value="{{ $tax->profiling02 != null ? $tax->profiling02->answer_06 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td style="padding: 2px .40rem;">
                5 kali dan lebih
            </td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q6i" type="radio" value="10"
                           name="mark_06" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_06 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q6i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>4 kali</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q6ii" type="radio" value="7"
                           name="mark_06" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_06 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q6ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>3 kali</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q6iii" type="radio" value="4"
                           name="mark_06" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_06 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q6iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>2 kali dan kurang</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q6iv" type="radio" value="1"
                           name="mark_06" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_06 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q6iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>7. Cara pemasaran keluaran barang siap</strong>
                <input type="hidden" name="answer_07" value="{{ $tax->profiling02 != null ? $tax->profiling02->answer_07 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Jualan kepada syarikat pemasar (marketing arm) atau syarikat bersekutu</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q7i" type="radio" value="10"
                           name="mark_07" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_07 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q7i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Jualan 100% eksport</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q7ii" type="radio" value="7"
                           name="mark_07" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_07 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q7ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>Jualan kepada pasaran bebas tempatan</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q7iii" type="radio" value="4"
                           name="mark_07" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_07 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q7iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Aktiviti sub-kontrak</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q7iv" type="radio" value="1"
                           name="mark_07" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_07 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q7iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>8. Kegagalan mengemukakan penyata stok pembelian bahan mentah, komponen, bahan pembungkusan (3 bulan sekali)</strong>
                <input type="hidden" name="answer_08" value="{{ $tax->profiling02 != null ? $tax->profiling02->answer_08 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>5 kali dan lebih</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q8i" type="radio" value="10"
                           name="mark_08" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_08 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q8i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>4 kali</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q8ii" type="radio" value="7"
                           name="mark_08" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_08 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q8ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>3 kali</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q8iii" type="radio" value="4"
                           name="mark_08" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_08 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q8iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>2 kali dan ke bawah</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q8iv" type="radio" value="1"
                           name="mark_08" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_08 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q8iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>9. Cara pelupusan sisa, hampas, bahan mentah, komponen dan barang siap rosak</strong>
                <input type="hidden" name="answer_09" value="{{ $tax->profiling02 != null ? $tax->profiling02->answer_09 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Tidak patuh prosedur pelupusan</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q9i" type="radio" value="10"
                           name="mark_09" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_09 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q9i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Bercukai - Dilupuskan dengan cara penjualan</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q9ii" type="radio" value="7"
                           name="mark_09" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_09 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q9ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>Bercukai - Dilupuskan dengan cara pemusnahan (buang di tapak pelupusan, tanam, bakar, pecah, gilis, mampat (compress).</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q9iii" type="radio" value="4"
                           name="mark_09" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_09 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q9iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Tidak berkenaan</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q9iv" type="radio" value="1"
                           name="mark_09" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_09 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q9iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>10. Kekerapan verifikasi ke atas entiti</strong>
                <input type="hidden" name="answer_10" value="{{ $tax->profiling02 != null ? $tax->profiling02->answer_10 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Pertama kali diverifikasi</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q10i" type="radio" value="10"
                           name="mark_10" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_10 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q10i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Pernah diverifikasi dan kekurangan cukai RM100,000 dan ke atas dikesan</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q10ii" type="radio" value="7"
                           name="mark_10" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_10 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q10ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>Pernah diverifikasi dan kekurangan cukai kurang dari RM100,000 telah dikesan</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q10iii" type="radio" value="4"
                           name="mark_10" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_10 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q10iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Pernah diverifikasi dan tiada kekurangan cukai dikesan</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q10iv" type="radio" value="1"
                           name="mark_10" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_10 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q10iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>11. Tahap pematuhan ke atas pemeriksaan semasa yang dilakukan oleh pegawai</strong>
                <input type="hidden" name="answer_11" value="{{ $tax->profiling02 != null ? $tax->profiling02->answer_11 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Tidak layak menggunakan kemudahan/ pengecualian yang dipohon</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q11i" type="radio" value="10"
                           name="mark_11" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_11 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q11i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Pelanggaran syarat di bawah Seksyen 87 Akta Cukai Jualan (ACJ) 2018 dan tuntutan cukai jualan di bawah Seskyen 35(5) ACJ 2018</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q11ii" type="radio" value="7"
                           name="mark_11" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_11 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q11ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>Pelanggaran syarat di bawah Seksyen 87 ACJ 2018 dan tiada tuntutan cukai jualan</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q11iii" type="radio" value="4"
                           name="mark_11" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_11 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q11iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Tiada pelanggaran syarat yang dikesan</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q11iv" type="radio" value="1"
                           name="mark_11" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_11 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q11iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>12. Profil dan rekod dengan Jabatan</strong>
                <input type="hidden" name="answer_12" value="{{ $tax->profiling02 != null ? $tax->profiling02->answer_12 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Mempunyai tunggakan hasil</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q12i" type="radio" value="10"
                           name="mark_12" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_12 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q12i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Pernah dikompaun</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q12ii" type="radio" value="7"
                           name="mark_12" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_12 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q12ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>Pernah diberi amaran</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q12iii" type="radio" value="4"
                           name="mark_12" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_12 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q12iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Mempunyai rekod bersih</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q12iv" type="radio" value="1"
                           name="mark_12" @if($tax->profiling02 != null) {{ $tax->profiling02->mark_12 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q12iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="border-top-style: none;border-bottom-style: none">
                <strong>ANALISA TAHAP RISIKO</strong>
                <table class="table-sm mt-3" style="border-style: hidden">
                    <tbody>
                    <tr>
                        <td style="width: 550px;border-bottom-style: none"><strong>1. Jumlah markah yang diperolehi</strong></td>
                        <td style="width: 150px;border-bottom-style: none"><input class="form-control" type="text" name="total_mark"
                                                                                  value="{{ $tax->profiling02 != null ? $tax->profiling02->total_mark : null }}"
                                                                                  readonly></td>
                    </tr>
                    <tr>
                        <td style="width: 550px;border-top-style: none"><strong>2. % tahap risiko (Jumlah markah/120) x 100%</strong></td>
                        <td style="width: 150px;border-top-style: none"></strong><input class="form-control" type="text" name="risk_level"
                                                                                        value="{{ $tax->profiling02 != null ? $tax->profiling02->risk_level : null }}"
                                                                                        readonly></td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="border-top-style: none;border-bottom-style: none;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="border-top-style: none;">
                <table class="table-bordered table-sm mt-3">
                    <tbody>
                    <tr>
                        <td style="width: 200px">Risiko TINGGI</td>
                        <td style="width: 50px;text-align: center">=</td>
                        <td style="width: 300px">70 hingga 100 markah (70%-100%)</td>
                        <td style="width: 70px;text-align: center">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="TINGGI" name="risk_level_text"
                                       @if($tax->profiling02 != null) {{ $tax->profiling02->risk_level_text == 'TINGGI' ? 'checked' : null }} @endif onclick="javascript: return false;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Risiko SEDERHANA</td>
                        <td style="width: 50px;text-align: center">=</td>
                        <td style="width: 300px">50 hingga 69 markah (50%-69%)</td>
                        <td style="width: 70px;text-align: center">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="SEDERHANA" name="risk_level_text"
                                       @if($tax->profiling02 != null) {{ $tax->profiling02->risk_level_text == 'SEDERHANA' ? 'checked' : null }} @endif onclick="javascript: return false;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Risiko RENDAH</td>
                        <td style="width: 50px;text-align: center">=</td>
                        <td style="width: 300px">10 hingga 49 markah (10%-49%)</td>
                        <td style="width: 70px;text-align: center">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="RENDAH" name="risk_level_text"
                                       @if($tax->profiling02 != null) {{ $tax->profiling02->risk_level_text == 'RENDAH' ? 'checked' : null }} @endif onclick="javascript: return false;">
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="modal-footer">
        <a href="{{ route('tax.show', [$tax->id, 'section' => 'profiling']) }}" class="btn btn-ghost-danger">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

@section('page-script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('input:radio[name=mark_01]').change(function () {
                if ($(this).closest('td').prev()[0].firstElementChild != null) {
                    $('input:hidden[name=answer_01]').val($(this).closest('td').prev()[0].firstElementChild.value);
                } else {
                    $('input:hidden[name=answer_01]').val($(this).closest('td').prev().html());
                }
                calTotal();
            });
            $('input:radio[name=mark_02]').change(function () {
                $('input:hidden[name=answer_02]').val($(this).closest('td').prev().html());
                calTotal();
            });
            $('input:radio[name=mark_03]').change(function () {
                $('input:hidden[name=answer_03]').val($(this).closest('td').prev().html());
                calTotal();
            });
            $('input:radio[name=mark_04]').change(function () {
                if ($(this).closest('td').prev()[0].firstElementChild != null) {
                    $('input:hidden[name=answer_04]').val($(this).closest('td').prev()[0].firstElementChild.value);
                } else {
                    $('input:hidden[name=answer_04]').val($(this).closest('td').prev().html());
                }
                calTotal();
            });
            $('input:radio[name=mark_05]').change(function () {
                $('input:hidden[name=answer_05]').val($(this).closest('td').prev().html());
                calTotal();
            });
            $('input:radio[name=mark_06]').change(function () {
                $('input:hidden[name=answer_06]').val($(this).closest('td').prev().html());
                calTotal();
            });
            $('input:radio[name=mark_07]').change(function () {
                $('input:hidden[name=answer_07]').val($(this).closest('td').prev().html());
                calTotal();
            });
            $('input:radio[name=mark_08]').change(function () {
                $('input:hidden[name=answer_08]').val($(this).closest('td').prev().html());
                calTotal();
            });
            $('input:radio[name=mark_09]').change(function () {
                $('input:hidden[name=answer_09]').val($(this).closest('td').prev().html());
                calTotal();
            });
            $('input:radio[name=mark_10]').change(function () {
                $('input:hidden[name=answer_10]').val($(this).closest('td').prev().html());
                calTotal();
            });
            $('input:radio[name=mark_11]').change(function () {
                $('input:hidden[name=answer_11]').val($(this).closest('td').prev().html());
                calTotal();
            });
            $('input:radio[name=mark_12]').change(function () {
                $('input:hidden[name=answer_12]').val($(this).closest('td').prev().html());
                calTotal();
            });

            function calTotal() {
                var total_mark = 0;
                var risk_level = 0;
                $('input[type=radio]:checked').not('input[name="risk_level_text"]').each(function () {
                    total_mark = total_mark + parseInt($(this).val());
                });
                $('input[name="total_mark"]').val(total_mark);
                $('input[name="risk_level"]').val((total_mark / 120) * 100);
                $('input[name="risk_level_text"]').each(function () {
                    if (total_mark < 50 && $(this).val() == 'RENDAH') {
                        $(this).prop('checked', true)
                    }
                    if ((total_mark > 49 && total_mark < 69) && $(this).val() == 'SEDERHANA') {
                        $(this).prop('checked', true)
                    }
                    if (total_mark > 69 && $(this).val() == 'TINGGI') {
                        $(this).prop('checked', true)
                    }
                });
            }

            $('#answer_01_iii').change(function () {
                $('input:hidden[name=answer_01]').val($(this).val());
            });

            $('#answer_04_iii').change(function () {
                $('input:hidden[name=answer_04]').val($(this).val());
            });

            $('#form-profiling').submit(function () {
                if ($('input[type=radio]:checked').not('input[name="risk_level_text"]').length < 12) {
                    alert('Please select all answer!');
                    return false;
                }
            })
        })
    </script>
@stop
