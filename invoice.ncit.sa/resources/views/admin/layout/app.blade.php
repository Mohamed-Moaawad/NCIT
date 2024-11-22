<!DOCTYPE html>


<html lang="{{App::getLocale()}}">

<!-- begin::Head -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title> @if(Auth::user()->type==1)
        {{$title->name}}
        @else
            {{$title->name.'-'.Auth::user()->company_name}}
   @endif
        @yield('title')</title>
    <meta name="description" content="Actions example page">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">


    <!--begin::Global Theme Styles -->

    @if (App::isLocale('ar'))
        <link href="{{asset('style/css/vendors.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>


        <link href="{{asset('style/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('style/css/datatables.bundle.rtl.css')}}" rel="stylesheet"
              type="text/css"/>-->
    @elseif (App::isLocale('en'))
        <link href="{{asset('style/css/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('style/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('style/css/datatables.bundle.css')}}" rel="stylesheet"
              type="text/css"/>-->
    @endif

    <link href="{{asset('style/css/'.$title->color.'?v=49')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('style/css/sweetalert.css')}}" rel="stylesheet" type="text/css"/>

    <!--end::Global Theme Styles -->
    <link rel="shortcut icon" href="{{asset('img/'.$title->img)}}"/>

    @yield('css')
    <style>


        .m-aside-menu .m-menu__nav > .m-menu__item {
            position: relative;
            margin: 0;
            border-bottom: .5px solid #444242;
        }
.m-topbar .m-topbar__nav.m-nav>.m-nav__item>.m-nav__link .m-topbar__userpic img {

    max-width: 58px !important
}

    </style>
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body
    class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<main>
    <div class="cd-index cd-main-content">
        <div>

            <!-- your content here -->
        </div>
    </div>
</main>
<div class="cd-cover-layer"></div> <!-- this is the cover layer -->

<div class="cd-loading-bar"></div> <!-- this is the loading bar -->
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">

    <!-- BEGIN: Header -->
    <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">

                <!-- BEGIN: Brand -->
                <div class="m-stack__item m-brand  m-brand--skin-dark ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="{{route('home')}}" class="m-brand__logo-wrapper" style='font-size:14px'>

                                <img src="{{asset('img/'.$title->img)}}"class="img-fluid">
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">

                            <!-- BEGIN: Left Aside Minimize Toggle -->
                            <a href="javascript:;" id="m_aside_left_minimize_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                                <span></span>
                            </a>

                            <!-- END -->

                            <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                            <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>

                            <!-- END -->


                            <!-- BEGIN: Topbar Toggler -->
                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>

                            <!-- BEGIN: Topbar Toggler -->
                        </div>
                    </div>
                </div>

                <!-- END: Brand -->
                <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">


                    <div id="m_header_menu"
                         class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
                        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                            <li class="m-menu__item   m-menu__item--rel"
                            ><a href="{{route('home')}}" class="m-menu__link m-menu__toggle">
                              <span class="m-menu__link-text "
                                    style="    font-size: 2.07rem;">   {{$title->name}}</span></a>

                            </li>

                        </ul>
                    </div>
                    <!-- BEGIN: Topbar -->
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">


                                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                    m-dropdown-toggle="click">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
                                                <span class="m-topbar__userpic">
                                                    <img src="{{asset('img/'.Auth::user()->img)}}"
                                                         class="m--img-rounded m--marginless" alt=""/>
                                                </span>

                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span
                                            class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center"
                                                 style="background: url({{asset('img/user_profile_bg.jpg')}}); background-size: cover;">
                                                <div class="m-card-user m-card-user--skin-dark">
                                                    <div class="m-card-user__pic">
                                                        <img
                                                            src="{{asset('img/'.Auth::user()->img)}}"
                                                            class="m--img-rounded m--marginless img-fluid" alt=""/>


                                                    </div>
                                                    <div class="m-card-user__details">
                                                        <span
                                                            class="m-card-user__name m--font-weight-500">{{Auth::user()->fname }} </span>
                                                        <a href=""
                                                           class="m-card-user__email m--font-weight-300 m-link">{{Auth::user()->email }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav m-nav--skin-light">

                                                        @if (App::isLocale('ar'))
                                                            <li class="m-nav__item">
                                                                <a href="{{route('admins.lang','en') }}"
                                                                   class="m-nav__link">
                                                                    <span class="m-nav__link-text">En  </span>
                                                                </a>
                                                            </li>
                                                        @elseif (App::isLocale('en'))
                                                            <li class="m-nav__item">
                                                                <a href="{{route('admins.lang','ar') }}"
                                                                   class="m-nav__link">
                                                                    <span class="m-nav__link-text">Ar  </span>
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li class="m-nav__item">
                                                                <a href="{{route('admins.lang','en') }}"
                                                                   class="m-nav__link">
                                                                    <span class="m-nav__link-text">En  </span>
                                                                </a>
                                                            </li>
                                                        @endif


                                                        <li class="m-nav__separator m-nav__separator--fit">
                                                        </li>
                                                        <li class="m-nav__item">


                                                            <a class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder"
                                                               href="{{ route('logout') }}"
                                                               onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                                {{__('text.logout')}}
                                                            </a>


                                                            <form id="logout-form" action="{{ route('logout') }}"
                                                                  method="POST" style="display: none;">
                                                                @csrf
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <!-- END: Topbar -->
                </div>
            </div>
        </div>
    </header>

    <!-- END: Header -->

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i
                class="la la-close"></i></button>
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
            @if(Auth::user()->type==1)
                @include('admin.layout.menu')
            @else
                @include('admin.layout.menu_user')
            @endif

        </div>
    @yield('content')
    <!-- END: Left Aside -->

    </div>

    <!-- end:: Body -->

    <!-- begin::Footer -->
    <footer class="m-grid__item		m-footer ">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                            <span class="m-footer__copyright">
                                {{$title->name }} {{date("Y")}}  &copy;
                            </span>
                </div>

            </div>
        </div>
    </footer>

    <!-- end::Footer -->
</div>

<!-- end:: Page -->


<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>

<!-- end::Scroll Top -->


<!--begin::Global Theme Bundle -->
<script src="{{asset('style/js/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('style/js/scripts.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('style/js/sweetalert.min.js')}}"></script>
<script src="{{asset('style/js/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('style/js/paginations.js?v=2')}}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<script>

</script>
@yield('js')
</body>

<!-- end::Body -->
</html>
