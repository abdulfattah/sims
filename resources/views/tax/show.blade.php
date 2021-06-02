@extends('main')
@section('content')
    <div id="panel-5" class="panel">
        <div class="panel-container show">
            <div class="panel-content">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::get('section') == 'basic') active @endif" data-toggle="tab" href="#basic" role="tab" aria-controls="basic">Basic
                            Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::get('section') == 'additional') active @endif" data-toggle="tab" href="#additional" role="tab" aria-controls="additional">Additional
                            Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::get('section') == 'attachment') active @endif" data-toggle="tab" href="#attachment" role="tab" aria-controls="attachment">Attachment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::get('section') == 'profiling') active @endif" data-toggle="tab" href="#profiling" role="tab"
                           aria-controls="profiling">Profiling</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::get('section') == 'note') active @endif" data-toggle="tab" href="#note" role="tab" aria-controls="note">Note</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(\Request::get('section') == 'history') active @endif" data-toggle="tab" href="#history" role="tab"
                           aria-controls="history">History</a>
                    </li>
                </ul>
                <div class="tab-content border border-top-0 p-3">
                    <div class="tab-pane @if(\Request::get('section') == 'basic') active @endif" id="basic" role="tabpanel">
                        @include('tax.show.basic')
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'additional') active @endif" id="additional" role="tabpanel">
                        @include('tax.show.additional')
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'attachment') active @endif" id="attachment" role="tabpanel">
                        @include('tax.show.attachment')
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'profiling') active @endif" id="profiling" role="tabpanel">
                        <div class="row">
                            <div class="col-2">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" data-toggle="pill" href="#profiling_01" role="tab">Profile 01</a>
                                    <a class="nav-link" data-toggle="pill" href="#profiling_02" role="tab">Profile 02</a>
                                    <a class="nav-link" data-toggle="pill" href="#profiling_03" role="tab">Profile 03</a>
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="profiling_01" role="tabpanel">
                                        @include('tax.show.profiling_01')
                                    </div>
                                    <div class="tab-pane fade" id="profiling_02" role="tabpanel">
                                        @include('tax.show.profiling_02')
                                    </div>
                                    <div class="tab-pane fade" id="profiling_03" role="tabpanel">
                                        @include('tax.show.profiling_03')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'note') active @endif" id="note" role="tabpanel">
                        @include('tax.show.note')
                    </div>
                    <div class="tab-pane @if(\Request::get('section') == 'history') active @endif" id="history" role="tabpanel">
                        @include('tax.show.history')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
