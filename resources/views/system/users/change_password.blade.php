@extends('main')
@section('content')
    <div class="card">
        <div class="card-header">
            Change Password
        </div>
        <div class="card-body">
            <form method="POST" action="{!! \URL::to('password') !!}" id="form-user" class="form-horizontal" enctype="multipart/form-data"
                  novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Old Password</label>
                            <div class="col-md-5">
                                <div class="dx-texteditor-with-icon" data-dx="textbox" data-name="old_password" data-mode="password" data-value="" data-validate="true"
                                     data-validation-type="required" data-validation-group="form">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">New Password</label>
                            <div class="col-md-5">
                                <div class="dx-texteditor-with-icon" data-dx="textbox" data-name="password" data-mode="password" data-value="" data-validate="true"
                                     data-validation-type="required" data-validation-group="form">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">New Password (Retype)</label>
                            <div class="col-md-5">
                                <div class="dx-texteditor-with-icon" data-dx="textbox" data-name="retype_password" data-mode="password" data-value="" data-validate="true"
                                     data-validation-type="required,retype_password" data-validation-group="form"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-right">
            <a href="{!! URL::to('/') !!}" class="btn btn-ghost-danger">Cancel</a>
            <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="false" data-validation-group="form" data-form="form-user"></div>
        </div>
    </div>
@stop