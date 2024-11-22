@extends('admin.layout.app')
@section('title',  __('text.clients'))
@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">{{__('text.clients')}}</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>


                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">{{__('text.clients')}}</span>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">{{__('text.clients')}}</span>
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
                            <h3 class="m-branches-text">
                                {{__('text.clients')}}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">

                                    <a href="javascript:void(0)" class="btn btn-warning mb-2" id="create-new-info">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>   {{__('text.add')}}</span>
                                </span></a>

                            </li>

                            <li class="m-portlet__nav-item">


                                <button  class="btn btn-warning mb-2 restore" id="retore">
                                <span>

                                    <span>   {{__('text.restore')}}</span>
                                </span></button>

                            </li>

                            <input type="date" class="form-control m-input m-input--air m-input--pill fdate"
                                   name="fdate" placeholder="{{__('text.date')}} "
                                   required="" >

                            <input type="date" class="form-control m-input m-input--air m-input--pil tdate"
                                   name="tdate" placeholder="{{__('text.date')}} "
                                   required="" >
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover " id="m_table_gz">
                        <thead>
                        <tr>

                            <th>{{__('text.number')}} </th>
                            <th>{{__('text.name')}}</th>
                            <th>{{__('text.email')}}</th>
                            <th>{{__('text.setting')}}</th>
                        </tr>
                        </thead>

                        <tbody id="info-crud">


                        </tbody>
                    </table>
                </div>
            </div>

            <!-- END EXAMPLE TABLE PORTLET-->
        </div>

        @include('admin.clients.modalClient')

    </div>
@endsection
@section('js')

    <script>
        $.validator.messages.required = '{{__('text.required')}}';
        $.validator.addMethod("valueNotEquals", function (value, element, arg) {
            return arg != value;
        }, "Value must not equal arg.");
        $('#m_table_gz').DataTable({
            "language": {
                "search": "{{__('text.search')}}",
                "lengthMenu": "{{__('text.rows')}}",
            },
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 ', '25 ', '50', '{{__('text.all')}}']
            ],
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '{{__('text.excel')}}',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {extend: 'pageLength', text: '{{__('text.pageLength')}}'},
                {extend: 'colvis', text: '{{__('text.colvis')}}'},

            ],
            "responsive": true,
            ajax: {
                url: "{{ route('clients.index') }}",
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'action',
                    name: '{{__('text.setting')}}',
                    orderable: false
                }
            ]
        });


        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /*  When info click add  button */
            $('#create-new-info').click(function () {
                $('#btn-save').val("create");
                $('#GForm').trigger("reset");
                $('.modal-footer').show();
                $(".hide").fadeIn().css("display", "none");
                $('#infoCrudModal').html("{{__('text.add_client')}}");
                $('#ajax-crud-modal').modal('show');
                $("#GForm input").prop("disabled", false);
                $("#GForm button").prop("disabled", false);
                $("#GForm select").prop("disabled", false);
                $('#btn-save').html('{{__('text.save')}}');
                $('#info_id').val('');
            });

            /* When click edit  */
            $('body').on('click', '#edit-info', function () {
                var info_id = $(this).data('id');
                $.get($(this).attr('value'), function (data) {
                    $('#btn-save').html('{{__('text.save')}}');
                    $("#GForm").validate().resetForm();
                    $('.modal-footer').show();
                    $('#infoCrudModal').html("{{__('text.update_client')}}");
                    $('#btn-save').val("edit");
                    $('#ajax-crud-modal').modal('show');
                    $('#info_id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#mobile').val(data.mobile);
                    $('#address').val(data.address);
                    $('#btn-save').html('{{__('text.save')}}');
                    $("#GForm input").prop("disabled", false);
                    $("#GForm button").prop("disabled", false);
                    $("#GForm select").prop("disabled", false);
                })
            });

            /* When click show  */
            $('body').on('click', '#show-info', function () {
                var info_id = $(this).data('id');
                $.get($(this).attr('value'), function (data) {
                    $('#btn-save').html('{{__('text.save')}}');
                    $("#GForm").validate().resetForm();
                    $('#infoCrudModal').html("{{__('text.show')}}");
                    $('#btn-save').val("edit");
                    $('#ajax-crud-modal').modal('show');
                    $('#info_id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#mobile').val(data.mobile);
                    $('#address').val(data.address);
                    $('.modal-footer').hide();
                    $("#GForm input").prop("disabled", true);
                    $("#GForm button").prop("disabled", true);
                    $("#GForm select").prop("disabled", true);
                    $('#btn-save').html('{{__('text.save')}}');
                })
            });

        });

        if ($("#GForm").length > 0) {
            $("#GForm").validate({
                rules: {



                },
                messages: {// custom messages for radio buttons and checkboxes


                },
                submitHandler: function (form) {
                    var actionType = $('#btn-save').val();
                    $('#loading').show();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    $.ajax({
                        data: new FormData(form),
                        url: "{{route('clients.store')}}",
                        type: "POST",
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        dataType: 'json',
                        success: function (data) {
                            $('#loading').hide();


                            if (actionType == "create") {


                                toastr.info("{{__('text.add_ajax')}}");
                            } else {


                                toastr.info("{{__('text.update_ajax')}}");
                            }

                            var oTable = $('#m_table_gz').dataTable();
                            oTable.fnDraw(false);

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

    <script>
        $('#m_table_gz tbody').on('click', '.delete-post-link', function (e) {
            var that = this;

            swal({
                    title: "{{__('text.delete')}}",
                    text: "{{__('text.delete_qu')}} {{__('text.client')}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: '#DD6B55',
                    confirmButtonText: "{{__('text.yes')}}!",
                    cancelButtonText: "{{__('text.no')}}!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {


                        $.ajax({
                            url: $(that).attr('value'),
                            method: 'delete',
                            data: {
                                _token: $(that).data('token')
                            },
                            success: function (data) {


                                swal("{{__('text.delete_swal')}} !", "{{__('text.delete_swal')}}.", "success");

                                $(that).closest('tr').remove();


                            }

                        });
                    } else {
                        //   t=1;
                        swal("{{__('text.delete_swal_cancel')}} ", "{{__('text.delete_swal_cancel')}}", "error");


                    }
                }
            );


        });
        $('.m-portlet__nav-item').on('click', '.restore', function (e) {
            var that = this;

            swal({
                    title: "{{__('text.restore')}}",
                    text: "{{__('text.restore_msg')}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: '#DD6B55',
                    confirmButtonText: "{{__('text.yes')}}!",
                    cancelButtonText: "{{__('text.no')}}!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {


                        $.ajax({
                            url:  "{{route('clients.restore')}}",
                            method: 'get',
                            data: {
                                _token: $(that).data('token')
                            },
                            success: function (data) {


                                swal("{{__('text.done')}} !", "{{__('text.done')}}.", "success");
                                var oTable = $('#m_table_gz').dataTable();
                                oTable.fnDraw(false);



                            }

                        });
                    } else {

                        swal("{{__('text.cancel')}} ", "{{__('text.cancel')}}", "error");


                    }
                }
            );


        });
        $('#m_table_gz tbody').on('click', '.rep', function (e) {

         //   window.location.replace( $(this).attr('value')+'/'+$('.fdate').val()+'/'+$('.tdate').val());
            window.open($(this).attr('value')+'/'+$('.fdate').val()+'/'+$('.tdate').val(), '_blank');




        });
    </script>

@endsection
