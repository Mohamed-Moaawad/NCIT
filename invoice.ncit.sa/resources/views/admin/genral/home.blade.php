@extends('admin.layout.app')


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
                        <div class="col-lg-3 col-sm-6">
                            <div class="card-box bg-blue">
                                <div class="inner">
                                    <h3 class="count"> {{$users}} </h3>
                                    <p> {{__('text.admins')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="card-box bg-green">
                                <div class="inner">
                                    <h3 class="count">{{$clients}} </h3>
                                    <p> {{__('text.client')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-money-bill" aria-hidden="true"></i>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card-box bg-orange">
                                <div class="inner">
                                    <h3 class="count">{{$items}} </h3>
                                    <p> {{__('text.items')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card-box bg-red">
                                <div class="inner">
                                    <h3 class="count">{{$invoices}} </h3>
                                    <p> {{__('text.invoices')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                <div class="m-demo__preview">
                    <div class="m-nav-grid">
                        <div class="m-nav-grid__row">
                            <a href="{{ Route('users.index')}}" class="m-nav-grid__item">
                              <i class="m-nav-grid__icon flaticon-user-add"></i>
                                <span class="m-nav-grid__text"> {{__('text.add_admin')}}</span>
                            </a>
                            <a href="{{ Route('admin.setting')}}" class="m-nav-grid__item">
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

