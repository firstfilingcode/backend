<script src="{{URL::asset('public/assets/accounts/js/jquery2.js')}}"></script>

<nav class="main-header navbar navbar-expand navbar-white navbar-light p-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item ml-1">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block pt-2">
            <!--<a href="{{url('admin/home')}}" class="nav-link">-->{{Auth::user()->name }} ({{getRoleName(Auth::user()->role_id)->name ?? ''}})<!--</a>-->
        </li>
        <li class="nav-item d-none d-sm-inline-block pt-2" style="padding-left: 130px;">
        <spam id="date" class="date"></spam> <spam id="time" class="time"></spam></a>
      </li>


    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fa fa-search"></i>
            </a>
            <div class="navbar-search-block">

                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" onkeyup="SearchValue()" id="name" name="name"
                        type="search" placeholder="Search" aria-label="Search" value="">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </li>
        @php
        if(Auth::user()->role_id == 1){
                $order = DB::table('order_details')->where('admin_new_order',1)->where('payment_status',1)->count();
                         $orderView = DB::table('order_details')->select('order_details.*','services.name as service_name')
                          ->leftjoin('services','services.id','order_details.service_id')->where('admin_new_order',1)->where('payment_status',1)->get();
        }elseif(Auth::user()->role_id == 2){
       
                        $order = DB::table('order_details')->where('rm_new_order',1)->where('rm_user_id', Auth::user()->id)->where('payment_status',1)->count();

                         $orderView = DB::table('order_details')->select('order_details.*','services.name as service_name')
                          ->leftjoin('services','services.id','order_details.service_id')->where('rm_new_order',1)->where('payment_status',1)->where('rm_user_id', Auth::user()->id)->get();
        }else{
        $order = DB::table('order_details')->where('ca_new_order',1)->where('ca_user_id', Auth::user()->id)->where('payment_status',1)->count();

                         $orderView = DB::table('order_details')->select('order_details.*','services.name as service_name')
                          ->leftjoin('services','services.id','order_details.service_id')->where('ca_new_order',1)->where('payment_status',1)->where('ca_user_id', Auth::user()->id)->get();
        }
                                   
                                    @endphp
   <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-bell"></i>
            <span class="badge badge-danger navbar-badge">{{$order ?? ''}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @if( count($orderView) > 0)
                    @foreach($orderView as $orde)
                    @if(Auth::user()->role_id == 3)
               <a href="{{url('admin/ca_view_order')}}/{{$orde->id}}" class="dropdown-item">
                @else
                <a href="{{url('admin/order_edit')}}/{{$orde->id}}" class="dropdown-item">
                @endif
                <div class="media">
                    <div class="media-body">
                    <p class="text-sm">{{$orde->service_name ?? ''}}</p>
                    <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> {{$orde->created_at ?? ''}}</p>
                    </div>
                </div>
            </a>
            <div class="dropdown-divider"></div>
            @endforeach
            @else
            <a  class="dropdown-item">
                <div class="media">
                    <div class="media-body">
                    <p class="text-sm">No Order Found</p>
                    </div>
                </div>
            </a>
                @endif
           <!-- <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>-->
            </div>
            </li>
        <!-- Navbar Search -->

        <li class="nav-item dropdown mt-2">
            <a href="" id="refresh" class="text-white btn btn-success btn-xs" onclick="reloadThePage()">Refresh!</a>
        </li>
        &nbsp;
        &nbsp;
     



        <li class="nav-item dropdown">
            <a class="nav-link user-panel" data-toggle="dropdown" href="#">
                <img src="{{ env('IMAGE_SHOW_PATH').'profile/'.Auth::user()->photo }}"
                    class="img-circle elevation-2"
                    >
               
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


                <div class="row border-bottom mr-0">
                    <div class="col-md-12 text-center">
                        <img class=""
                            src="{{ env('IMAGE_SHOW_PATH').'profile/'.Auth::user()->photo }}"
                            >
                    </div>
                   
                </div>

                <a href="{{ URL('admin/profile') }}" class="dropdown-item border-bottom">
                    <i class="fa fa-user mr-2"></i>Profile
                </a>
                
                 @if(Auth::user()->role_id == 3)
                <a href="{{ URL('#') }}" class="dropdown-item border-bottom"data-toggle="modal" data-target="#CASharePass">
                    <i class="fa fa-user mr-2"></i>Ca Permission
                </a>
                @endif
                
                <a href="{{ URL('admin/change_password') }}" class="dropdown-item border-bottom">
                    <i class="fa fa-key mr-2"></i>Change Password

                </a>
                

                <a class="dropdown-item" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="uil uil-sign-out-alt font-size-18 align-middle mr-1 text-muted"></i> <span class="align-middle"><i class="fa fa-sign-out mr-2"></i> @lang('translation.Sign_out')</span></a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>


            </div>
        </li>



    </ul>
</nav>

<input type="hidden" id="user_id" value="{{Auth::user()->id ?? ''}}">
<input type="hidden" id="ca_share_pass" value="{{Auth::user()->ca_share_pass ?? ''}}">
  
  <div class="modal fade" id="CASharePass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sp Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" placeholder="Ca Share Password" id="ca_password" name="ca_password">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="ca_share_close_btn" data-dismiss="modal">Close</button>
                <a class=" btn btn-warning text-white btn-sm" onclick="caFunction()">Submit</a>
            </div>
        </div>
    </div>
</div>


<style>

.navbar-white {
     /*background-color: #31638eed;*/
     color: #fff;
    /*background-image: linear-gradient(to bottom right, #4327ca, #00ffc378);*/
    background-image: linear-gradient(to bottom right, #3F51B5, #00C4B1);
            }
</style>




<script>
$(document).ready(function(){
 $("#open1").click(function(){

    if($("i").hasClass("fa fa-eye-slash")){
        $(".pass").attr('type','text');
        $("#hide").addClass('pass1');
        $("#hide").removeClass('fa fa-eye-slash');
        $("#show").removeClass('pass1');
        $("#show").addClass('fa fa-eye');
    }else{
        $(".pass").attr('type','password');
        $("#show").addClass('pass1');
        $("#show").removeClass('fa fa-eye');
        $("#hide").removeClass('pass1');
        $("#hide").addClass('fa fa-eye-slash');
    }
    
 });
 
});

</script>


  <script>
    var today = new Date();
var day = today.getDate();
var month = today.getMonth() + 1;

function appendZero(value) {
    return "0" + value;
}

function theTime() {
    var d = new Date();
    document.getElementById("time").innerHTML = d.toLocaleTimeString("en-US");
}

if (day < 10) {
    day = appendZero(day);
}

if (month < 10) {
    month = appendZero(month);
}

today = day + "-" + month + "-" + today.getFullYear();

document.getElementById("date").innerHTML = today;

var myVar = setInterval(function () {
    theTime();
}, 1000);

</script> 