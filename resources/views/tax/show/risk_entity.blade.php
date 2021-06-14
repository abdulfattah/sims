@if ($tax->profiling02 == null)
    <div class="col-6 col-sm-4 col-md text-center" style="height: 500px;padding-top:200px">
        <a href="{{ URL::to('tax/' . $tax->id . '/edit?section=profiling&page=risk_entity') }}" class="btn btn-lg btn-pill btn-danger pl-5 pr-5" type="button">Create</a>
    </div>
@else
    <div class="text-right">
        <a href="{{ URL::to('tax/' . $tax->id . '/edit?section=profiling&page=risk_entity') }}" class="btn btn-sm btn-primary mr-1" type="button">Update</a>
        <a href="{{ URL::to('print/risk_entity/' . $tax->id) }}" class="btn btn-sm btn-warning mr-1" type="button" target="_blank">Print</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-risk-entity" data-tax-id="{{ $tax->id }}" data-id="{{ $tax->profiling02->id }}" type="button">Delete</a>
    </div>
    <table class="table table-responsive-sm table-sm mt-3" style="border-style: hidden">
        <tbody>
        <tr>
            <td colspan="2" style="font-style: italic;text-align: right">
                Borang Profailing Penentuan Tahap Risiko Entiti Cukai Jualan<br>
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
                PENENTUAN TAHAP RISIKO ENTITI CUKAI JUALAN
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
                        <td style="border: 1px solid #eee">NO. PENDAFTARAN SST</td>
                        <td colspan="2" style="border: 1px solid #eee;text-align: left">{{ $tax->sst_no }}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td><strong>1. Jenis entiti</strong></td>
            <td class="text-center"><strong>Markah</strong></td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling02->answer_01 }}</td>
            <td style="text-align: center;">{{ $tax->profiling02->mark_01 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>2. Jenis bangunan yang didiami oleh syarikat/perniagaan</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling02->answer_02 }}</td>
            <td style="text-align: center;">{{ $tax->profiling02->mark_02 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>3. Hak milik bangunan / premis</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling02->answer_03 }}</td>
            <td style="text-align: center;">{{ $tax->profiling02->mark_03 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>4. Jenis aktiviti</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling02->answer_04 }}</td>
            <td style="text-align: center;">{{ $tax->profiling02->mark_04 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>5. Jenis kemudahan yang diberi</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling02->answer_05 }}</td>
            <td style="text-align: center;">{{ $tax->profiling02->mark_05 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>6. Kegagalan mengemukakan penyata atau membuat pembayaran cukai.</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling02->answer_06 }}</td>
            <td style="text-align: center;">{{ $tax->profiling02->mark_06 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>7. Cara pemasaran keluaran barang siap</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling02->answer_07 }}</td>
            <td style="text-align: center;">{{ $tax->profiling02->mark_07 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>8. Kegagalan mengemukakan penyata stok pembelian bahan mentah, komponen, bahan pembungkusan (3 bulan sekali)</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling02->answer_08 }}</td>
            <td style="text-align: center;">{{ $tax->profiling02->mark_08 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>9. Cara pelupusan sisa, hampas, bahan mentah, komponen dan barang siap rosak</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling02->answer_09 }}</td>
            <td style="text-align: center;">{{ $tax->profiling02->mark_09 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>10. Kekerapan verifikasi ke atas entiti</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling02->answer_10 }}</td>
            <td style="text-align: center;">{{ $tax->profiling02->mark_10 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>11. Tahap pematuhan ke atas pemeriksaan semasa yang dilakukan oleh pegawai</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling02->answer_11 }}</td>
            <td style="text-align: center;">{{ $tax->profiling02->mark_11 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>12. Profil dan rekod dengan Jabatan</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling02->answer_12 }}</td>
            <td style="text-align: center;">{{ $tax->profiling02->mark_12 }}</td>
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
                        <td style="width: 150px;border-bottom-style: none">{{ $tax->profiling02->total_mark }}</td>
                    </tr>
                    <tr>
                        <td style="width: 550px;border-top-style: none"><strong>2. % tahap risiko (Jumlah markah/120) x 100%</strong></td>
                        <td style="width: 150px;border-top-style: none">{{ $tax->profiling02->risk_level }}</td>
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
                @if ($tax->profiling02->risk_level_text == 'TINGGI')
                    <span class="text-danger">RISIKO {{ $tax->profiling02->risk_level_text }}</span>
                @elseif ($tax->profiling02->risk_level_text == 'SEDERHANA')
                    <span class="text-warning">RISIKO {{ $tax->profiling02->risk_level_text }}</span>
                @elseif ($tax->profiling02->risk_level_text == 'RENDAH')
                    <span class="text-success">RISIKO {{ $tax->profiling02->risk_level_text }}</span>
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border-top-style: none;border-bottom-style: none;">&nbsp;</td>
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
                            {{ $tax->profiling02->preparedBy != null ? $tax->profiling02->preparedBy->fullname : null }}
                        </td>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling02->checkedBy != null ? $tax->profiling02->checkedBy->fullname : null }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling02->preparedBy != null ? $tax->profiling02->preparedBy->position : null }}
                        </td>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling02->checkedBy != null ? $tax->profiling02->checkedBy->position : null }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling02->preparedBy != null ? $tax->profiling02->preparedBy->department : null }}
                        </td>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling02->checkedBy != null ? $tax->profiling02->checkedBy->department : null }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
@endif
