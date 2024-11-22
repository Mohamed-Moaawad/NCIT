@extends('admin.layout.app')
@section('title',  __('text.m_setting'))
@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator"> {{__('text.m_setting')}} </h3>
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
                                <span class="m-nav__link-text"> {{__('text.m_setting')}}</span>
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
                                {{__('text.m_setting')}}<span style='font-size:8px;color: #9a9caf;
                                                          padding: 20px;'>
                            </span>
                            </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right"
                      method="post" id="m_form_1"
                      enctype="multipart/form-data"
                      action="{{route('admin.usersetting.update')}}"
                      role="form">
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

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">     {{__('text.name')}}
                            </label>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <input type="text" class="form-control m-input m-input--air m-input--pill"
                                       name="name" placeholder=" {{__('text.name')}}  "
                                       required="" value="{{$setting->company_name}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">     {{__('text.registration_no')}}
                            </label>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <input type="text" class="form-control m-input m-input--air m-input--pill"
                                       name="registration_no"  placeholder=" {{__('text.registration_no')}}  "
                                       required="" value="{{$setting->registration_no}}">
                            </div>
                        </div>
                            <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">     {{__('text.tax_number')}}
                            </label>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <input type="number" class="form-control m-input m-input--air m-input--pill"
                                       name="tax_number"  placeholder=" {{__('text.tax_number')}}  "
                                       required="" value="{{$setting->tax_number}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">     {{__('text.address')}}
                            </label>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <textarea class="form-control m-input m-input--air m-input--pill"
                                          rows="7"     name="address"  placeholder=" {{__('text.address')}}  "
                                          required="" >{{$setting->address}}</textarea>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">     {{__('text.img')}}
                            </label>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <input type="file" class="form-control m-input m-input--air m-input--pill"
                                       name="img" placeholder=" {{__('text.img')}}  "
                                       onchange="loadFile(event)">
                                <img id="output" src="{{url('img/'.$setting->company_img)}}" style="
                                 width: 20%;
                                 "/>
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

            </div>



            </form>

            <!--end::Form-->
        </div>

        <!--end::Portlet-->
    </div>
    </div>
@endsection
@section('js')
    <!--begin::Page Scripts -->


    <script>
        var loadFile = function (event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>


    <script>
        $.validator.messages.required = '{{__('text.required')}}';
        $.validator.addMethod("valueNotEquals", function (value, element, arg) {
            return arg != value;
        }, "Value must not equal arg.");
        $('#m_form_1').validate({

            rules: {
                registration_no: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                },
            tax_number: {
                    required: true,
                    minlength: 15,
                    maxlength: 15,
                },

            },

            messages: {// custom messages for radio buttons and checkboxes

                registration_no: {
                    maxlength: " {{__('text.minlength_msg')}}",
                    minlength: " {{__('text.minlength_msg')}}"

                },

                tax_number: {
                    maxlength: " {{__('text.minlength_msg2')}}",
                    minlength: " {{__('text.minlength_msg2')}}"

                },

            },
            invalidHandler: function (e, r) {
                $("#m_form_1_msg").removeClass("m--hide").show(), mUtil.scrollTop()
            },

            submitHandler: function (form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('admin.usersetting.update')}}",
                    type: 'post',
                    data: new FormData(form),//formData,
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS
                    beforeSend: function () {
                        $('#loading').show();
                    },

                    success: function (data) {

                        $('#loading').hide();
                        toastr.info("{{__('text.update_ajax')}}");

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
                //  form.submit();

            }

        });


    </script>
    <script>
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::get('alert-'.$msg))
        toastr.info("{{ Session::get('alert-' . $msg) }}");
        @endif
        @endforeach

    </script>
    <!--end::Page Scripts -->
@endsection
