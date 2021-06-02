@extends('auth.main')
@section('content')
    <div class="row">
        <div class="col col-md-6 col-lg-7 hidden-sm-down">
            <h2 class="fs-xxl fw-500 mt-4 text-white">
                Login
                <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60">
                    Please enter your username and password
                </small>
            </h2>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
            <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
                Secure login
            </h1>
            <div class="card p-4 rounded-plus bg-faded">
                @if ($errors->any())
                    <div class="alert alert-danger pl-1 pt-1 pb-1 mb-3">
                        <ul class="mt-0 mb-0 pl-1" style="list-style-type:none;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger pl-2 pt-1 pb-1 mb-3">
                        {{ e(Session::get('error')) }}
                    </div>
                @endif
                @if ($message = Session::get('success'))
                    <div class="alert alert-success pl-2 pt-1 pb-1 mb-3">
                        {{ e(Session::get('success')) }}
                    </div>
                @endif
                <form method="POST" action="{{ \URL::to('login') }}" id="form-login" novalidate>
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <div data-dx="textbox" data-case="lowercase" data-name="username" data-mode="email" data-placeholder="Email"
                             data-value="" data-validate="true" data-validation-type="required,email" data-validation-group="form"></div>
                        <div class="help-block">Your unique username to app</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div data-dx="textbox" data-name="password" data-mode="password" data-placeholder="Password" data-value=""
                             data-validate="true" data-validation-type="required" data-validation-group="form"></div>
                        <div class="help-block">Your password</div>
                    </div>
                    <div class="form-group text-left">
                        <div data-dx="checkbox" data-name="rememberme" data-value="false" data-text="Remember me"></div>
                        <a href="javascript:void(0)" id="forgot" class="btn btn-link px-0 float-right">Forgot password?</a>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-lg-6 pr-lg-1 my-2"></div>
                        <div class="col-lg-6 pl-lg-1 my-2">
                            <button id="js-login-btn" type="button" class="btn btn-danger btn-block btn-lg">Login</button>
                        </div>
                    </div>
                </form>
                <div id="popup"></div>
            </div>
        </div>
    </div>
@stop

@section('page-script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#js-login-btn").click(function () {
                if (DevExpress.validationEngine.validateGroup("form").isValid) {
                    $('#form-login').submit();
                }
            });

            $("#forgot").click(function () {
                const popup = $("#popup").dxPopup({
                    contentTemplate: function () {
                        return $("<div>").append(
                            $(`<p>Please contact system admin to reset your password</p>`)
                        );
                    },
                    width: 400,
                    height: 190,
                    container: ".page-wrapper",
                    showTitle: true,
                    title: "Lost Password",
                    visible: false,
                    dragEnabled: false,
                    closeOnOutsideClick: true,
                    showCloseButton: false,
                    toolbarItems: [{
                        widget: "dxButton",
                        toolbar: "bottom",
                        location: "after",
                        options: {
                            text: "Close",
                            onClick: function (e) {
                                popup.hide();
                            }
                        }
                    }]
                }).dxPopup("instance");

                popup.show();
            });
        });
    </script>
@stop
