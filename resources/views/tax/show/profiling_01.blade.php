@if ($tax->profiling01 == null)
    <div class="col-6 col-sm-4 col-md text-center" style="height: 500px;padding-top:200px">
        <a href="{{ URL::to('tax/' . $tax->id . '/edit?section=profiling&page=01') }}" class="btn btn-lg btn-pill btn-danger pl-5 pr-5" type="button">Create</a>
    </div>
@else
    <div class="text-right">
        <a href="{{ URL::to('tax/' . $tax->id . '/edit?section=profiling&page=01') }}" class="btn btn-sm btn-primary mr-1" type="button">Update</a>
        <a href="{{ URL::to('print/profiling_01/' . $tax->id) }}" class="btn btn-sm btn-warning" type="button" target="_blank">Print</a>
    </div>
    <table class="table table-responsive-sm table-sm mt-3" style="border-style: hidden">
        <tbody>
        <tr>
            <td colspan="2" style="font-style: italic;text-align: right">
                Borang Profailing Penentuan Tahap Risiko Pengilang Berdaftar<br>
                Unit Analisa, Profailing & Operasi<br>
                Bahagian Cukai Dalam Negeri (SST), Johor
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: 700;text-align: center;border-style: hidden">
                <img class="c-sidebar-brand-minimized" width="130" src="{{ asset('images/logo.svg') }}">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: 700;text-align: center">
                PENENTUAN TAHAP RISIKO PENGILANG BERDAFTAR
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: 700;text-align: center">
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
            <td><strong>1. Jenis aktiviti perniagaan</strong></td>
            <td class="text-center"><strong>Markah</strong></td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling01->answer_01 }}</td>
            <td style="text-align: center;">{{ $tax->profiling01->mark_01 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>2. Adakah pengilang menjalankan kerja sub-kontrak?</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling01->answer_02 }}</td>
            <td style="text-align: center;">{{ $tax->profiling01->mark_02 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>3. Sekiranya ya, apakah jenis pembekalan barang yang diterima?</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling01->answer_03 }}</td>
            <td style="text-align: center;">{{ $tax->profiling01->mark_03 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>4. Adakah caj nilai jualan barang yang dikilangkan mengikut Seksyen 9(3) Akta Cukai Jualan 2018?</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling01->answer_04 }}</td>
            <td style="text-align: center;">{{ $tax->profiling01->mark_04 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>5. Hubungan pembeli dengan pengilang berdaftar</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling01->answer_05 }}</td>
            <td style="text-align: center;">{{ $tax->profiling01->mark_05 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>6. Status pembeli/pemasar kepada pengilang berdaftar</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling01->answer_06 }}</td>
            <td style="text-align: center;">{{ $tax->profiling01->mark_06 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>7. Cara pemasaran keluaran barang siap</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling01->answer_07 }}</td>
            <td style="text-align: center;">{{ $tax->profiling01->mark_07 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>8. Adakah terdapat perubahan harga jualan tempatan sebelum pelaksanaan SST dengan semasa pelaksanaan SST?</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling01->answer_08 }}</td>
            <td style="text-align: center;">{{ $tax->profiling01->mark_08 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>9. Adakah terdapat perbezaan harga jualan antara setiap pembeli?</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling01->answer_09 }}</td>
            <td style="text-align: center;">{{ $tax->profiling01->mark_09 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>10. Jenis kemudahan pengecualian yang digunakan oleh syarikat</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling01->answer_10 }}</td>
            <td style="text-align: center;">{{ $tax->profiling01->mark_10 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>11. Kegagalan mengemukakan penyata atau membuat pembayaran cukai</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling01->answer_11 }}</td>
            <td style="text-align: center;">{{ $tax->profiling01->mark_11 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>12. Profil dan rekod dengan jabatan</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling01->answer_12 }}</td>
            <td style="text-align: center;">{{ $tax->profiling01->mark_12 }}</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" style="border-top-style: none;border-bottom-style: none">
                <strong>ANALISA TAHAP RISIKO</strong>
                <table class="table-sm mt-3" style="border-style: hidden">
                    <tbody>
                    <tr>
                        <td style="width: 550px;border-bottom-style: none"><strong>1. Jumlah markah yang diperolehi</strong></td>
                        <td style="width: 150px;border-bottom-style: none">{{ $tax->profiling01->total_mark }}</td>
                    </tr>
                    <tr>
                        <td style="width: 550px;border-top-style: none"><strong>2. % tahap risiko (Jumlah markah/100) x 100%</strong></td>
                        <td style="width: 150px;border-top-style: none">{{ $tax->profiling01->risk_level }}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border-top-style: none;border-bottom-style: none;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" style="border-top-style: none;font-size: 30px;text-align:center;font-weight: bold">
                @if ($tax->profiling01->risk_level_text == 'TINGGI')
                    <span class="text-danger">RISIKO {{ $tax->profiling01->risk_level_text }}</span>
                @elseif ($tax->profiling01->risk_level_text == 'SEDERHANA')
                    <span class="text-warning">RISIKO {{ $tax->profiling01->risk_level_text }}</span>
                @elseif ($tax->profiling01->risk_level_text == 'RENDAH')
                    <span class="text-success">RISIKO {{ $tax->profiling01->risk_level_text }}</span>
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border-top-style: none;border-bottom-style: none;height: 40px">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" style="border-top-style: none;">
                <table class="table-borderless table-sm mt-3" style="width: 80%;margin: 0 auto">
                    <tbody>
                    <tr>
                        <td style="width: 50%;text-align: center">Disediakan Oleh</td>
                        <td style="width: 50%;text-align: center">Disemak Oleh</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-top-style: none;border-bottom-style: none;height: 60px">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;padding: 0px">
                            _________________________________
                        </td>
                        <td style="text-align: center;padding: 0px">
                            _________________________________
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling01->preparedBy != null ? $tax->profiling01->preparedBy->fullname : null }}
                        </td>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling01->checkedBy != null ? $tax->profiling01->checkedBy->fullname : null }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling01->preparedBy != null ? $tax->profiling01->preparedBy->position : null }}
                        </td>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling01->checkedBy != null ? $tax->profiling01->checkedBy->position : null }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling01->preparedBy != null ? $tax->profiling01->preparedBy->department : null }}
                        </td>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling01->checkedBy != null ? $tax->profiling01->checkedBy->department : null }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
@endif
