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
                <div class="col-md-8">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Host</label>
                        <div class="col-md-5">
                            <div data-dx="textbox" data-name="mail_mailers_smtp_host" data-mode="text" data-case="lowercase"
                                data-value="{!! request()->old('mail_mailers_smtp_host', isset($emailHost) ? $emailHost['value'] : null) !!}" data-validate="true"
                                data-validation-type="required" data-validation-group="form"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Port</label>
                        <div class="col-md-5">
                            <div data-dx="textbox" data-name="mail_mailers_smtp_port" data-mode="text"
                                data-value="{!! request()->old('mail_mailers_smtp_port', isset($emailPort) ? $emailPort['value'] : null) !!}" data-validate="true"
                                data-validation-type="required" data-validation-group="form"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">SSL</label>
                        <div class="col-md-5">
                            <div data-dx="textbox" data-name="mail_mailers_smtp_encryption" data-mode="text" data-case="lowercase"
                                data-value="{!! request()->old('mail_mailers_smtp_encryption', isset($emailSSL) ? $emailSSL['value'] : null) !!}"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Username</label>
                        <div class="col-md-5">
                            <div data-dx="textbox" data-name="mail_mailers_smtp_username" data-mode="text" data-case="lowercase"
                                data-value="{!! request()->old('mail_mailers_smtp_username', isset($emailFrom) ? $emailFrom['value'] : null) !!}" data-validate="true"
                                data-validation-type="required" data-validation-group="form"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Password</label>
                        <div class="col-md-5">
                            <div data-dx="textbox" data-name="mail_mailers_smtp_password" data-mode="password" data-case="lowercase"
                                data-value="{!! request()->old('mail_mailers_smtp_password', isset($emailPassword) ? $emailPassword['value'] : null) !!}" data-validate="true"
                                data-validation-type="required" data-validation-group="form">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">From Email Address</label>
                        <div class="col-md-5">
                            <div data-dx="textbox" data-name="mail_from_address" data-mode="text" data-case="lowercase"
                                data-value="{!! request()->old('mail_from_address', isset($emailFrom) ? $emailFrom['value'] : null) !!}" data-validate="true"
                                data-validation-type="required,email" data-validation-group="form"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">From Name</label>
                        <div class="col-md-5">
                            <div data-dx="textbox" data-name="mail_from_name" data-mode="text" data-case="lowercase"
                                data-value="{!! request()->old('mail_from_name', isset($emailName) ? $emailName['value'] : null) !!}" data-validate="true" data-validation-type="required"
                                data-validation-group="form"></div>
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