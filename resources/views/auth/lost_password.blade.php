@extends('auth.main')
@section('content')
    <div class="col-12">
        <div class="card-group">
            <div class="py-5 text-white d-md-down-none">
                <div class="text-center">
                    <img src="{!! asset('images/g14.png') !!}"/>
                </div>
            </div>
            <div class="p-4">
                <div class="text-center">
                    <img src="{!! asset('images/login_header.png') !!}"/>
                </div>
                <form method="POST" action="{!! \URL::to('password/lost') !!}" id="form-forgot" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-center">Lost Password</h2>
                            <p class="text-muted text-center">Please contact system admin to reset your password</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6 text-right" style="margin-left: -5px;">
                            <a href="{!! URL::to('login') !!}" class="btn btn-ghost-danger">Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop