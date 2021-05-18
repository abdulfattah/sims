<form action="@if($tax->profiling01 == null) {!! \URL::to('tax?section=profiling_01') !!} @else {!! \URL::to('tax/' . $tax->id . '?section=profiling_01&id=' . $tax->profiling01->id) !!} @endif"
      method="POST" id="form-profiling" class="form-horizontal" novalidate>
    @if($tax->profiling != null)
        <input type="hidden" name="_method" value="PUT"/>
    @endif
    @csrf
    <input type="hidden" name="tax_id" value="{!! $tax->id !!}"/>
    <table class="table table-responsive-sm table-sm mt-3" style="border-style: hidden">
        <tbody>
        <tr>
            <td colspan="3" style="font-style: italic;text-align: right">
                Borang Profailing Penentuan Tahap Risiko Pengilang Berdaftar<br>
                Unit Analisa, Profailing & Operasi<br>
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
                PENENTUAN TAHAP RISIKO PENGILANG BERDAFTAR
            </td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: 700;text-align: center">
                <table class="table table-responsive-sm table-sm mt-3" style="border-style: hidden">
                    <tbody>
                    <tr>
                        <td style="border: 1px solid #eee;width: 250px">NAMA SYARIKAT</td>
                        <td colspan="2" style="border: 1px solid #eee;text-align: left">{{ $tax->business_name }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #eee">NO DAFTAR CJ</td>
                        <td colspan="2" style="border: 1px solid #eee;text-align: left">{{ $tax->sst_no }}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>1. Jenis aktiviti perniagaan</strong>
                <input type="hidden" name="answer_01" value="{{ $tax->profiling01 != null ? $tax->profiling01->answer_01 : null }}">
            </td>
            <td class="text-center"><strong>Markah</strong></td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Mengilang barang bercukai, tidak bercukai dan trading</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q1i" type="radio" value="10"
                           name="mark_01" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_01 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q1i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Mengilang barang bercukai dan trading</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q1ii" type="radio" value="7"
                           name="mark_01" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_01 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q1ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>Mengilang barang bercukai dan tidak bercukai</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q1iii" type="radio" value="4"
                           name="mark_01" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_01 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q1iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Mengilang barang bercukai sahaja</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q1iv" type="radio" value="1"
                           name="mark_01" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_01 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q1iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>2. Adakah pengilang menjalankan kerja sub-kontrak?</strong>
                <input type="hidden" name="answer_02" value="{{ $tax->profiling01 != null ? $tax->profiling01->answer_02 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Ya</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q2i" type="radio" value="5"
                           name="mark_02" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_02 == 5 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q2i">5</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Tidak</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q2ii" type="radio" value="2"
                           name="mark_02" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_02 == 2 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q2ii">2</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>3. Sekiranya ya, apakah jenis pembekalan barang yang diterima?</strong>
                <input type="hidden" name="answer_03" value="{{ $tax->profiling01 != null ? $tax->profiling01->answer_03 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Barang diterima adalah pembekalan bercampur (Barang bercukai dan tidak bercukai)</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q3i" type="radio" value="5"
                           name="mark_03" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_03 == 5 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q3i">5</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Barang diterima adalah pembekalan bercukai sepenuhnya</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q3ii" type="radio" value="2"
                           name="mark_03" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_03 == 2 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q3ii">2</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>4. Adakah caj nilai jualan barang yang dikilangkan mengikut Seksyen 9(3) Akta Cukai Jualan 2018?</strong>
                <input type="hidden" name="answer_04" value="{{ $tax->profiling01 != null ? $tax->profiling01->answer_04 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Ya</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q4i" type="radio" value="10"
                           name="mark_04" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_04 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q4i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Tidak</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q4ii" type="radio" value="5"
                           name="mark_04" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_04 == 5 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q4ii">5</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>5. Hubungan pembeli dengan pengilang berdaftar</strong>
                <input type="hidden" name="answer_05" value="{{ $tax->profiling01 != null ? $tax->profiling01->answer_05 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Syarikat induk</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q5i" type="radio" value="10"
                           name="mark_05" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_05 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q5i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td style="padding: 2px .40rem;">
                <select class="form-control" id="answer_05_ii" style="width: 200px;height:29px;padding: 0rem 0.25rem;text-transform: none">
                    <option>Cawangan Syarikat</option>
                    <option>Syarikat Bersekutu</option>
                    <option>Syarikat Induk yang Sama</option>
                </select>
            </td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q5ii" type="radio" value="7"
                           name="mark_05" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_05 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q5ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>Anak Syarikat Induk</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q5iii" type="radio" value="4"
                           name="mark_05" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_05 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q5iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Tiada Apa-Apa Kaitan</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q5iv" type="radio" value="1"
                           name="mark_05" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_05 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q5iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>6. Status pembeli/pemasar kepada pengilang berdaftar</strong>
                <input type="hidden" name="answer_06" value="{{ $tax->profiling01 != null ? $tax->profiling01->answer_06 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td style="padding: 2px .40rem;">
                <select class="form-control" id="answer_06_i" style="width: 200px;height:29px;padding: 0rem 0.25rem;text-transform: none">
                    <option>Agen</option>
                    <option>Pengedar</option>
                </select>
            </td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q6i" type="radio" value="10"
                           name="mark_06" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_06 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q6i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Concessioner Tunggal</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q6ii" type="radio" value="7"
                           name="mark_06" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_06 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q6ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>Pemegang Francais</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q6iii" type="radio" value="4"
                           name="mark_06" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_06 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q6iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Pembeli Bebas</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q6iv" type="radio" value="1"
                           name="mark_06" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_06 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q6iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>7. Cara pemasaran keluaran barang siap</strong>
                <input type="hidden" name="answer_07" value="{{ $tax->profiling01 != null ? $tax->profiling01->answer_07 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Jualan tempatan sepenuhnya kepada syarikat berhubungan</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q7i" type="radio" value="10"
                           name="mark_07" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_07 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q7i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Jualan tempatan kepada syarikat berhubungan dan tidak berhubungan</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q7ii" type="radio" value="7"
                           name="mark_07" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_07 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q7ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>Jualan tempatan dan eksport</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q7iii" type="radio" value="4"
                           name="mark_07" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_07 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q7iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Jualann tempatan kepada pasaran bebas</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q7iv" type="radio" value="1"
                           name="mark_07" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_07 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q7iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>8. Adakah terdapat perubahan harga jualan tempatan sebelum pelaksanaan SST dengan semasa pelaksanaan SST?</strong>
                <input type="hidden" name="answer_08" value="{{ $tax->profiling01 != null ? $tax->profiling01->answer_08 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Ya</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q8i" type="radio" value="5"
                           name="mark_08" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_08 == 5 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q8i">5</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Tidak</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q8ii" type="radio" value="2"
                           name="mark_08" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_08 == 2 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q8ii">2</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>9. Adakah terdapat perbezaan harga jualan antara setiap pembeli?</strong>
                <input type="hidden" name="answer_09" value="{{ $tax->profiling01 != null ? $tax->profiling01->answer_09 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Ya</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q9i" type="radio" value="5"
                           name="mark_09" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_09 == 5 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q9i">5</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Tidak</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q9ii" type="radio" value="2"
                           name="mark_09" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_09 == 2 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q9ii">2</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>10. Jenis kemudahan pengecualian yang digunakan oleh syarikat</strong>
                <input type="hidden" name="answer_10" value="{{ $tax->profiling01 != null ? $tax->profiling01->answer_10 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Jadual A, Jadual B, dan Jadual C</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q10i" type="radio" value="10"
                           name="mark_10" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_10 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q10i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Jadual B dan Jadual C sahaja</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q10ii" type="radio" value="7"
                           name="mark_10" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_10 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q10ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>Jadual A dan C sahaja</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q10iii" type="radio" value="4"
                           name="mark_10" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_10 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q10iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Jadual C sahaja</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q10iv" type="radio" value="1"
                           name="mark_10" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_10 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q10iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>11. Kegagalan mengemukakan penyata atau membuat pembayaran cukai</strong>
                <input type="hidden" name="answer_11" value="{{ $tax->profiling01 != null ? $tax->profiling01->answer_11 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>5 kali dan lebih</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q11i" type="radio" value="10"
                           name="mark_11" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_11 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q11i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>4 kali</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q11ii" type="radio" value="7"
                           name="mark_11" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_11 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q11ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>3 kali</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q11iii" type="radio" value="4"
                           name="mark_11" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_11 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q11iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>2 kali dan ke bawah</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q11iv" type="radio" value="1"
                           name="mark_11" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_11 == 1 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q11iv">1</label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>12. Profil dan rekod dengan jabatan</strong>
                <input type="hidden" name="answer_12" value="{{ $tax->profiling01 != null ? $tax->profiling01->answer_12 : null }}">
            </td>
        </tr>
        <tr>
            <td class="text-center">i</td>
            <td>Pernah dituduh dan disabit kesalahan di mahkamah</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q12i" type="radio" value="10"
                           name="mark_12" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_12 == 10 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q12i">10</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">ii</td>
            <td>Mempunyai tunggakan hasil melebihi RM100,000 / dalam tindakan sivil</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q12ii" type="radio" value="7"
                           name="mark_12" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_12 == 7 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q12ii">7</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iii</td>
            <td>Pernah dikompaun</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q12iii" type="radio" value="4"
                           name="mark_12" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_12 == 4 ? 'checked' : null }} @endif>
                    <label class="form-check-label" style="width: 100%;cursor:pointer" for="q12iii">4</label>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center">iv</td>
            <td>Pernah diberi amaran</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" id="q12iv" type="radio" value="1"
                           name="mark_12" @if($tax->profiling01 != null) {{ $tax->profiling01->mark_12 == 1 ? 'checked' : null }} @endif>
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
                                                                                  value="{{ $tax->profiling01 != null ? $tax->profiling01->total_mark : null }}"
                                                                                  readonly></td>
                    </tr>
                    <tr>
                        <td style="width: 550px;border-top-style: none"><strong>2. % tahap risiko (Jumlah markah/100) x 100%</strong></td>
                        <td style="width: 150px;border-top-style: none"></strong><input class="form-control" type="text" name="risk_level"
                                                                                        value="{{ $tax->profiling01 != null ? $tax->profiling01->risk_level : null }}"
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
                                       @if($tax->profiling01 != null) {{ $tax->profiling01->risk_level_text == 'TINGGI' ? 'checked' : null }} @endif onclick="javascript: return false;">
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
                                       @if($tax->profiling01 != null) {{ $tax->profiling01->risk_level_text == 'SEDERHANA' ? 'checked' : null }} @endif onclick="javascript: return false;">
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
                                       @if($tax->profiling01 != null) {{ $tax->profiling01->risk_level_text == 'RENDAH' ? 'checked' : null }} @endif onclick="javascript: return false;">
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
                $('input:hidden[name=answer_01]').val($(this).closest('td').prev().html());
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
                $('input:hidden[name=answer_04]').val($(this).closest('td').prev().html());
                calTotal();
            });
            $('input:radio[name=mark_05]').change(function () {
                if ($(this).closest('td').prev()[0].firstElementChild != null) {
                    $('input:hidden[name=answer_05]').val($(this).closest('td').prev()[0].firstElementChild.value);
                } else {
                    $('input:hidden[name=answer_05]').val($(this).closest('td').prev().html());
                }
                calTotal();
            });
            $('input:radio[name=mark_06]').change(function () {
                if ($(this).closest('td').prev()[0].firstElementChild != null) {
                    $('input:hidden[name=answer_06]').val($(this).closest('td').prev()[0].firstElementChild.value);
                } else {
                    $('input:hidden[name=answer_06]').val($(this).closest('td').prev().html());
                }
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
                $('input[name="risk_level"]').val((total_mark / 100) * 100);
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

            $('#answer_05_ii').change(function () {
                $('input:hidden[name=answer_05]').val($(this).val());
            });

            $('#answer_06_i').change(function () {
                $('input:hidden[name=answer_06]').val($(this).val());
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
