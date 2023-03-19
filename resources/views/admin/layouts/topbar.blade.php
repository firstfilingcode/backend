<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
               <a href="{{url('home')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo-dark.png')}}" alt="" height="20">
                    </span>
                </a>

                <a href="{{url('home')}}"  class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo-light.png')}}" alt="" height="20">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

           
        </div>

        <div class="d-flex">
<?php /*
         
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="uil-bell"></i>
                    <span class="badge badge-danger badge-pill">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-16"> @lang('translation.Notifications') </h5>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small"> @lang('translation.Mark_read')</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="uil-cart"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">@lang('translation.order_placed')</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">@lang('translation.languages_grammar')</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> @lang('translation.3_min_ago')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <img src="{{ URL::asset('assets/images/users/avatar-3.jpg')}}"
                                    class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">James Lemire</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">@lang('translation.simplified_English')</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> @lang('translation.1_hours_ago')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="uil-truck"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">@lang('translation.item_shipped')</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">@lang('translation.languages_grammar')</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> @lang('translation.3_min_ago')</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <img src="{{ URL::asset('assets/images/users/avatar-4.jpg')}}"
                                    class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Salena Layfield</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">@lang('translation.simplified_English')</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> @lang('translation.1_hours_ago')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                            <i class="uil-arrow-circle-right mr-1"></i> @lang('translation.View_More')..
                        </a>
                    </div>
                </div>
            </div>
*/?>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    
                    <img class="rounded-circle header-profile-user" src="{{ logo()}}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ml-1 font-weight-medium font-size-15">{{Auth::user()->name}}</span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ URL('admin/change_password') }}"><i class="uil uil-user-circle font-size-18 align-middle text-muted mr-1"></i> <span class="align-middle">Change Password</span></a>
                    
                    <a class="dropdown-item d-block" href=""><i class="uil uil-cog font-size-18 align-middle mr-1 text-muted"></i> <span class="align-middle">@lang('translation.Settings')</span> <span class="badge badge-soft-success badge-pill mt-1 ml-2">03</span></a>
                    
                    <a class="dropdown-item" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="uil uil-sign-out-alt font-size-18 align-middle mr-1 text-muted"></i> <span class="align-middle">@lang('translation.Sign_out')</span></a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
	<?php /*
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="uil-cog"></i>
                </button>
            </div>*/?>
            
        </div>
    </div>
</header>