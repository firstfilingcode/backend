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
                                <i class="fa fa-address-book-o"></i> &nbsp; {{ __('View
                                Ca') }}
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
                                    $order = DB::table('order_details')->where('ca_user_id',$data['id'])->count();;
                                    @endphp
                                    <div class="col-12 col-sm-6 col-md-6">
                                       
                                       <input type="hidden" name="ca_user_id" value="{{$data['id']}}">
                                       <input type="hidden" name="tab_type" value="active_order">
                                          <div class="info-box mb-3 text-dark">
                                             <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-first-order"></i></span>
                                             <div class="info-box-content">
                                                 <button type="submit" class="info-box-text btn-none"> Total Orders  </button>
                                                <span class="info-box-number">{{$order ?? ''}}</span>
                                             </div>
                                          </div>
                                          
                                    </div>
                                     @php
                                        $panding_order = DB::table('order_details')->where('status',1)->where('ca_user_id', $data['id'])->count();
                                    @endphp
                                  <div class="col-12 col-sm-6 col-md-6">
                                  <form id="quickForm" action="{{url('admin/order')}}"   method="POST" enctype="multipart/form-data">
                                          @csrf
                                       <input type="hidden" name="ca_user_id" value="{{$data['id']}}">
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
                                    $under = DB::table('order_details')->whereNotIn('order_details.status',[1,23,24])->where('ca_user_id', $data['id'])->count();
                                @endphp
                                 <div class="col-12 col-sm-6 col-md-6">
                                    <form id="quickForm" action="{{url('admin/order')}}"   method="POST" enctype="multipart/form-data">
                                          @csrf
                                       <input type="hidden" name="ca_user_id" value="{{$data['id']}}">
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
                                    $caseOnHold = DB::table('order_details')->where('status',23)->where('ca_user_id', $data['id'])->count();
                                @endphp
                                 <div class="col-12 col-sm-6 col-md-6">
                                    <form id="quickForm" action="{{url('admin/order')}}"   method="POST" enctype="multipart/form-data">
                                          @csrf
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
                                    $total_order = DB::table('order_details')->where('status',24)->where('ca_user_id', $data['id'])->count();
                                @endphp
                                 <div class="col-12 col-sm-6 col-md-6">
                                    <form id="quickForm" action="{{url('admin/order')}}"   method="POST" enctype="multipart/form-data">
                                          @csrf
                                       <input type="hidden" name="ca_user_id" value="{{$data['id']}}">
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
                                               <b>
                                                 0  
                                               </b>
                                            </div>
                                           <div class="col-md-4 mt-2 mb-2 pl-3">
                                               <b>
                                                 0  
                                               </b>
                                            </div>
                                           <div class="col-md-4 mt-2 mb-2 pl-3">
                                               <b>
                                                 0  
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