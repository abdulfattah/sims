@if ($tax->profiling03 == null)
    <div class="col-6 col-sm-4 col-md text-center" style="height: 500px;padding-top:200px">
        <a href="{{ URL::to('tax/' . $tax->id . '/edit?section=profiling&page=03') }}" class="btn btn-lg btn-pill btn-danger pl-5 pr-5" type="button">Create</a>
    </div>
@else
    <div class="text-right">
        <a href="{{ URL::to('tax/' . $tax->id . '/edit?section=profiling&page=03') }}" class="btn btn-sm btn-primary" type="button">Update</a>
    </div>
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
                PENENTUAN TAHAP RISIKO ORANG BERDAFTAR
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
                        <td style="border: 1px solid #eee">NO. PENDAFTARAN SST</td>
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
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_01 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_01 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>2. Adakah pengilang menjalankan kerja sub-kontrak?</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{!! $tax->profiling03->answer_02 !!}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_02 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>3. Sekiranya ya, apakah jenis pembekalan barang yang diterima?</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_03 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_03 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>4. Adakah caj nilai jualan barang yang dikilangkan mengikut Seksyen 9(3) Akta Cukai Jualan 2018?</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_04 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_04 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>5. Hubungan pembeli dengan pengilang berdaftar</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_05 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_05 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>6. Status pembeli/pemasar kepada pengilang berdaftar</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_06 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_06 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>7. Cara pemasaran keluaran barang siap</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_07 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_07 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>8. Adakah terdapat perubahan harga jualan tempatan sebelum pelaksanaan SST dengan semasa pelaksanaan SST?</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_08 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_08 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>9. Adakah terdapat perbezaan harga jualan antara setiap pembeli?</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_09 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_09 }}</td>
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
                        <td style="width: 150px;border-bottom-style: none">{{ $tax->profiling03->total_mark }}</td>
                    </tr>
                    <tr>
                        <td style="width: 550px;border-top-style: none"><strong>2. % tahap risiko (Jumlah markah/100) x 100%</strong></td>
                        <td style="width: 150px;border-top-style: none">{{ $tax->profiling03->risk_level }}</td>
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
                @if ($tax->profiling03->risk_level_text == 'TINGGI')
                    <span class="text-danger">RISIKO {{ $tax->profiling03->risk_level_text }}</span>
                @elseif ($tax->profiling03->risk_level_text == 'SEDERHANA')
                    <span class="text-warning">RISIKO {{ $tax->profiling03->risk_level_text }}</span>
                @elseif ($tax->profiling03->risk_level_text == 'RENDAH')
                    <span class="text-success">RISIKO {{ $tax->profiling03->risk_level_text }}</span>
                @endif
            </td>
        </tr>
        </tbody>
    </table>
@endif
