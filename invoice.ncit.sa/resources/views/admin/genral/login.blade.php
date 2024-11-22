<!DOCTYPE html>


<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>Hey</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <!--begin::Global Theme Styles -->
    <link href="{{asset('style/css/vendors.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>


    <link href="{{asset('style/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('style/css/customBlack.css?v=5')}}" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles -->
    <link rel="shortcut icon" href=""/>
    <style>
        ::placeholder { /* Most modern browsers support this now. */
            color: #fff !Important;
        }

        .m-login.m-login--2.m-login-2--skin-1 .m-login__container .m-login__account .m-login__account-msg,
        .m-login--forget-password {
            color: #e8f0fe !Important ;
        }

        .m-login--forget-password {
            text-align: center;
        }
        .m-login__signin{
        background-color: rgba(0,0,0,0.5) !important;
        padding: 20px;
        border-radius: 10px}
    </style>
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body
    class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div
        class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1"
        id="m_login"
        style="background-image: url({{asset('img/b11.jpg')}});">
        <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__logo">

                </div>
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h1 class="m-login__title"></h1>
                        <br>
                        <br>
                        <h3 class="m-login__title">
                            {{__('text.login')}}
                        </h3>
                    </div>
                    <form class="m-login__form m-form"
                          action="{{ route('login') }}" method="post"
                          id="m_form_1" >
                        <div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="m_form_1_msg">
                            <div class="m-alert__icon">
                                <i class="la la-warning"></i>
                            </div>
                            <div class="m-alert__text">
                                {{__('text.alert__text')}}
                            </div>
                            <div class="m-alert__close">
                                <button type="button" class="close" data-close="alert" aria-label="Close">
                                </button>
                            </div>
                        </div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">

                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))

                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#"
                                                                                                             class="close"
                                                                                                             data-dismiss="alert"
                                                                                                             aria-label="close">&times;</a>
                                    </p>
                                @endif
                            @endforeach
                        </div>
                        @csrf
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text"
                                   placeholder="{{__('text.email')}}" name="email" autocomplete="off" required="">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last"
                                   type="password" placeholder="{{__('text.password')}}" name="password" required="">
                        </div>

                        <div class="m-login__form-action">
                            <button id="m_login_signin_submit" style="
                   border-color: #fff;
                        box-shadow: 0 0 black !important;
"
                                    class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary">
                                {{__('text.login')}}
                            </button>

                        </div>
                    </form>


                </div>

                <div class="m-login__account" style="margin-top: 110px">
                            <span class="m-login__account-msg">
                                {{date("Y")}}  &copy;
                            </span>&nbsp;&nbsp;

                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->

<!--begin::Global Theme Bundle -->
<script src="{{asset('style/js/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('style/js/scripts.bundle.js')}}" type="text/javascript"></script>
<script>
    $.validator.addMethod("valueNotEquals", function (value, element, arg) {
        return arg != value;
    }, "Value must not equal arg.");
    $('#m_form_1').validate({

        rules: {},
        messages: {// custom messages for radio buttons and checkboxes


            email: {
                required: " {{__('text.email_error_msg')}}",
                email: " {{__('text.email_cheack_msg')}}",

            },
            password: {
                required: " {{__('text.password_error_msg')}}",
                minlength: " {{__('text.password_minlength_msg')}}"

            },
        },
        invalidHandler: function (e, r) {
            $("#m_form_1_msg").removeClass("m--hide").show(), mUtil.scrollTop()
        },

        submitHandler: function (form) {

            form.submit();

        }

    });

</script>
<!--end::Global Theme Bundle -->

<!--begin::Page Scripts -->


<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
