@extends('main')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ isset($user) ? \URL::to('user', $user->id) : \URL::to('user') }}" id="form-user" class="form-horizontal" enctype="multipart/form-data"
                  novalidate>
                @csrf
                @if (isset($user)) <input type="hidden" name="_method" value="PUT"/> @endif
                <div class="row">
                    <div class="col-md-3">
                        <div class="center" style="margin-top: 20px">
                            <div id="crop"></div>
                            <div class="controls" style="margin: 3px auto;width: 100px;">
                                <div id="profile_pic"></div>
                                <input type="hidden" name="profile_image"/>
                                <input type="hidden" name="avatar"
                                       value="{{ \Request::old('avatar', (isset($user) && $user->avatar != null) ? URL::to('asset/image?in=avatar&filename=' . \App\Libs\App::getFilename('image', $user->avatar)) : NULL) }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h5>User's Information</h5>
                        <hr class="mt-1 mb-4">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="hf-email">Fullname</label>
                            <div class="col-md-9">
                                <div data-dx="textbox" data-name="fullname" data-mode="text" data-value="{{ \Request::old('fullname', isset($user) ? $user->fullname : NULL) }}"
                                     data-validate="true" data-validation-type="required" data-validation-group="form"></div>
                            </div>
                        </div>
                        @if (strpos(Auth::user()->role, 'ADMINISTRATOR') !== false)
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="hf-email">Role</label>
                                <div class="col-md-9">
                                    <div data-dx="tagbox" data-name="roles[]" data-source="roles" data-value-exp="id"
                                         data-value='{{ \Request::old('role', isset($user) ? $user->role : NULL) }}'
                                         data-validate="true" data-validation-type="required" data-validation-group="form">
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="hf-email">Email</label>
                            <div class="col-md-9">
                                <div data-dx="textbox" data-case="lowercase" data-name="username" data-mode="text"
                                     data-value="{{ \Request::old('username', isset($user) ? $user->username : NULL) }}"
                                     data-validate="true" data-validation-type="required,email" data-validation-group="form">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="hf-position">Jawatan</label>
                            <div class="col-md-9">
                                <div data-dx="textbox" data-name="position" data-mode="text"
                                     data-value="{!! \Request::old('position', isset($user) ? $user->position : NULL) !!}"
                                     data-validate="true" data-validation-type="required" data-validation-group="form">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="hf-department">Jabatan</label>
                            <div class="col-md-9">
                                <div data-dx="textbox" data-name="department" data-mode="text"
                                     data-value="{!! \Request::old('department', isset($user) ? $user->department : NULL) !!}"
                                     data-validate="true" data-validation-type="required" data-validation-group="form">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-right">
            @if (strpos(Auth::user()->role, 'ADMINISTRATOR') !== false)
                <a href="{{ URL::to('user') }}" class="text-danger mr-3">Cancel</a>
            @else
                <a href="{{ URL::to('/') }}" class="text-danger mr-3">Cancel</a>
            @endif
            <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="false" data-validation-group="form" data-form="form-user"></div>
        </div>
    </div>
@stop
