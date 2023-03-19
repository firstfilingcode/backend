@extends('admin.layouts.app')
@section('title') @lang('translation.Dashboard') @endsection
@section('content')
<div class="content-wrapper mt-3">
   <section class="content ">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12 col-md-12">
               <div class="card card-outline card-orange">
                  <div class="card-header bg-primary">
                     <h3 class="card-title"><i class="fa fa-home"></i> &nbsp;Ca Dashboard</h3>
                     <div class="card-tools">
                        <!--<a href="https://www.school.rukmanisoftware.com/add_user" class="btn btn-primary  btn-sm" title="Add User"><i class="fa fa-plus"></i> Add User</a>-->
                     </div>
                  </div>
               </div>
            </div>
         </div>
        <div class="row">
                                  @php
                                    $order = DB::table('order_details')->where('ca_user_id',Auth::user()->id)->count();;
                                    @endphp
                                    <div class="col-12 col-sm-6 col-md-3">
                                       
                                      
                                          <div class="info-box mb-3 text-dark">
                                             <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-first-order"></i></span>
                                             <div class="info-box-content">
                                                 <button type="submit" class="info-box-text btn-none"> Total Orders  </button>
                                                <span class="info-box-number">{{$order ?? ''}}</span>
                                             </div>
                                          </div>
                                          
                                    </div>
                                     @php
                                        $panding_order = DB::table('order_details')->where('ca_approval_status',0)->where('ca_user_id', Auth::user()->id)->count();
                                    @endphp
                                  <div class="col-12 col-sm-6 col-md-3">
                                  <form id="quickForm" action="{{url('admin/ca_find_orders')}}"   method="POST" enctype="multipart/form-data">
                                          @csrf
                                       <input type="hidden" name="ca_user_id" value="{{Auth::user()->id}}">
                                       <input type="hidden" name="tab_type" value="awaiting_acceptance">
                                      <div class="info-box mb-3 text-dark">
                                         <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-bullhorn"></i></span>
                                         <div class="info-box-content">
                                              <button type="submit" class="info-box-text btn-none" {{ (user()->click_permission == 1) ? 'disabled' : '' }}>  Awaiting Acceptance Order. </button>
                                              <span class="info-box-number">{{$panding_order ?? ''}}</span>
                                         </div>
                                      </div>
                                   </form>
                                </div>
                                @php
                                    $under = DB::table('order_details')->whereNotIn('order_details.status',[1,13])->where('ca_user_id', Auth::user()->id)->count();
                                @endphp
                                 <div class="col-12 col-sm-6 col-md-3">
                                    <form id="quickForm" action="{{url('admin/ca_find_orders')}}"   method="POST" enctype="multipart/form-data">
                                          @csrf
                                       <input type="hidden" name="ca_user_id" value="{{Auth::user()->id}}">
                                       <input type="hidden" name="tab_type" value="active_order">
                                      <div class="info-box mb-3 text-dark">
                                         <span class="info-box-icon bg-success elevation-1"><i class="fa fa-font-awesome"></i></span>
                                         <div class="info-box-content">
                                              <button type="submit" class="info-box-text btn-none" {{ (user()->click_permission == 1) ? 'disabled' : '' }}>Active Order  </button>
                                            <span class="info-box-number">{{$under ?? ''}}</span>
                                         </div>
                                      </div>
                                   </form>
                                </div>
                                 @php
                                    $caseOnHold = DB::table('order_details')->where('status',23)->where('ca_user_id', Auth::user()->id)->count();
                                @endphp
                                 <div class="col-12 col-sm-6 col-md-3">
                                    <form id="quickForm" action="{{url('admin/ca_find_orders')}}"   method="POST" enctype="multipart/form-data">
                                          @csrf
                                       <input type="hidden" name="tab_type" value="Caseonhold">
                                      <div class="info-box mb-3 text-dark">
                                         <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
                                         <div class="info-box-content">
                                              <button type="submit" class="info-box-text btn-none" {{ (user()->click_permission == 1) ? 'disabled' : '' }}>  Case On Hold  </button>
                                            <span class="info-box-number">{{$caseOnHold ?? ''}}</span>
                                         </div>
                                      </div>
                                   </form>
                                </div>
                                 @php
                                    $total_order = DB::table('order_details')->where('status',13)->where('ca_user_id', Auth::user()->id)->count();
                                @endphp
                                 <div class="col-12 col-sm-6 col-md-3">
                                    <form id="quickForm" action="{{url('admin/ca_find_orders')}}"   method="POST" enctype="multipart/form-data">
                                          @csrf
                                       <input type="hidden" name="ca_user_id" value="{{Auth::user()->id}}">
                                       <input type="hidden" name="tab_type" value="workdone">
                                      <div class="info-box mb-3 text-dark">
                                         <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
                                         <div class="info-box-content">
                                              <button type="submit" class="info-box-text btn-none" {{ (user()->click_permission == 1) ? 'disabled' : '' }}>  Work Done.  </button>
                                            <span class="info-box-number">{{$total_order ?? ''}}</span>
                                         </div>
                                      </div>
                                   </form>
                                </div>
                                
                           

             <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.ca_find_orders')}}" class="{{ (user()->click_permission == 1) ? 'disabled' : '' }}" >
                  <div class="info-box mb-3 text-dark">
                     <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total Payment</span>
                        <span class="info-box-number">0</span>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.ca_find_orders')}}" class="{{ (user()->click_permission == 1) ? 'disabled' : '' }}">
                  <div class="info-box mb-3 text-dark">
                     <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total Paid Payment</span>
                        <span class="info-box-number">0</span>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.ca_find_orders')}}" class="{{ (user()->click_permission == 1) ? 'disabled' : '' }}">
                  <div class="info-box mb-3 text-dark">
                     <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total UnPaid Payment</span>
                        <span class="info-box-number">0</span>
                     </div>
                  </div>
               </a>
            </div>
        </div>
        
   </section>
</div>

@endsection