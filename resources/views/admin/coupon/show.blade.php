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
                        <i class="fa fa-address-book-o"></i> &nbsp; {{ __('View
                        Coupon') }}
                     </h3>
                     <div class="card-tools">
                        <a href="{{url('admin/coupon')}}" class="btn btn-warning text-white btn-sm"><i
                           class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="mt-4">
                        <div class="product-desc">
                           <div class="tab-content border border-top-0 p-4">
                              <div class="tab-pane fade show active" id="specifi" role="tabpanel">
                                 <div class="table-responsive">
                                    <table class="table table-nowrap mb-0">
                                       <tbody>
                                          @if(!empty($data))
                                         
                                          <tr >
                                             <th style="width: 20%;">Name</th>
                                             <td>{{$data['name'] ?? ''}}</td>
                                          </tr>
                                          <tr >
                                             <th style="width: 20%;">From Date</th>
                                              <td>{{$data['from_date'] ?? ''}}</td>
                                          </tr>
                                          <tr >
                                             <th style="width: 20%;">TO Date</th>
                                              <td>{{$data['to_date'] ?? ''}}</td>
                                          </tr>
                                          
                                              
                                               <tr >
                                             <th style="width: 20%;">Coupon Code</th>
                                             <td>{{$data['coupon_code'] ?? ''}}</td>
                                          </tr>
                                          <tr >
                                             <th style="width: 20%;">Status</th>
                                             <!-- <td>
                                                 @if($data->status==1)
                                              
                                                	<button data-toggle="modal" data-target="#Modal_id" data-id="{{ $data->id }}" data-name="Inactive" class="btn btn-success btn-sm btn-soft-success waves-effect waves-light sa-params offer_status" style ="display:inline">Active</button>
                                             
               								@else
               								  
                                                	<button data-toggle="modal" data-target="#Modal_id" data-id="{{ $data->id }}" data-name="Active" class="btn btn-danger btn-sm btn-soft-danger waves-effect waves-light offer_status" style ="display:inline">Inactive</button>
                                               
            								@endif
                                                
                                            </td>-->
                                            	<td>
                                                <button  data-id="{{ $data->id }}" data-name="{{$data->status==0 ? '1' : '0'}}" class="{{$data->status==0 ? 'btn btn-success' : 'btn btn-danger'}} btn-sm btn-soft-success waves-effect waves-light sa-params user_status" style ="display:inline">{{$data->status==0 ? 'Acitve' : 'Inactive'}}</button>
               						       </td>
                                          </tr>
                                          
                                       </tbody>
                                      
                                       @endif
                                    </table>
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
@endsection