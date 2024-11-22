<!-- BEGIN: Aside Menu -->

<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1"
     m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">

    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <li class="m-menu__item " aria-haspopup="true"><a href="{{route('home')}}" class="m-menu__link ">
                <i class="m-menu__link-icon fa 	fa-home"></i>
                <span class="m-menu__link-title"> <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">{{__('text.home')}}</span>
            </a></li>

        <li class="m-menu__item " aria-haspopup="true">
            <a href="{{ Route('users.index')}}" class="m-menu__link ">
                <i class="m-menu__link-icon fa fa-user-cog"></i>
                <span class="m-menu__link-text">{{__('text.admins')}}</span>
            </a></li>



        <li class="m-menu__item " aria-haspopup="true">
            <a href="{{ Route('admin.setting')}}" class="m-menu__link ">
                <i class="m-menu__link-icon fa fa-cogs"></i>
                <span class="m-menu__link-text"> {{__('text.m_setting')}}</span>
            </a></li>

        <li class="m-menu__item " aria-haspopup="true">
            <a href="{{route('admin.changePassword') }}" class="m-menu__link ">
                <i class="m-menu__link-icon fa fa-passport"></i>
                <span class="m-menu__link-text"> {{__('text.change_password')}}</span>
            </a></li>
    </ul>


</div>

<!-- END: Aside Menu -->
