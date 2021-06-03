@extends('main')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="text-center" style="margin-top: 20px">
                        <img class="img-bordered-primary" style="width: 170px; margin: 22px 0 0 14px"
                             src="{!! URL::to('asset/image?in=avatar&filename=' . \App\Libs\App::getFilename('image', $user->avatar)) !!}">
                    </div>
                </div>
                <div class="col-md-9">
                    <h5>User's Information</h5>
                    <hr class="mt-1 mb-4">
                    <dl class="row">
                        <dt class="col-sm-3 col-xl-3">Fullname</dt>
                        <dd class="col-sm-9 col-xl-7">&nbsp;{!! $user->fullname !!}</dd>
                        <dt class="col-sm-3 col-xl-3">Role</dt>
                        <dd class="col-sm-9 col-xl-7">&nbsp;{!! implode(' / ', json_decode($user->role)) !!}</dd>
                        <dt class="col-sm-3 col-xl-3">Jawatan</dt>
                        <dd class="col-sm-9 col-xl-7">&nbsp;{!! $user->position !!}</dd>
                        <dt class="col-sm-3 col-xl-3">Jabatan</dt>
                        <dd class="col-sm-9 col-xl-7">&nbsp;{!! $user->department !!}</dd>
                        <dt class="col-sm-3 col-xl-3">Email</dt>
                        <dd class="col-sm-9 col-xl-7">&nbsp;<a href="mailto:{!! $user->username !!}" target="_blank" class="text-navy">{!! $user->username !!}</a></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <a href="{{ URL::to('user') }}" class="text-danger mr-3">Cancel</a>
            <button type="button" class="btn btn-sm btn-primary" style="height: 33px" onclick="location.href = '{{ URL::to('user/' . $user->id . '/edit') }}';">
                Update
            </button>
        </div>
    </div>
@stop