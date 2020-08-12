@extends('main')
@section('content')
<div class="nav-tabs-boxed">
    <ul class="nav nav-pills nav-justified" role="tablist">
        <li class="nav-item">
            @if(\Request::get('section') == 'basic')
            <a class="nav-link active" data-toggle="tab" href="#basic" role="tab" aria-controls="basic">Basic Information</a>
            @else
            <a class="nav-link" href="{{ URL::to('tax/'.$tax->id.'?section=basic') }}">Basic Information</a>
            @endif
        </li>
        <li class="nav-item">
            @if(\Request::get('section') == 'additional')
            <a class="nav-link @if(\Request::get('section') == 'additional') active @endif" data-toggle="tab" href="#additional" role="tab" aria-controls="additional">Additional
                Information</a>
            @else
            <a class="nav-link" href="{{ URL::to('tax/'.$tax->id.'?section=additional') }}">Additional Information</a>
            @endif
        </li>
        <li class="nav-item">
            @if(\Request::get('section') == 'attachment')
            <a class="nav-link @if(\Request::get('section') == 'attachment') active @endif" data-toggle="tab" href="#attachment" role="tab" aria-controls="attachment">Attachment</a>
            @else
            <a class="nav-link" href="{{ URL::to('tax/'.$tax->id.'?section=attachment') }}">Attachment</a>
            @endif
        </li>
        <li class="nav-item">
            @if(\Request::get('section') == 'profiling')
            <a class="nav-link @if(\Request::get('section') == 'profiling') active @endif" data-toggle="tab" href="#profiling" role="tab" aria-controls="profiling">Profiling</a>
            @else
            <a class="nav-link" href="{{ URL::to('tax/'.$tax->id.'?section=profiling') }}">Profiling</a>
            @endif
        </li>
        <li class="nav-item">
            @if(\Request::get('section') == 'note')
            <a class="nav-link @if(\Request::get('section') == 'note') active @endif" data-toggle="tab" href="#note" role="tab" aria-controls="note">Note</a>
            @else
            <a class="nav-link" href="{{ URL::to('tax/'.$tax->id.'?section=note') }}">Note</a>
            @endif
        </li>
        <li class="nav-item">
            @if(\Request::get('section') == 'history')
            <a class="nav-link @if(\Request::get('section') == 'history') active @endif" data-toggle="tab" href="#history" role="tab" aria-controls="history">History</a>
            @else
            <a class="nav-link" href="{{ URL::to('tax/'.$tax->id.'?section=history') }}">History</a>
            @endif
        </li>
    </ul>
    <div class="tab-content mt-2">
        <div class="tab-pane @if(\Request::get('section') == 'basic') active @endif" id="basic" role="tabpanel">
            @include('tax.form.basic')
        </div>
        <div class="tab-pane @if(\Request::get('section') == 'additional') active @endif" id="additional" role="tabpanel">
            @include('tax.form.additional')
        </div>
        <div class="tab-pane @if(\Request::get('section') == 'attachment') active @endif" id="attachment" role="tabpanel"></div>
        <div class="tab-pane @if(\Request::get('section') == 'profiling') active @endif" id="profiling" role="tabpanel">
            @include('tax.form.profiling')
        </div>
        <div class="tab-pane @if(\Request::get('section') == 'note') active @endif" id="note" role="tabpanel"></div>
        <div class="tab-pane @if(\Request::get('section') == 'history') active @endif" id="history" role="tabpanel"></div>
    </div>
</div>
@stop