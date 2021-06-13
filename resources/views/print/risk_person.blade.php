@extends("print.main")

@section('content')
    <header style="width: 100%; margin-top: 0;">
        @php
            if (count(glob(public_path('images/letterhead.*'))) > 0) {
                $file = explode('.', glob(public_path('images/letterhead.*'))[0]);
                echo '<img src="'. asset('images/letterhead.' . $file[1]) . '" style="height: 150px"/>';
            }
        @endphp
    </header>
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
                PENENTUAN TAHAP RISIKO ORANG BERDAFTAR
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: 700;text-align: center">
                <table style="width: 690px;border-collapse: collapse;">
                    <tbody>
                    <tr>
                        <td style="border: 1px solid #eee;width: 130px">NAMA SYARIKAT</td>
                        <td style="border: 1px solid #eee;width: 560px">{{ $tax->business_name }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #eee">NO DAFTAR CJ</td>
                        <td style="border: 1px solid #eee;">{{ $tax->sst_no }}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width: 80%"><strong>1. Jenis Perniagaan</strong></td>
            <td style="width: 20%;text-align: center;"><strong>Markah</strong></td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_01 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_01 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>2. Jenis Tempat Perniagaan Orang Berdaftar</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{!! $tax->profiling03->answer_02 !!}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_02 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>3. Pengauditan atas akaun Orang Berdaftar</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_03 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_03 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>4. Sistem Pengurusan</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_04 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_04 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>5. Penyelenggaraan rekod dan dokumen</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_05 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_05 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>6. Kegagalan mengemukakan penyata atau membuat pembayaran cukai</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_06 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_06 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>7. Profil dan rekod syarikat</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_07 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_07 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>8. Jenis bangunan yang didiami oleh syarikat/perniagaan</strong>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">{{ $tax->profiling03->answer_08 }}</td>
            <td style="text-align: center;">{{ $tax->profiling03->mark_08 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>9. Hak milik bangunan / premis</strong>
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
                <table style="width: 400px;border-collapse: collapse;">
                    <tbody>
                    <tr>
                        <td style="width: 250px;"><strong>1. Jumlah markah yang diperolehi</strong></td>
                        <td style="width: 150px;">{{ $tax->profiling03->total_mark }}</td>
                    </tr>
                    <tr>
                        <td><strong>2. % tahap risiko (Jumlah markah/90) x 100%</strong></td>
                        <td>{{ $tax->profiling03->risk_level }}</td>
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
                    <span style="color: red">RISIKO {{ $tax->profiling03->risk_level_text }}</span>
                @elseif ($tax->profiling03->risk_level_text == 'SEDERHANA')
                    <span style="color: yellow">RISIKO {{ $tax->profiling03->risk_level_text }}</span>
                @elseif ($tax->profiling03->risk_level_text == 'RENDAH')
                    <span style="color: green">RISIKO {{ $tax->profiling03->risk_level_text }}</span>
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
                            {{ $tax->profiling03->preparedBy != null ? $tax->profiling03->preparedBy->fullname : null }}
                        </td>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling03->checkedBy != null ? $tax->profiling03->checkedBy->fullname : null }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling03->preparedBy != null ? $tax->profiling03->preparedBy->position : null }}
                        </td>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling03->checkedBy != null ? $tax->profiling03->checkedBy->position : null }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling03->preparedBy != null ? $tax->profiling03->preparedBy->department : null }}
                        </td>
                        <td style="text-align: center;padding: 0px">
                            {{ $tax->profiling03->checkedBy != null ? $tax->profiling03->checkedBy->department : null }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
@stop
