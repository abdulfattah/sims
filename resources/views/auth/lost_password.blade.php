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
                            <p class="text-muted text-center">Please enter your email</p>
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger pl-2 pt-1 pb-1">
                                    {!! e(Session::get('error')) !!}
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
                                        <use xlink:href="{!! asset('icons/free.svg#cil-user') !!}"></use>
                                    </svg>
                                </span>
                                </div>
                                <div class="dx-texteditor-with-icon" data-dx="textbox" data-name="email" data-case="lowercase" data-mode="email" data-placeholder="Email"
                                     data-value="" data-validate="true"
                                     data-validation-type="required,email" data-validation-group="form"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6 text-right" style="margin-left: -5px;">
                            <a href="{!! URL::to('login') !!}" class="btn btn-ghost-danger">Cancel</a>
                            <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="true" data-validation-group="form" data-form="form-forgot"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop