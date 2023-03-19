@extends('admin.layouts.app')
@section('title') @lang('translation.Dashboard')
@endsection @section('content')
<div class="content-wrapper">
   <section class="content pt-3">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12 col-md-12">
               <div class="card card-outline card-orange">
                  <div class="card-header bg-primary">
                     <h3 class="card-title">
                        <i class="fa fa-first-order"></i> &nbsp; {{ __('Order
                        ') }}
                     </h3>
                      <div class="card-tools">
                              
                                <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>
                  </div>
                  <form id="quickForm" action="{{url('admin/order')}}"   method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="row m-2">
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="Status">Service Name</label>
                              <select name="service_id" id="service_id" class="form-control teg mt-1" >
                                 <option value="">--select--</option>
                                 @if(!empty(getService()))
                                 @foreach (getService() as $service)
                                 <option value="{{$service->id}}"  <?php if (isset($_POST['service_id']) && !empty($_POST['service_id'])){ echo ($service->id == $_POST['service_id']) ? 'selected' : '' ;} ?> >{{$service->name}}</option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>
                        @if(Auth::user()->role_id == 1)
                        <div class="col-md-3">
                           <label class="control-label">Rm </label> 
                           <select class="form-control w-100 select2-custom teg " name="rm_user_id">
                              <option value="">--select--</option>
                              @if(!empty(getRmUser()))
                              @foreach(getRmUser() as $item)
                              <option value="{{ $item->id ?? '' }}" <?php if (isset($_POST['rm_user_id']) && !empty($_POST['rm_user_id'])){ echo ($item->id == $_POST['rm_user_id']) ? 'selected' : '' ;} ?>>{{ $item->name ?? '' }}</option>
                              @endforeach
                              @endif
                           </select>
                        </div>
                        @endif
                        <div class="col-md-3">
                           <label class="control-label">Ca </label> 
                           <select class="form-control w-100 select2-custom teg " name="ca_user_id">
                              <option value="">--select--</option>
                              @if(!empty(getCaUser()))
                              @foreach(getCaUser() as $item)
                              <option value="{{ $item->id ?? '' }}" <?php if (isset($_POST['ca_user_id']) && !empty($_POST['ca_user_id'])){ echo ($item->id == $_POST['ca_user_id']) ? 'selected' : '' ;} ?>>{{ $item->name ?? '' }}</option>
                              @endforeach
                              @endif
                           </select>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="Status">Order Item Status</label> 
                              <select name="status_id" id="status_id" class="form-control teg" >
                                 <option value="" >Order Item Status</option>
                                 @if(!empty(getStatus()))
                                 @foreach (getStatus() as $status)
                                 <option value="{{$status->id}}"  <?php if (isset($_POST['status_id']) && !empty($_POST['status_id'])){ echo ($status->id == $_POST['status_id']) ? 'selected' : '' ;} ?>>{{$status->name}}</option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Order ID</label>
                              <input type="text" class="form-control " id="order_id" name="order_id" placeholder="Order ID" value="<?php if (isset($_POST['order_id']) && !empty($_POST['order_id'])){ echo $_POST['order_id'];}?>" >
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Form Date</label>
                              <input type="date" class="form-control " id="form_date" name="form_date" placeholder="Form Date"  value="<?php if (isset($_POST['form_date']) && !empty($_POST['form_date'])){ echo $_POST['form_date'];}?>">
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>To Date</label>
                              <input type="date" class="form-control " id="to_date" name="to_date" placeholder="To Date" value="<?php if (isset($_POST['to_date']) && !empty($_POST['to_date'])){ echo $_POST['to_date'];}?>">
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Customer Email</label>
                              <input type="email" class="form-control " id="email" name="email" placeholder="Customer Email" value="<?php if (isset($_POST['email']) && !empty($_POST['email'])){ echo $_POST['email'];}?>">
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Customer Phone no.</label>
                              <input type="number" class="form-control " id="mobile" name="mobile" placeholder="Customer Phone no." value="<?php if (isset($_POST['mobile']) && !empty($_POST['mobile'])){ echo $_POST['mobile'];}?>">
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>SP Share</label>
                              <input type="text" class="form-control" id="sp_share" name="sp_share" placeholder="SP Share" value="<?php if (isset($_POST['sp_share']) && !empty($_POST['sp_share'])){ echo $_POST['sp_share'];}?>">
                           </div>
                        </div>
                     </div>
                     <div class="row m-2">
                         
                         <div class="col-12 "style="text-align: center;">
                   
                   <button class="btn btn-success {{ (isset($_POST['tab_type']) && ($_POST['tab_type'] == "awaiting_acceptance")) ? 'active' : '' }} {{ (isset($_POST['tab_type'])) ? '' : 'active' }}" type="submit" name="tab_type" value="awaiting_acceptance" >Awaiting Acceptance</button>
                    
                   <button class="btn btn-success {{ (isset($_POST['tab_type']) && ($_POST['tab_type'] == "active_order")) ? 'active' : '' }}" type="submit" name="tab_type" value="active_order">Active Order</button>
                   <button class="btn btn-success {{ (isset($_POST['tab_type']) && ($_POST['tab_type'] == "Caseonhold")) ? 'active' : '' }}" type="submit" name="tab_type" value="Caseonhold">Case on hold</button>
                   <button class="btn btn-success {{ (isset($_POST['tab_type']) && ($_POST['tab_type'] == "workdone")) ? 'active' : '' }}" type="submit" name="tab_type" value="workdone">Work Done</button>
                 
                     <button type="submit" class="btn btn-success"> Search </button>
               </div>
                        
                           
                        
                     </div>
                  </form>
               </div>
            </div>
            <div class="col-12">
               
            
                  <table id="example1" class=" table table-bordered table-hover dataTable dtr-inline table-responsive text-nowrap no-footer">
                     <thead>
                        <tr role="row">
                           <th>ORDER ID</th>
                           @if(Auth::user()->role_id == 1)
                            <th>Rm</th>
                            <th>Ca</th>
                            @else
                           <th>Ca</th>
                            @endif
                           
                           <th>Service Name</th>
                           <th>Status</th>
                           <th>Customer Name</th>
                           <th>Customer Email</th>
                           <th>Customer Mobile</th>
                           <th>Order Date</th>
                           <th>SP Share	</th>
                           <th>Docs Pending	</th>
                           <th>Docs Uploaded	</th>
                           <th>Case Type	</th>
                           @if(Auth::user()->role_id == 1)
                            <th>Total Amount	</th>
                            <th>Payment Status	</th>
                           @endif
                           
                        </tr>
                     </thead>
                     <tbody class="product_list_show">
                        @if(!empty($data))
                        @php
                        $i=1;
                        @endphp
                        @foreach($data as $key => $value)
                        @php
                       
                        $sp_share = $value['amount']*$value['ca_share']/100;
                        $docs_pending = DB::table('order_required_documents')->where('order_id', $value->id)->where('status', 0)->count();
                        $docs_uploaded = DB::table('order_required_documents')->where('order_id', $value->id)->where('status', 1)->count();
                        @endphp
                        <tr  
                        @foreach(getOrderPriority() as $item2)
                         @if($value['priority'] == $item2->name) style="background-color:{{$item2->color_code}};color: #fff;" @endif
                        @endforeach  >
                         @if($value->payment_status == 1)
                        <td class="pl-2"> 
                        @if(Auth::user()->role_id == 1)
                        @if($value['admin_new_order'] == 1  ) <img src="{{ env('IMAGE_SHOW_PATH').'orderimg/new-animated-gif-icon-2.gif' }}" style="width: 25px;"> @endif
                        @else
                         @if($value['rm_new_order'] == 1  ) <img src="{{ env('IMAGE_SHOW_PATH').'orderimg/new-animated-gif-icon-2.gif' }}" style="width: 25px;"> @endif 
                         @endif
                       
                        @if(!empty($value['ca_user_id'])) @if( $value['ca_approval_status'] == 0  || $value['ca_approval_status'] == 2) <img src="{{ env('IMAGE_SHOW_PATH').'orderimg/giphy.gif' }}" style="width: 25px;"> @endif @endif
                        
                        <a href="{{  url('admin/order_edit')}}/{{$value->id}}" >{{$value['order_no'] ?? ''}}</a></td>
                        @else
                        <td> <a onclick = "fun();" >{{$value['order_no'] ?? ''}}</a></td>
                        @endif
                        @if(Auth::user()->role_id == 1)
                        <td><a href="{{  url('admin/rm')}}/{{$value->rm_user_id}}">{{UserData($value['rm_user_id'])->name ?? '' }}</a></td>
                        <td><a href="{{  url('admin/ca')}}/{{$value->ca_user_id}}" >{{UserData($value['ca_user_id'])->name ?? '' }} </a></td>
                        @else
                        <td>{{UserData($value['ca_user_id'])->name ?? '' }}</td>

                        @endif
                        <td>{{$value['service_name'] ?? ''}}</td>
                        <td>{{$value['status_name'] ?? ''}}</td>
                        <td> <a href="{{ (Auth::user()->role_id == 1) ? url('admin/costumar').'/'.$value->user_id : ''  }}" >{{$value['name'] ?? ''}}</a></td>
                        <td> {{$value['user_email'] ?? ''}}</td>
                        <td>{{$value['mobile'] ?? ''}}</td>
                        <td>{{$value['created_at'] ?? ''}}</td>
                        <td>{{$sp_share ?? ''}}</td>
                        <td>{{$docs_pending ?? '0'}}</td>
                        <td>{{$docs_uploaded ?? '0'}}</td>
                        <td>{{$value['case_type'] ?? 'No'}}</td>
                        @if(Auth::user()->role_id == 1)
                        <td>{{$value['total_amount'] ?? ''}}</td>
                        <td>
                           @if($value['payment_status'] == 1)
                           Paid
                           @elseif($value['payment_status'] == 0)
                           not paid
                           @elseif($value['payment_status'] == 2)
                           Cancel
                            @endif
                            </td>
                        
                        @endif
                        </tr>
                        @endforeach
                        @endif
                     </tbody>
                  </table>
                   @if(count($data) > 0)
                  <p class="mt-5">
                       @foreach(getOrderPriority() as $item2)
                       {{$item2['name'] ?? ''}} <input type="color"  value="{{ $item2['color_code'] }}" disabled>
                        @endforeach  
            
               </p>
                @endif
            </div>
         </div>
      </div>
   </section>
</div>

<script>
     function fun() {
            alert ("This order has not been paid");
            }
</script>
<style>
   .btn-xs {
   padding: .125rem .25rem;
   font-size: 17px;
   line-height: 1.5;
   border-radius: .15rem;
   }
   .tab {
   display:flex;
   margin-left: 35%;
   }
   .active{
   background-color: #4158D0 !important;
   }
   /* Style the buttons inside the tab */
   .tab button {
   border: none;
   cursor: pointer;
   padding: 6px 15px;
   transition: 0.3s;
   }
   .tab button:hover {
   color:#fff;
   }
   .tab button.active {
   background-color: #4158D0;
   color: #ffffff;
   font-weight: 700;
   }
   /* Style the tab content */
   .tabcontent {
   display: none;
   color:#273342;
   padding: 6px 12px;
   border: 1px solid #dddddd40;
   margin-top:10px;
   background:#fff;
   border-radius:10px;
   }
</style>

@endsection
