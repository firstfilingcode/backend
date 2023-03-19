@php
$getPermission = getPermission();
$allPermission = explode(',',$getPermission['sidebar_id']);
$allSubPermission = explode(',',$getPermission['sub_menu_id']);
 $sidebar = getSiderbar();
 
@endphp

<aside class="main-sidebar bg-light  elevation-4 ">
    <!-- Brand Logo -->
  <div>
    <a href="" class="brand-link">
        <img src="{{ env('IMAGE_SHOW_PATH').'/logo/'.setting()->logo }}" alt=""
            class="brand_image ">
        <span class="brand-text font-weight-light text-white"></span>
    </a>
    </div>
    <!--<a href="#" class="brand-link pt-0 pb-0" style="font-size: 1rem;" data-toggle="dropdown">
        <i class="fa fa-th text-white" style="padding: 0.5rem 0.5rem 0 1.3rem;"></i>
        <span class="brand-text text-white">Quick Links</span>
    </a>-->
    <div class="dropdown-menu quick-menu dropdown-menu-sm dropdown-menu-right text-left">
        <a href="#" class="dropdown-item dropdown-footer"><i class="fa fa-user-plus"></i>Details </a>

    </div>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if(!empty($sidebar))
            
              @foreach($sidebar as $data)
                 @foreach($allPermission as $permisnData)
                  @if($data['id'] == $permisnData)
                @php
                   $sub_sidebar = DB::table('sidebar_sub_menus')->where('sidebar_id',$data['id'])->get();
                   
                @endphp
                <li class="nav-item ">
                    @if($data['sub_menu'] == 0)
                        <a href="{{ url('admin/'.$data['url'])  }}" class="nav-link {{ (user()->click_permission == 1) ? 'disabled' : '' }}">
                        <i class="nav-icon fas 	{{$data['icon'] ?? ''}}"></i>
                        <p>{{$data['name'] ?? ''}}</p>
                    <a>
                    @else
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa {{$data['icon'] ?? ''}}"></i>
                        <p>
                            {{$data['name'] ?? ''}}
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    
                    <ul class="nav nav-treeview" style="display: none;">
                      
                        @foreach($sub_sidebar as $sub)
                        
                         @foreach($allSubPermission as $permisnSubData)
                         @if(!empty($permisnSubData > 0))
                             @if($sub->id == $permisnSubData)
                            <li class="nav-item">
                                <a href="{{url('admin/'.$sub->url )}}" class="nav-link {{ (user()->click_permission == 1) ? 'disabled' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p class="color_hover">{{$sub->name ?? ''}}</p>
                                </a>
                            </li>
                            @endif
                            @endif
                            @endforeach
                        @endforeach
                     
                    </ul>
                    @endif
                </li>
            @endif
             @endforeach    
         @endforeach
        @endif
                       <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas 	fa fa-asterisk"></i>
                        <p>
                            Role Management
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{url('admin/roles/create')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p class="color_hover">Create Account</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/roles')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon "></i>
                                <p class="color_hover">View Account</p>
                            </a>
                        </li>

                    </ul>
                </li>
          
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon 	fa fa-id-badge"></i>
                        <p>
                            Users Manag..
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{url('admin/users/create')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p class="color_hover">Create Account</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/users')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p class="color_hover">View Account</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon 	fa fa-cog"></i>
                        <p>
                            Web Settings
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                         <li class="nav-item">
                    <a href="{{url('admin/costumar')}}" class="nav-link">
                        <i class="nav-icon 	fa fa-handshake-o"></i>
                        <p class="color_hover">
                            Costumar Manag..
                            
                        </p>
                    </a>
                </li>

                
                <li class="nav-item">
                    <a href="{{url('admin/ca')}}" class="nav-link">
                        <i class="nav-icon fa fa-male nav-icon"></i>
                        <p>
                             CA Management
                        </p>
                    </a>
                    </li>
                 <li class="nav-item">
                    <a href="{{url('admin/service')}}" class="nav-link">
                        <i class="nav-icon fa fa-universal-access"></i>
                        <p>
                            Service Manag...
                        </p>
                    </a>
                    </li>
                  <li class="nav-item">
                    <a href="{{url('admin/rm')}}" class="nav-link">
                        <i class="nav-icon fa fa-user-circle-o"></i>
                        <p>
                           RM Management
                        </p>
                    </a>
                    </li>
                 <li class="nav-item">
                    <a href="{{url('admin/order')}}" class="nav-link">
                        <i class="nav-icon fa fa-first-order"></i>
                        <p>
                          Order
                        </p>
                    </a>
                    </li>
                 
                 
                 <li class="nav-item">
                    <a href="{{url('admin/wallet')}}" class="nav-link">
                        <i class="nav-icon 	fa fa-google-wallet"></i>
                        <p>
                          Wallet
                        </p>
                    </a>
                    </li>
                    
                <li class="nav-item">
                    <a href="{{url('admin/slider')}}" class="nav-link">
                        <i class="nav-icon 	fa fa-empire"></i>
                        <p>
                          Home Slider
                          
                        </p>
                    </a>
                    
                </li>
                
                <li class="nav-item">
                    <a href="{{url('admin/blog')}}" class="nav-link">
                        <i class="nav-icon 	fa fa-empire"></i>
                        <p>
                           Blog
                            
                        </p>
                    </a>
                   
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/offer')}}" class="nav-link">
                        <i class="nav-icon fa fa-angellist"></i>
                        <p>
                           Offers
                            
                        </p>
                    </a>
                    
                </li>
                
                <li class="nav-item">
                    <a href="{{url('admin/contacts')}}" class="nav-link">
                        <i class="nav-icon 	fa fa-empire"></i>
                        <p>
                           Contacts
                            
                        </p>
                    </a>
                    
                </li>
                
                <li class="nav-item">
                    <a href="{{url('admin/privacy_policy')}}" class="nav-link">
                        <i class="nav-icon 	fa fa-chain"></i>
                        <p>
                           Privacy Policy
                        </p>
                    </a>
                    
                </li>
                
                <li class="nav-item">
                    <a href="{{url('admin/terms_condition')}}" class="nav-link">
                        <i class="nav-icon fa fa-codiepie"></i>
                        <p>
                           Terms & Condition
                        </p>
                    </a>
                    
                </li>
                
                <li class="nav-item">
                    <a href="{{url('admin/faq')}}" class="nav-link">
                        <i class="nav-icon fa fa-gavel"></i>
                        <p>
                          Faq
                        </p>
                    </a>
                    
                </li>
                
                <li class="nav-item">
                    <a href="{{url('admin/refer_earn')}}" class="nav-link">
                        <i class="nav-icon fa fa-pied-piper-alt"></i>
                        <p>
                          Refer and Earn
                        </p>
                    </a>
                    
                </li>
                    </ul>
                </li>
                  <li class="nav-item">
                    <a href="{{url('admin/branch')}}" class="nav-link">
                        <i class="nav-icon 	fa fa-google-wallet"></i>
                        <p>
                          Branch
                        </p>
                    </a>
                    </li>
                <li class="nav-item">
                    <a href="{{url('admin/massage')}}" class="nav-link">
                        <i class="nav-icon 	fa fa-whatsapp"></i>
                        <p>
                          Messages
                        </p>
                    </a>
                    </li>
                <li class="nav-item">
                    <a href="{{url('admin/coupon')}}" class="nav-link">
                        <i class="nav-icon 	fa fa-odnoklassniki"></i>
                        <p>
                          Coupon Management
                        </p>
                    </a>
                    </li>
                <li class="nav-item">
                    <a href="{{url('admin/sales_department')}}" class="nav-link">
                        <i class="nav-icon 	fa fa-bullhorn"></i>
                        <p>
                          Sales department
                        </p>
                    </a>
                    </li>
                <li class="nav-item">
                    <a href="{{url('admin/expense')}}" class="nav-link">
                        <i class="nav-icon 	fa fa-rupee"></i>
                        <p>
                          Expense
                        </p>
                    </a>
                    </li>
                <li class="nav-item menu-open ">
                    <a href="{{url('admin/settings')}}" class="nav-link ">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>
-->
        
          
      
       
      

                <li class="nav-item menu-open ">

                    <a class="nav-link" href="javascript:void();"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fa fa-sign-out mr-2"></i>
                        <p>@lang('translation.Sign_out')</p>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <style>
        .brand_image {
    line-height: .8;
    margin-left: -0.2rem;
    margin-right: 0.5rem;
    margin-top: -3px;
    max-height: 113px;
    width: 136px;
    
  }
 
    </style>
</aside>