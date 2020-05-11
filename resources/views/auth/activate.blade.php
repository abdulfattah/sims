@extends('auth.main')
@section('content')
<div class="col-12">
    <div class="card-group">
        <div class="py-5 text-white d-md-down-none">
            <div class="text-center">
                <img src="{!! asset('images/g14.png') !!}" />
            </div>
        </div>
        <div class="p-4">
            <div class="text-center">
                <img src="{!! asset('images/login_header.png') !!}" />
            </div>
            <form method="POST" action="{!! URL::to('activate/' . $user->id) !!}" id="form-activate" novalidate>
                @csrf
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center">Account Activation</h2>
                        <p class="text-muted text-center">Please enter your choosen password</p>
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
                            <div class="dx-texteditor-with-icon" data-dx="textbox" data-case="lowercase" data-name="username" data-mode="email" data-placeholder="Username" data-readonly="true"
                                data-value="{!! strtolower($user->username) !!}"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="{!! asset('icons/free.svg#cil-lock-locked') !!}"></use>
                                    </svg>
                                </span>
                            </div>
                            <div class="dx-texteditor-with-icon" data-dx="textbox" data-name="password" data-mode="password" data-placeholder="New password" data-value="" data-validate="true"
                                data-validation-type="required" data-validation-group="form"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="{!! asset('icons/free.svg#cil-lock-locked') !!}"></use>
                                    </svg>
                                </span>
                            </div>
                            <div class="dx-texteditor-with-icon" data-dx="textbox" data-name="retype_password" data-mode="password" data-placeholder="New password (retype)" data-value=""
                                data-validate="true" data-validation-type="required,retype_password" data-validation-group="form"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6 text-right" style="margin-left: -5px;">
                        <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="true" data-validation-group="form" data-form="form-activate"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop