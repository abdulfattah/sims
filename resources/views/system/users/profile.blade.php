@extends('main')
@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <img class="c-avatar-img" src="{!! URL::to('asset/image?in=avatar&filename=' . \App\Libs\App::getFilename('image', $user->avatar)) !!}">
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                    Your Information
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-2 col-xl-2">Fullname</dt>
                        <dd class="col-sm-10 col-xl-10"> {!! $user->fullname !!}</dd>
                        <dt class="col-sm-2 col-xl-2">Role</dt>
                        <dd class="col-sm-10 col-xl-10"> {!! implode(' / ', json_decode($user->role)) !!}</dd>
                        <dt class="col-sm-2 col-xl-2">Email</dt>
                        <dd class="col-sm-10 col-xl-10"><a href="mailto:{!! $user->username !!}" target="_blank" class="text-navy">{!! $user->username !!}</a></dd>
                    </dl>
                </div>
                <div class="card-footer text-right">
                    <button type="button" class="btn btn-sm btn-primary" style="height: 33px" onclick="location.href = '{{ URL::to('user/' . $user->id . '/edit') }}';">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop