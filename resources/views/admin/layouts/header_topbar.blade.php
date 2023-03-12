<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

    <!-- begin:: Header -->
    <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " >
			
        <!-- begin:: Header Menu -->
        <!-- Uncomment this to display the close button of the panel
        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
        -->

        {{-- Header Menu Wrapper --}}
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper"></div>

        <!-- begin:: Header Topbar -->
        <div class="kt-header__topbar">

            <div class="kt-header__topbar-item kt-header__topbar-item--user">    
                <div class="kt-header__topbar-wrapper" data-offset="0px,0px">
                    <div class="kt-header__topbar-user">
                        <a href="{{ Library::companyProfile()[0]->website }}" target="_blank">View Site</a>
                    </div>
                </div>
            </div>

            <div class="kt-header__topbar-item kt-header__topbar-item--user">    
                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                    <div class="kt-header__topbar-user">
                        <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                        <span class="kt-header__topbar-username kt-hidden-mobile">{{ ucwords(Auth::user()->name) }}</span>
                        <img class="kt-hidden" alt="Pic" src="{{ asset('admin/template/client/bg-1.png') }}" />
                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                        <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                    </div>
                </div>

                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                    <!--begin: Head -->
                    <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{ asset('admin/template/client/bg-1.png') }})">
                        <div class="kt-user-card__avatar">
                            <img class="kt-hidden" alt="Pic" src="{{ asset('admin/template/client/user-icon-gold.png') }}" />
                            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                            <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                        </div>
                        <div class="kt-user-card__name">
                            {{ ucwords(Auth::user()->name) }}
                        </div>
                        {{-- <div class="kt-user-card__badge">
                            <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
                        </div> --}}
                    </div>
                    <!--end: Head -->

                    <!--begin: Navigation -->
                    <div class="kt-notification">
                        <a href="{{ route('profile') }}" class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="flaticon2-calendar-3 kt-font-success"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    My Profile
                                </div>
                                <div class="kt-notification__item-time">
                                    Account settings and more
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('change.password') }}" class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="flaticon-lock kt-font-success"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    Change Password
                                </div>
                                <div class="kt-notification__item-time">
                                    Change or reset your account password
                                </div>
                            </div>
                        </a>
                        <div class="kt-notification__custom kt-space-between">
                            <a href="{{ route('logout') }}" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>    
                        </div>
                    </div>
                    <!--end: Navigation -->
                </div>
            </div>
            <!--end: User Bar -->	
        </div>
        <!-- end:: Header Topbar -->
    </div>
    <!-- end:: Header -->
