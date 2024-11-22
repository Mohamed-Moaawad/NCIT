@extends('admin.layout.app')
@section('title',  __('text.change_password'))

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">  {{__('text.change_password')}} </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">{{__('text.home')}}</span>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">{{__('text.change_password')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div>

                </div>
            </div>
        </div>

        <!-- END: Subheader -->
        <div class="m-content">

            <!--begin::Portlet-->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{__('text.change_password')}}
                            </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right"
                      method="post" id="m_form_1"
                      enctype="multipart/form-data"
                      action="{{route('admin.changePass')}}" role="form">
                    <div class="m-form__content">
                        <div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="m_form_1_msg">
                            <div class="m-alert__icon">
                                <i class="la la-warning"></i>
                            </div>
                            <div class="m-alert__text">
                                {{__('text.alert__text')}}
                            </div>
                            <div class="m-alert__close">
                                <button type="button" class="close" data-close="alert" aria-label="Close">
                                    <i class="la la-close"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @csrf
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
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>خطأ!</strong> هناك مشكلة في الاتي.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">       {{__('text.old_password')}}
                            </label>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <input type="password" class="form-control m-input m-input--air m-input--pill"
                                       name="old_password" placeholder="    {{__('text.old_password')}} "
                                       required="" >
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">       {{__('text.new_password')}}
                            </label>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <input type="password" class="form-control m-input m-input--air m-input--pill"
                                       name="pass" placeholder="    {{__('text.new_password')}} "
                                       required="">
                            </div>
                        </div>


                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions">
                            <div class="row">
                                <div class="col-lg-9 ml-lg-auto">
                                    <button type="submit" class="btn btn-warning">  {{__('text.update')}}</button>
                                    <button type="reset" class="btn btn-secondary">  {{__('text.cancel')}}</button>
                                    <div id="loading" style="display: none">
                                        <p><img src="{{asset('img/ajax-loader.gif')}}"/></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!--end::Form-->
            </div>

            <!--end::Portlet-->
        </div>
    </div>

@endsection
@section('js')
    <script>
        $.validator.addMethod("valueNotEquals", function (value, element, arg) {
            return arg != value;
        }, "Value must not equal arg.");
        $('#m_form_1').validate({

            rules: {
                pass: {
                    required: true,
                    minlength: 6


                },
                old_password: {
                    required: true,
                    minlength: 6


                },

            },
            messages: {// custom messages for radio buttons and checkboxes


                pass: {
                    required: " {{__('text.password_error_msg')}}",
                    minlength: " {{__('text.password_minlength_msg')}}"

                },
                old_password: {
                    required: " {{__('text.password_error_msg')}}",
                    minlength: " {{__('text.password_minlength_msg')}}"

                },
            },
            invalidHandler: function (e, r) {
                $("#m_form_1_msg").removeClass("m--hide").show(), mUtil.scrollTop()
            },

            submitHandler: function (form) {
                var _token = $("input[name='_token']").val();
                var password = $("input[name='pass']").val();
                var old_password = $("input[name='old_password']").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('admin.changePass')}}",
                    type: 'post',
                    data: {_token: _token, pass: password,old_password: old_password},
                    beforeSend: function () {
                        $('#loading').show();
                    },


                    success: function (data) {

                        $('#loading').hide();
                        if (data==1)
                        toastr.info("{{__('text.update_ajax')}}");
                        else
                            toastr.error("{{__('text.old_password_error')}}");

                        $('#m_form_1')[0].reset();
                    },
                    error: function (data) {
                        $('#loading').hide();
                        console.log(data);
                        var dt = '';
                        $.each(data.responseJSON.errors, function (key, value) {
                            dt = dt + '<li>' + value + '</li>';
                        });

                        toastr.error(dt);


                    }
                });
                // form.submit();

            }

        });


    </script>
@endsection
