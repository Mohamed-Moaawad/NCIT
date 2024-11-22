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
                                <span class="m-nav__link-text">{{__('text.roles')}}</span>
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

                            <li class="m-portlet__nav-item">
                                <a href="{{ Route('roles.create')}}" class="btn btn-warning mb-2" id="create-new-info">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>   {{__('text.add')}}</span>
                                </span></a>


                            </li>

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


                    <table class="table table-striped- table-bordered table-hover " id="m_table_gz">
                        <thead>
                        <tr>
                            <th>{{__('text.number')}} </th>
                            <th>{{__('text.name')}}</th>
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
                url: "{{ route('roles.index') }}",
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: '{{__('text.setting')}}',
                    orderable: false
                }
            ]
        });


    </script>

    <script>
        $('#m_table_gz tbody').on('click', '.delete-post-link', function (e) {
            var that = this;

            swal({
                    title: "{{__('text.delete')}}",
                    text: "{{__('text.delete_qu')}} {{__('text.role')}}",
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
    </script>

@endsection
