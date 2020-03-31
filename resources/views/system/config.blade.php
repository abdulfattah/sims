@extends('main')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="mt-1 float-left">
            <strong>Settings</strong>
        </div>
    </div>
    <div class="card-body">
        <ul>
            <li>Use your gmail account to send email from this system</li>
            <li>If this setting failed to send email, please verify that your gmail account is Less Secure App accecc mode.
                You can check it here : <a href="https://myaccount.google.com/u/2/security" target="_blank">https://myaccount.google.com/u/2/security</a>
            </li>
            <li>Please contact developer if problem persist.</li>
        </ul>
        <form method="POST" action="{!! \URL::to('config', 1) !!}" id="form-config" class="form-horizontal" enctype="multipart/form-data" novalidate>
            @csrf
            <input type="hidden" name="_method" value="PUT" />
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Host</label>
                        <div class="col-md-9">
                            <div data-dx="textbox" data-name="email_host" data-mode="text" data-value="{!! \Request::old('email_host', isset($emailHost) ? $emailHost['value'] : null) !!}"
                                data-validate="true" data-validation-type="required" data-validation-group="form"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Port</label>
                        <div class="col-md-9">
                            <div data-dx="textbox" data-name="email_port" data-mode="text" data-value="{!! \Request::old('email_port', isset($emailPort) ? $emailPort['value'] : null) !!}"
                                data-validate="true" data-validation-type="required" data-validation-group="form"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">SSL</label>
                        <div class="col-md-9">
                            <div data-dx="textbox" data-name="email_ssl" data-mode="text" data-value="{!! \Request::old('email_ssl', isset($emailSSL) ? $emailSSL['value'] : null) !!}"
                                data-validate="true" data-validation-type="required" data-validation-group="form"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Email Address</label>
                        <div class="col-md-9">
                            <div data-dx="textbox" data-name="email_from" data-mode="text" data-value="{!! \Request::old('email_from', isset($emailFrom) ? $emailFrom['value'] : null) !!}"
                                data-validate="true" data-validation-type="required,email" data-validation-group="form"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">From Name</label>
                        <div class="col-md-9">
                            <div data-dx="textbox" data-name="email_name" data-mode="text" data-value="{!! \Request::old('email_name', isset($emailName) ? $emailName['value'] : null) !!}"
                                data-validate="true" data-validation-type="required" data-validation-group="form"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Email Password</label>
                        <div class="col-md-9">
                            <div data-dx="textbox" data-name="email_password" data-mode="password"
                                data-value="{!! \Request::old('email_password', isset($emailPassword) ? $emailPassword['value'] : null) !!}" data-validate="true"
                                data-validation-type="required" data-validation-group="form">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer text-right">
        <a href="{!! URL::to('/') !!}" class="btn btn-ghost-danger">Cancel</a>
        <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="false" data-validation-group="form" data-form="form-config"></div>
    </div>
</div>
@stop