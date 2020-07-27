@extends('main')
@section('content')
<div class="nav-tabs-boxed">
    <ul class="nav nav-pills nav-justified" role="tablist">
        <li class="nav-item"><a class="nav-link @if(\Request::get('section') == 'basic') active @endif" data-toggle="tab" href="#basic" role="tab" aria-controls="basic">Basic Information</a></li>
        <li class="nav-item"><a class="nav-link @if(\Request::get('section') == 'additional') active @endif" data-toggle="tab" href="#additional" role="tab" aria-controls="additional">Additional
                Information</a></li>
        <li class="nav-item"><a class="nav-link @if(\Request::get('section') == 'attachment') active @endif" data-toggle="tab" href="#attachment" role="tab" aria-controls="attachment">Attachment</a></li>
        <li class="nav-item"><a class="nav-link @if(\Request::get('section') == 'profiling') active @endif" data-toggle="tab" href="#profiling" role="tab" aria-controls="profiling">Profiling</a></li>
        <li class="nav-item"><a class="nav-link @if(\Request::get('section') == 'note') active @endif" data-toggle="tab" href="#note" role="tab" aria-controls="note">Note</a></li>
        <li class="nav-item"><a class="nav-link @if(\Request::get('section') == 'history') active @endif" data-toggle="tab" href="#history" role="tab" aria-controls="history">History</a></li>
    </ul>
    <div class="tab-content mt-2">
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
            @include('tax.show.profiling')
        </div>
        <div class="tab-pane @if(\Request::get('section') == 'note') active @endif" id="note" role="tabpanel">
            @include('tax.show.note')
        </div>
        <div class="tab-pane @if(\Request::get('section') == 'history') active @endif" id="history" role="tabpanel">
            @include('tax.show.history')
        </div>
    </div>
</div>
@stop