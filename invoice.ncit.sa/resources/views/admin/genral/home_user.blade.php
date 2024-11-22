@extends('admin.layout.app')

@section('css')
    <link href="{{asset('style/css/table.css')}}" rel="stylesheet" type="text/css"/>
    @endsection
@section('content')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('text.home')}} </h3>
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

                </ul>
            </div>
            <div>

            </div>
        </div>
    </div>


    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet ">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="container-fluid">
                    <div class="row">


                        <div class="col-lg-4 col-sm-6">
                            <div class="card-box bg-green">
                                <div class="inner">
                                    <h3 class="count">{{$clients}} </h3>
                                    <p> {{__('text.client')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card-box bg-orange">
                                <div class="inner">
                                    <h3 class="count">{{$items}} </h3>
                                    <p> {{__('text.items')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-file" aria-hidden="true"></i>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card-box bg-red">
                                <div class="inner">
                                    <h3 class="count">{{$invoices}} </h3>
                                    <p> {{__('text.invoices')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-file-invoice"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
   @if($invoices_reminder->count()>0)
            <table class="reminder">
                <h3 class="text-center">{{__('text.reminder_invoice')}}</h3>
                <thead>
                <tr>
                    <th scope="col">{{__('text.invoice_no')}}</th>
                    <th scope="col">{{__('text.sdate')}}</th>
                    <th scope="col">{{__('text.client')}}</th>
                    <th scope="col">{{__('text.total')}}</th>
                    <th scope="col">{{__('text.reminder_date')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices_reminder as $invoices)
                    <tr>
                        <td data-label="{{__('text.invoice_no')}}">{{$invoices->serial}}</td>
                        <td data-label="{{__('text.sdate')}}">{{$invoices->sdate}}</td>
                        <td data-label="{{__('text.client')}}">{{$invoices->client->name}}</td>
                        <td data-label="{{__('text.total')}}">
                           @php $total_all = 0;
                            foreach ($invoices->items as $item) {
                            $total_all = $total_all + ($item->total + $item->tax);
                            }

                            echo $total_all;

                            @endphp
                        </td>
                        <td data-label="{{__('text.reminder_date')}}">{{$invoices->reminder_date}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            @endif
            <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                <div class="m-demo__preview">
                    <div class="m-nav-grid">
                        <div class="m-nav-grid__row">
                            <a href="{{ Route('clients.index')}}" class="m-nav-grid__item">
                              <i class="m-nav-grid__icon flaticon-user-add"></i>
                                <span class="m-nav-grid__text"> {{__('text.add_client')}}</span>
                            </a>
                            <a href="{{ Route('items.index')}}" class="m-nav-grid__item">
                           <i class="m-nav-grid__icon flaticon-file"></i>
                                <span class="m-nav-grid__text"> {{__('text.add_item')}}</span>
                            </a>
                            <a href="{{ Route('admin.usersetting')}}" class="m-nav-grid__item">
                                <i class="m-nav-grid__icon flaticon-folder"></i>
                                <span class="m-nav-grid__text"> {{__('text.m_setting')}}</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    </script>
@endsection

