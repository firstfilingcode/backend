@extends('admin.layouts.app')
@section('title') @lang('translation.Dashboard')
@endsection 
@section('content')
<div class="content-wrapper">
   <section class="content pt-3">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12 col-md-12">
               <div class="card card-outline card-orange">
                  <div class="card-header bg-primary">
                     <h3 class="card-title">
                        <i class="fa fa-first-order"></i> &nbsp; {{ __('Add Order
                        ') }}
                     </h3>
                       <div class="card-tools">
                                <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>
                  </div>
                  <form id="quickForm" action="{{url('admin/order_add')}}"   method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="row m-2">
                         <div class="col-md-3">
                           <div class="form-group">
                              <label for="Status">Costumar Name</label>
                              <select name="user_id" id="user_id" class="form-control service_id teg mt-1" >
                                 <option value="">--select--</option>
                                 @if(!empty(getCostumarUser()))
                                 @foreach (getCostumarUser() as $users)
                                 <option value="{{$users->id}}"  <?php if (isset($_POST['user_id']) && !empty($_POST['user_id'])){ echo ($users->id == $_POST['user_id']) ? 'selected' : '' ;} ?> >{{$users->name}}</option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>
                          <div class="col-md-3">
                           <div class="form-group">
                              <label for="Status">Service Name</label>
                              <select name="service_id" id="service_id" class="form-control service_id  mt-1" >
                                 <option value="">--select--</option>
                                 @if(!empty(getService()))
                                 @foreach (getService() as $service)
                                 <option value="{{$service->id}}"  <?php if (isset($_POST['service_id']) && !empty($_POST['service_id'])){ echo ($service->id == $_POST['service_id']) ? 'selected' : '' ;} ?> >{{$service->name}}</option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>
                        
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="Status">Service Detail</label>
                              <select name="service_detail_id" id="service_detail_id" class="form-control teg mt-1" >
                                 <option value="">--select--</option>
                               <!--  @if(!empty(getServiceDetails()))
                                 @foreach (getServiceDetails() as $ServiceDetails)
                                 <option value="{{$ServiceDetails->id}}"  <?php if (isset($_POST['service_detail_id']) && !empty($_POST['service_detail_id'])){ echo ($ServiceDetails->id == $_POST['service_detail_id']) ? 'selected' : '' ;} ?> >{{$ServiceDetails->category}}</option>
                                 @endforeach
                                 @endif-->
                              </select>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="Status">Payment Type</label>
                              <select name="payment_mode" id="payment_mode" class="form-control teg mt-1" >
                                 <option value="">--select--</option>
                                 <option value="Online">Online</option>
                                 <option value="Offline">Offline</option>
                               
                              </select>
                           </div>
                        </div>
                       
                       
                       
                       
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Amount</label>
                              <input type="text" class="form-control" id="amount" name="amount" placeholder="0.00" value="<?php if (isset($_POST['amount']) && !empty($_POST['amount'])){ echo $_POST['amount'];}?>">
                           </div>
                        </div>
                        <!--
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Total Amount</label>
                              <input type="text" class="form-control" id="total_amt" name="total_amt" placeholder="0.00" value="<?php if (isset($_POST['total_amt']) && !empty($_POST['total_amt'])){ echo $_POST['total_amt'];}?>">
                           </div>
                        </div>-->
                     </div>
                     <div class="row m-2">
                        <div class="col-md-12 text-center">
                           <button type="submit" class="btn btn-success btn-lg"> Submit </button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            </div>
            </div>
            </section>
            </div>
         
            <script>
                $('#service_id').on('change', function(e){
                        
                    	var service_id = $(this).val();
                        $.ajax({
                             headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                    	  url: 'order_details/'+service_id,
                    	  success: function(data){
                    			$("#service_detail_id").html(data);
                    	  }
                    	});
                    	
                    });
            </script>
            
            

      @endsection