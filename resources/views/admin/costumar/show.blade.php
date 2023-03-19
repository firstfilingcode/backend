@extends('admin.layouts.app')
@section('title') @lang('translation.Dashboard') @endsection
@section('content')

<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">
                                <i class="fa fa-address-book-o"></i> &nbsp; {{ __('View Costumar') }}
                            </h3>
                            <div class="card-tools">
                               <!-- <a href="{{url('admin/rm/create')}}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-plus"></i>{{ __('Add') }}</a>-->
                                <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>
                        </div>

                        <div class="row m-2">
                            <div class="col-6">
                               <div class="card">
                                   <div class="card-header">
                                       <div class="col-md-12 text-center">
                                           <b>Your Details</b>
                                       </div>
                                   </div>
                                   <div class="card-body">
                                       <div class="row">
                                           <div class="col-md-4 mt-2">
                                               <b>Name :</b> 
                                           </div>
                                           <div class="col-md-8 mt-2">
                                              <b>{{$data['name'] ?? ''}} </b>
                                           </div>
                                           <div class="col-md-4 mt-2">
                                               <b>Mobile :</b> 
                                           </div>
                                           <div class="col-md-8 mt-2">
                                              <b>{{$data['mobile'] ?? ''}} </b>
                                           </div>
                                           <div class="col-md-4 mt-2">
                                               <b>Email :</b> 
                                           </div>
                                           <div class="col-md-8 mt-2">
                                              <b>{{$data['email'] ?? ''}} </b>
                                           </div>
                                           <div class="col-md-4 mt-2">
                                               <b>DOB :</b> 
                                           </div>
                                           <div class="col-md-8 mt-2">
                                              <b>{{$data['dob'] ?? ''}} </b>
                                           </div>
                                           <div class="col-md-4 mt-2">
                                               <b>Create Date :</b> 
                                           </div>
                                           <div class="col-md-8 mt-2">
                                              <b>{{ date('m/d/Y',strtotime($data->created_at)) }} </b>
                                           </div>
                                           <div class="col-md-4 mt-2">
                                               <b>Address :</b> 
                                           </div>
                                           <div class="col-md-8 mt-2">
                                              <b>{{$data['address'] ?? ''}} </b>
                                           </div>
                                           <div class="col-md-4 mt-2">
                                               <b>Status :</b> 
                                           </div>
                                           <div class="col-md-8 mt-2">
                                              <b>{{$data['status'] ?? ''}} </b>
                                           </div>
                                           <div class="col-md-4 mt-2">
                                               <b>Ca Share Pass :</b> 
                                           </div>
                                           <div class="col-md-8 mt-2">
                                              <b>{{$data['show_password'] ?? ''}}</b>
                                           </div>
                                       </div>
                                       
                                   </div>
                               </div>
                            </div>
                            <div class="col-6">
                                  <div class="row">
                                  @php
                                    $order = DB::table('order_details')->where('user_id',$data['id'])->count();;
                                    @endphp
                                    <div class="col-12 col-sm-6 col-md-6">
                                        
                                       
                                          <div class="info-box mb-3 text-dark">
                                             <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-first-order"></i></span>
                                             <div class="info-box-content">
                                                 <button type="submit" class="info-box-text btn-none"> Total Orders  </button>
                                                <span class="info-box-number">{{$order ?? ''}}</span>
                                             </div>
                                          </div>
                                        
                                    </div>
                                     @php
                                        $panding_order = DB::table('order_details')->where('status',1)->where('user_id', $data['id'])->count();
                                    @endphp
                                  <div class="col-12 col-sm-6 col-md-6">
                                  <form id="quickForm" action="{{url('admin/order')}}"   method="POST" enctype="multipart/form-data">
                                          @csrf
                                          <input type="hidden" name="email" value="{{$data['email']}}">
                                        <input type="hidden" name="mobile" value="{{$data['mobile']}}">
                                       <input type="hidden" name="user_id" value="{{$data['id']}}">
                                       <input type="hidden" name="tab_type" value="awaiting_acceptance">
                                      <div class="info-box mb-3 text-dark">
                                         <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-bullhorn"></i></span>
                                         <div class="info-box-content">
                                              <button type="submit" class="info-box-text btn-none">  Awaiting Acceptance Order. </button>
                                              <span class="info-box-number">{{$panding_order ?? ''}}</span>
                                         </div>
                                      </div>
                                   </form>
                                </div>
                                @php
                                    $under = DB::table('order_details')->whereNotIn('order_details.status',[1,23,24])->where('user_id', $data['id'])->count();
                                @endphp
                                 <div class="col-12 col-sm-6 col-md-6">
                                    <form id="quickForm" action="{{url('admin/order')}}"   method="POST" enctype="multipart/form-data">
                                          @csrf
                                          <input type="hidden" name="email" value="{{$data['email']}}">
                                        <input type="hidden" name="mobile" value="{{$data['mobile']}}">
                                       <input type="hidden" name="user_id" value="{{$data['id']}}">
                                       <input type="hidden" name="tab_type" value="active_order">
                                      <div class="info-box mb-3 text-dark">
                                         <span class="info-box-icon bg-success elevation-1"><i class="fa fa-font-awesome"></i></span>
                                         <div class="info-box-content">
                                              <button type="submit" class="info-box-text btn-none">Active Order  </button>
                                            <span class="info-box-number">{{$under ?? ''}}</span>
                                         </div>
                                      </div>
                                   </form>
                                </div>
                                 @php
                                    $caseOnHold = DB::table('order_details')->where('status',23)->where('user_id', $data['id'])->count();
                                @endphp
                                 <div class="col-12 col-sm-6 col-md-6">
                                    <form id="quickForm" action="{{url('admin/order')}}"   method="POST" enctype="multipart/form-data">
                                          @csrf
                                          <input type="hidden" name="email" value="{{$data['email']}}">
                                        <input type="hidden" name="mobile" value="{{$data['mobile']}}">
                                       <input type="hidden" name="tab_type" value="Caseonhold">
                                      <div class="info-box mb-3 text-dark">
                                         <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
                                         <div class="info-box-content">
                                              <button type="submit" class="info-box-text btn-none">  Case On Hold  </button>
                                            <span class="info-box-number">{{$caseOnHold ?? ''}}</span>
                                         </div>
                                      </div>
                                   </form>
                                </div>
                                 @php
                                    $total_order = DB::table('order_details')->where('status',24)->where('user_id', $data['id'])->count();
                                @endphp
                                 <div class="col-12 col-sm-6 col-md-6">
                                    <form id="quickForm" action="{{url('admin/order')}}"   method="POST" enctype="multipart/form-data">
                                          @csrf
                                          <input type="hidden" name="email" value="{{$data['email']}}">
                                        <input type="hidden" name="mobile" value="{{$data['mobile']}}">
                                       <input type="hidden" name="user_id" value="{{$data['id']}}">
                                       <input type="hidden" name="tab_type" value="workdone">
                                      <div class="info-box mb-3 text-dark">
                                         <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
                                         <div class="info-box-content">
                                              <button type="submit" class="info-box-text btn-none">  Work Done.  </button>
                                            <span class="info-box-number">{{$total_order ?? ''}}</span>
                                         </div>
                                      </div>
                                   </form>
                                </div>
                                
                              </div>
                              
                            </div>
                            <div class="col-6">
                               <div class="card">
                                   <div class="card-header">
                                       <div class="row">
                                           <div class="col-md-4 mt-2 mb-2"><b>Total Payment</b></div>
                                           <div class="col-md-4 mt-2 mb-2"><b>Pending Payment</b></div>
                                           <div class="col-md-4 mt-2 mb-2"><b>Paid Payment</b></div>
                                       </div>
                                   </div>
                                   <div class="card-body">
                                       <div class="row">
                                           <div class="col-md-4 mt-2 mb-2 pl-3">
                                    @php
                                       $order_sum = DB::table('order_details')->where('user_id',$data['id'])->sum('total_amount');
                                    @endphp
                                               <b>
                                                 {{$order_sum ?? ''}}
                                               </b>
                                            </div>
                                            @php
                                               $order_sum_padding = DB::table('order_details')->where('user_id',$data['id'])->where('payment_status',0)->sum('total_amount');
                                          
                                            @endphp
                                           <div class="col-md-4 mt-2 mb-2 pl-3">
                                               <b>
                                                {{$order_sum_padding ?? ''}}<button type="button" class=" btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                               </b>
                                            </div>
                                            @php
                                               $order_sum_paid = DB::table('order_details')->where('payment_status',1)->where('user_id',$data['id'])->sum('total_amount');
                                            @endphp
                                           <div class="col-md-4 mt-2 mb-2 pl-3">
                                               <b>
                                                 {{$order_sum_paid ?? ''}} <button type="button" class=" btn-primary" data-toggle="modal" data-target="#exampleModal1"><i class="fa fa-eye" aria-hidden="true"></i></button> 
                                               </b>
                                            </div>
                                           
                                       </div>
                                   </div>
                                  
                               </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Button trigger modal -->
