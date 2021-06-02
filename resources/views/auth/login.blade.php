@extends('auth.main')
@section('content')
    <div class="col-12">
        <div class="card-group">
            <div class="py-5 text-white d-md-down-none">
                <div class="text-center">
                    <img src="{{ asset('images/g14.png') }}"/>
                </div>
            </div>
            <div class="p-4">
                <div class="text-center">
                    <img src="{{ asset('images/login_header.png') }}"/>
                </div>
                <form method="POST" action="{{ \URL::to('login') }}" id="form-login" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-center">Login</h2>
                            <p class="text-muted text-center">Please enter your username and password</p>
                            @if ($errors->any())
                                <div class="alert alert-danger pl-1 pt-1 pb-1">
                                    <ul class="mt-0 mb-0 pl-1" style="list-style-type:none;">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger pl-2 pt-1 pb-1">
                                    {{ e(Session::get('error')) }}
                                </div>
                            @endif
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success pl-2 pt-1 pb-1">
                                    {{ e(Session::get('success')) }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="{{ asset('icons/free.svg#cil-user') }}"></use>
                                    </svg>
                                </span>
                                </div>
                                <div class="dx-texteditor-with-icon" data-dx="textbox" data-case="lowercase" data-name="username" data-mode="email" data-placeholder="Email"
                                     data-value="" data-validate="true"
                                     data-validation-type="required,email" data-validation-group="form"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="{{ asset('icons/free.svg#cil-lock-locked') }}"></use>
                                    </svg>
                                </span>
                                </div>
                                <div class="dx-texteditor-with-icon" data-dx="textbox" data-name="password" data-mode="password" data-placeholder="Password" data-value=""
                                     data-validate="true"
                                     data-validation-type="required" data-validation-group="form"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div data-dx="checkbox" data-name="rememberme" data-value="false" data-text="Remember me"></div>
                        </div>
                        <div class="col-6 text-right" style="margin-left: -5px;">
                            <div data-dx="btn-submit" data-type="default" data-text="Log In" data-disabled="true" data-validation-group="form" data-form="form-login"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ URL::to('password/lost') }}" class="btn btn-link px-0">Forgot password?</a>
                        </div>
                        <div class="col-6">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
