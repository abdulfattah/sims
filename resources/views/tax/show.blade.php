@extends('main')
@section('content')
    <div id="panel-5" class="panel">
        <div class="panel-container show">
            <div class="panel-content">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::get('section') == 'basic') active @endif p-3" href="{{ url()->to('tax/' . $tax->id . '?section=basic') }}">
                            <i class="fal fa-list-alt text-success"></i>
                            Basic Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::get('section') == 'additional') active @endif p-3" href="{{ url()->to('tax/' . $tax->id . '?section=additional') }}">
                            <i class="fal fa-list text-success"></i>
                            Additional Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::get('section') == 'crs') active @endif p-3" href="{{ url()->to('tax/' . $tax->id . '?section=crs') }}">
                            <i class="fal fa-air-freshener text-success"></i>
                            Current Return Status
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::get('section') == 'gesaan') active @endif p-3" href="{{ url()->to('tax/' . $tax->id . '?section=gesaan') }}">
                            <i class="fal fa-check text-success"></i>
                            Gesaan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::get('section') == 'attachment') active @endif p-3" href="{{ url()->to('tax/' . $tax->id . '?section=attachment') }}">
                            <i class="fal fa-paperclip text-success"></i>
                            Attachment
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::get('section') == 'profiling') active @endif p-3" href="{{ url()->to('tax/' . $tax->id . '?section=profiling') }}">
                            <i class="fal fa-user-alt text-success"></i>
                            Profiling
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::get('section') == 'note') active @endif p-3" href="{{ url()->to('tax/' . $tax->id . '?section=note') }}">
                            <i class="fal fa-sticky-note text-success"></i>
                            Note
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::get('section') == 'history') active @endif p-3" href="{{ url()->to('tax/' . $tax->id . '?section=history') }}">
                            <i class="fal fa-history text-success"></i>
                            History
                        </a>
                    </li>
                </ul>
                <div class="tab-content border border-top-0 p-3">
                    <div class="tab-pane @if(\Request::get('section') == 'basic') active @endif">
                        @include('tax.show.basic')
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'additional') active @endif">
                        @include('tax.show.additional')
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'crs') active @endif">
                        @include('tax.show.crs')
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'gesaan') active @endif">
                        @include('tax.show.gesaan')
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'attachment') active @endif">
                        @include('tax.show.attachment')
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'profiling') active @endif">
                        <div class="panel-content">
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#risk_entity">Entiti Cukai Jualan</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#risk_person">Orang Berdaftar</a></li>
                            </ul>
                            <div class="tab-content py-3">
                                <div class="tab-pane fade active show" id="risk_entity" role="tabpanel">
                                    @include('tax.show.risk_entity')
                                </div>
                                <div class="tab-pane fade" id="risk_person" role="tabpanel">
                                    @include('tax.show.risk_person')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'note') active @endif">
                        @include('tax.show.note')
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'history') active @endif">
                        @include('tax.show.history')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-script')
    <script type="text/javascript">
        $(document).ready(function () {
            tinymce.init({
                selector: '#note-content',
                menubar: false,
                toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
                height: 350
            });

            $("#form-note").on("submit", function () {
                $(this).append("<textarea name='note' style='display:none'>" + tinymce.activeEditor.getContent() + "</textarea>");
            });

            $(document).on('focusin', function (e) {
                if ($(e.target).closest(".tox-tinymce, .tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
                    e.stopImmediatePropagation();
                }
            });

            setTimeout(function () {
                $('#upload-attachment').removeAttr('disabled');
                $('#add-note').removeAttr('disabled');
                $('#add-gesaan').removeAttr('disabled');
            }, 2000)
        });
    </script>
@stop