@php

$order_details =DB::table('order_details')->select('order_details.*','services.name as service_name','services.service_type_id as service_type_id','users.mobile as mobile','users.email as user_email')
         ->leftjoin('users','users.id','order_details.user_id')
         ->leftjoin('service_details','service_details.id','order_details.service_detail_id')
         ->leftjoin('services','services.id','service_details.service_id')->where('order_details.user_id',$data['id'])->where('payment_status',0)->get();

    $order_detai =DB::table('order_details')->select('order_details.*','services.name as service_name','services.service_type_id as service_type_id','users.mobile as mobile','users.email as user_email')
         ->leftjoin('users','users.id','order_details.user_id')
         ->leftjoin('service_details','service_details.id','order_details.service_detail_id')
         ->leftjoin('services','services.id','service_details.service_id')->where('order_details.user_id',$data['id'])->where('payment_status',1)->get();
          
         
         @endphp
         
         
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pending Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Order No</th>
      <th scope="col">Service Name</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>
       @if(!empty($order_details))
            @php
            
                $i=1;
               
            @endphp
    @foreach($order_details as $key => $FetchData)
        <tr>
          <th scope="row">{{++$i}}</th>
          <td>{{$FetchData->order_no ?? ''}}</td>
         <td>{{$FetchData->service_name ?? ''}}</td>
          <td>{{$FetchData->total_amount ?? ''}}</td>
        </tr>
    @endforeach
                            
    @endif
  </tbody>
</table>
    </div>
  </div>
</div>




<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Paid Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Order No</th>
      <th scope="col">Service Name</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>
       @if(!empty($order_detai))
            @php
            
                $i=1;
               
            @endphp
    @foreach($order_detai as $key => $Fetch)
        <tr>
          <th scope="row">{{++$i}}</th>
          <td>{{$Fetch->order_no ?? ''}}</td>
         <td>{{$Fetch->service_name ?? ''}}</td>
          <td>{{$Fetch->total_amount ?? ''}}</td>
        </tr>
    @endforeach
                            
    @endif
  </tbody>
</table>
    </div>
  </div>
</div>
<style>
    .btn-xs {
  padding: .125rem .25rem;
  font-size: 17px;
  line-height: 1.5;
  border-radius: .15rem;
}
.btn-none{
    background: none;
border: none;
padding: 0px;
width: 100%;
text-align: left;
}
</style>
@endsection