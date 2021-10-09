@extends('main')
@section('content')
    <div id="panel-5" class="panel">
        <div class="panel-container show">
            <div class="panel-content">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        @if(\Request::get('section') == 'basic')
                            <a class="nav-link active" data-toggle="tab" href="#basic" role="tab" aria-controls="basic">
                                <i class="fal fa-list-alt text-success"></i>
                                Basic Information
                            </a>
                        @else
                            <a class="nav-link" href="{{ URL::to('tax/'.$tax->id.'?section=basic') }}">
                                <i class="fal fa-list-alt text-success"></i>
                                Basic Information
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if(\Request::get('section') == 'additional')
                            <a class="nav-link @if(\Request::get('section') == 'additional') active @endif" data-toggle="tab" href="#additional" role="tab"
                               aria-controls="additional">
                                <i class="fal fa-list text-success"></i>
                                Additional Information
                            </a>
                        @else
                            <a class="nav-link" href="{{ URL::to('tax/'.$tax->id.'?section=additional') }}">
                                <i class="fal fa-list text-success"></i>
                                Additional Information
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if(\Request::get('section') == 'crs')
                            <a class="nav-link @if(\Request::get('section') == 'crs') active @endif" data-toggle="tab" href="#crs" role="tab"
                               aria-controls="crs">
                                <i class="fal fa-list text-success"></i>
                                Current Return Status
                            </a>
                        @else
                            <a class="nav-link" href="{{ URL::to('tax/'.$tax->id.'?section=crs') }}">
                                <i class="fal fa-list text-success"></i>
                                Current Return Status
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if(\Request::get('section') == 'attachment')
                            <a class="nav-link @if(\Request::get('section') == 'attachment') active @endif" data-toggle="tab" href="#attachment" role="tab"
                               aria-controls="attachment">
                                <i class="fal fa-paperclip text-success"></i>
                                Attachment
                            </a>
                        @else
                            <a class="nav-link" href="{{ URL::to('tax/'.$tax->id.'?section=attachment') }}">
                                <i class="fal fa-paperclip text-success"></i>
                                Attachment
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if(\Request::get('section') == 'profiling')
                            <a class="nav-link @if(\Request::get('section') == 'profiling') active @endif" data-toggle="tab" href="#profiling" role="tab" aria-controls="profiling">
                                <i class="fal fa-user-alt text-success"></i>
                                Profiling
                            </a>
                        @else
                            <a class="nav-link" href="{{ URL::to('tax/'.$tax->id.'?section=profiling') }}">
                                <i class="fal fa-user-alt text-success"></i>
                                Profiling
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if(\Request::get('section') == 'note')
                            <a class="nav-link @if(\Request::get('section') == 'note') active @endif" data-toggle="tab" href="#note" role="tab" aria-controls="note">
                                <i class="fal fa-sticky-note text-success"></i>
                                Note
                            </a>
                        @else
                            <a class="nav-link" href="{{ URL::to('tax/'.$tax->id.'?section=note') }}">
                                <i class="fal fa-sticky-note text-success"></i>
                                Note
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if(\Request::get('section') == 'history')
                            <a class="nav-link @if(\Request::get('section') == 'history') active @endif" data-toggle="tab" href="#history" role="tab" aria-controls="history">
                                <i class="fal fa-history text-success"></i>
                                History
                            </a>
                        @else
                            <a class="nav-link" href="{{ URL::to('tax/'.$tax->id.'?section=history') }}">
                                <i class="fal fa-history text-success"></i>
                                History
                            </a>
                        @endif
                    </li>
                </ul>
                <div class="tab-content border border-top-0 p-3">
                    <div class="tab-pane @if(\Request::get('section') == 'basic') active @endif" id="basic" role="tabpanel">
                        @if(\Request::get('section') == 'basic')
                            @include('tax.form.basic')
                        @endif
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'additional') active @endif" id="additional" role="tabpanel">
                        @if(\Request::get('section') == 'additional')
                            @include('tax.form.additional')
                        @endif
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'crs') active @endif" id="crs" role="tabpanel"></div>
                    <div class="tab-pane @if(\Request::get('section') == 'gesaan') active @endif" id="gesaan" role="tabpanel"></div>
                    <div class="tab-pane @if(\Request::get('section') == 'attachment') active @endif" id="attachment" role="tabpanel"></div>
                    <div class="tab-pane @if(\Request::get('section') == 'profiling') active @endif" id="profiling" role="tabpanel">
                        @if(\Request::get('section') == 'profiling')
                            @include('tax.form.' . \Request::get('page'))
                        @endif
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'note') active @endif" id="note" role="tabpanel"></div>
                    <div class="tab-pane @if(\Request::get('section') == 'history') active @endif" id="history" role="tabpanel"></div>
                </div>
            </div>
        </div>
    </div>
@stop
