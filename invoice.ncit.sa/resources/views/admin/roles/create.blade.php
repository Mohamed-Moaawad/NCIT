@extends('admin.layout.app')
@section('title', __('text.roles'))
@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">{{__('text.roles')}}</h3>
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
                                <span class="m-nav__link-text">{{__('text.add_role')}}</span>
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

            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{__('text.roles')}}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">


                            <li class="m-portlet__nav-item"></li>

                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <!--begin: Datatable -->
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    {!! Form::open(array('route' => 'roles.store','method'=>'POST','id'=>'GForm')) !!}
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <strong>{{__('text.name')}}</strong>
                                {!! Form::text('name', null, array('placeholder' => __('text.name'),
'                            class' => 'form-control  m-input m-input--air m-input--pill')) !!}
                            </div>
                        </div>
                    </div>
                    <strong>{{__('text.permissions')}}</strong>
                    <br/>
                    <br/>
                        <div class="row">
                            <div class="form-group  ">

                                @php
                                    $c = 0;
                                    $ch_cat=0;
                                     $chkcat=0;
                                @endphp

                                @foreach($permission as $value)
                                    @if( $value->cat!=$ch_cat)
                            </div>
                            @endif

                                @php $ch_cat= $value->cat
                                @endphp
                                   @if($ch_cat!=$chkcat)
                                    <div class="col-xs-4 col-sm-4 col-md-4 permissionBox">
                                        {{ $value->cat_name }}
                                        <br>
                                        <br>
                                    @endif
                                    <label
                                        class="permission">{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                        {{ $value->name_ar}}</label>
                                    <br/>

                                    @php
                                        $c++;
                                        $chkcat=$value->cat;
                                    @endphp
                                    @endforeach
                                    <span id="check-error"></span>
                                </div>
                        </div>
                    <br>
                    <br>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-warning">{{__('text.add')}}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <!-- END EXAMPLE TABLE PORTLET-->
        </div>


    </div>
@endsection
@section('js')
    <script>
        $.validator.messages.required = '{{__('text.required')}}';
        if ($("#GForm").length > 0) {
            $("#GForm").validate({
                rules: {
                    name: {
                        required: true


                    },
                    'permission[]': {
                        required: true

                    },

                },
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "permission[]") {
                        error.appendTo("#check-error");
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    console.log($('#role').val());
                    $('#loading').show();
                    $.ajax({
                        data: $('#GForm').serialize(),
                        url: "{{route('roles.store')}}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            $('#loading').hide();
                            toastr.info("{{__('text.add_ajax')}}");
                            window.location.href = "{{route('roles.index')}}";
                            $('#GForm').trigger("reset");
                            $('#ajax-crud-modal').modal('hide');
                            $('#btn-save').html('{{__('text.save_done')}}');
                        },
                        error: function (data) {
                            $('#loading').hide();

                            console.log('Error:', data);

                            var dt = '';
                            $.each(data.responseJSON.errors, function (key, value) {
                                dt = dt + '<li>' + value + '</li>';
                            });

                            toastr.error(dt);
                        }
                    });
                }
            })
        }


    </script>

@endsection

