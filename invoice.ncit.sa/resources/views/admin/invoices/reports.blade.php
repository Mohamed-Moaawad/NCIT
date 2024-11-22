@extends('admin.layout.app')
@section('title',  __('text.report'))
@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">{{__('text.client_rep')}}</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>


                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">{{__('text.report')}}</span>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">{{__('text.report')}}</span>
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
                                {{__('text.report')}}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">


                            </li>
                            <li class="m-portlet__nav-item">




                            </li>
                            <li class="m-portlet__nav-item">




                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover " id="m_table_gz">
                        <thead>
                        <tr>

                            <th>{{__('text.number')}} </th>
                            <th>{{__('text.client')}}</th>
                            <th>{{__('text.invoice_no')}}</th>
                             <th>{{__('text.sdate')}}</th>
                            <th>{{__('text.total')}}</th>
                            <th>{{__('text.status')}}</th>
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
                url: "{{ route('rep') }}",
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {
                    data: 'client',
                    name: 'client'
                },
                {
                    data: 'serial',
                    name: 'serial'
                },
                 {
                    data: 'sdate',
                    name: 'sdate'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'status',
                    name: 'status'
                }

            ]
        });







    </script>


@endsection
