@extends('admin.layouts.app')
@section('title') @lang('translation.Dashboard')
@endsection @section('content')

@php
$getuser = DB::table('users')->get();

@endphp
<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">
                                <i class="fa fa-address-book-o"></i> &nbsp; {{ __('View
                                Costumar') }}
                            </h3>
                            <div class="card-tools">
                           <a href="{{url('admin/costumar/create')}}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-plus"></i>{{ __('Add') }}</a>
                                <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>
                        </div>

                <form  class="eye_hide"  method="get" >
                 @csrf 
				<div class="row p-2">
                        <div class="col-md-2">    
                            <label for="to_date">Email </label>
              		 	     <input class="form-control"  type="text" name="email" id="email" placeholder="Email" value="{{old('email') ?? $search->name  ?? '' }}">
                            </div>
                       <div class="col-md-2">    
                                <label for="to_date">Mobile </label>
              			    <input class="form-control"  type="tel" name="mobile" id="mobile"  placeholder="Mobile No." value="{{$search['mobile']  ??  old('email')}}">
                        </div>
                        <div class="col-md-2">    
                                <label for="category_id">Status</label>
                                <select class="form-control input1" id="payment_status" name="payment_status">
                                <option value="">Select </option>
                                <option value="1" {{ $search['payment_status'] == "1" ? 'selected' : '' }}>Paid</option>
                                <option value="0" {{ $search['payment_status'] == "0" ? 'selected' : '' }}>Unpaid </option>
                             
                     
                            </select>
                                                                 
                            </div>
    
    
                        <div class="col-md-2">
                            <label></label>
                    	    <button type="submit" class="btn btn-primary mt-3 text-center" style="margin-bottom:5%;">Search</button>
                           	    <button  class="btn btn-success mt-3 text-center" style="margin-bottom:5%;"> <a href="{{url('admin/costumar')}}" class="text-white btn-sm">{{ __(' Refresh') }}</a></button>

                    	</div>
						</div>
						</form>


                        <div class="row m-2">
                            <div class="col-12">
                                 <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
                                    <thead>
                                        <tr role="row">
                                            <th>Sr.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                             <th>Mobile</th>
                                             <th>Password</th>
                                            <th>Create Date</th>
                                            <th>Pending Payment</th>
                                            <th>Paid Payment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody class="product_list_show">
                                         
           	              @if(!empty($data))
                                            @php
                                                $i=1;
                                              
                                            @endphp
                                  @foreach($data as $key => $FetchData)
                                   @php
                                         
                                                $order_sum_padding = DB::table('order_details')->where('payment_status',0)->where('user_id',$FetchData['id'])->sum('total_amount');
                                              
                                                 $order_sum_paid = DB::table('order_details')->where('payment_status',1)->where('user_id',$FetchData['id'])->sum('total_amount');
                                            @endphp
									<td>{{ ++$i  }}</td>		
							        <td> <a href="{{  route('admin.costumar.show',$FetchData->id)  }}" class=" text-success btn-xs ml-3" title="View">{{ $FetchData->name ?? ''}}</a></td>	
									<td>{{ $FetchData->email ?? ''}}</td>									
									<td>{{ $FetchData->mobile ?? ''}}</td>
									<td>{{ $FetchData->show_password ?? ''}}</td>
									<td>{{ date('m/d/Y',strtotime($FetchData->created_at)) ?? ''}}</td>	
									<td>{{ $order_sum_padding ?? ''}}</td>
									<td>{{ $order_sum_paid ?? ''}}</td>
									<td>
                                        <button  data-id="{{ $FetchData->id }}" data-name="{{$FetchData->status==0 ? '1' : '0'}}" class="{{$FetchData->status==0 ? 'btn btn-success' : 'btn btn-danger'}} btn-sm btn-soft-success waves-effect waves-light sa-params user_status" style ="display:inline">{{$FetchData->status==0 ? 'Acitve' : 'Inactive'}}</button>
               						</td>
									
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="{{ route('admin.users.show',$FetchData->id) }}" class="px-2 text-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="uil uil-search font-size-18"></i></a>
                                            </li>
											
											<li class="list-inline-item">
                                                <a href="{{ route('admin.costumar.edit',$FetchData->id) }}" class="px-2 text-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            </li>
                                            <li class="list-inline-item">										        
										  <!--      <a  data-id="{{$FetchData->id}}"  data-location="users"  class="user_delete px-2 text-danger sa-params" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>-->
												<!--{!! Form::open(['method' => 'DELETE','route' => ['admin.users.destroy', $FetchData->id],'style'=>'display:inline','class'=>'sa-params'.$FetchData->id.'']) !!}												-->
												<!--{!! Form::close() !!}-->
											  <a data-id="{{$FetchData->id}}"  data-location="countries"  class="user_delete px-2 text-danger sa-params" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
                                            {!! Form::open(['method' => 'DELETE','route' => ['admin.users.destroy', $FetchData->id],'style'=>'display:inline','class'=>'sa-params'.$FetchData->id.'']) !!}                                              
                                            {!! Form::close() !!}
                                            </li>
											
                                        </ul>
                                    </td>
                                </tr>
                   @endforeach
                            
                            @endif
                 
                            </tbody>
                        </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

 <div class="modal" id="Modal_id1">
    <div class="modal-dialog">
        <div class="modal-content bg_color">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-white">{{ __('Delete Data On Database') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('admin.costumar.destroy')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="user_id" name="user_id" />
                    
                    <h5 class="text-white">
                        {{ __(' Are you sure you want to delete this data......') }}?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                        data-bs-dismiss="modal">
                        {{ __('Close') }}
                    </button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">
                        {{ __('yes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
      $('.user_status').click(function() {
    var user_id = $(this).data('id'); 
    var status_name = $(this).data('name');

    $('#status_name1').val(status_name); 
  $('#user_id1').val(user_id); 
  $('#Modal_id').modal("show"); 
  
  } );
  
  $('#close,#close1').click(function () {
        $('#id01').hide()
    })

//     $('.user_delete').click(function(){

//       $("#user_delete_id").val($(this).data('id'))
//       $("#Modal_id1").modal("show");
      
   })
</script>

<script>
//     $('.user_status').click(function() {
//     var user_id = $(this).data('id'); 
//     var status_name = $(this).data('name');
  
//     $('#status_name').val(status_name); 
//   $('#user_id').val(user_id); 
//   } );
  
//   
   
     $('.user_delete').click(function(){

      $(".user_id").val($(this).data('id'))
      $("#Modal_id1").modal("show");
      
   })
   
    $('.user_status').click(function() {
    var user_id = $(this).data('id'); 
    var status_name = $(this).data('name');

    $('#status_name1').val(status_name); 
  $('#user_id1').val(user_id); 
  $('#Modal_id').modal("show"); 
  
  } );
</script>
<!-- The Modal -->
<div class="modal" id="Modal_id">
    <div class="modal-dialog">
        <div class="modal-content bg_color">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-white">{{ __('Change status') }}</h4>
                <button type="button" class="btn-close" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>

            <!-- Modal body -->
            <form action="{{ route('admin.costumar.status') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="user_id1" name="user_id" />
                    <input type="hidden" id="status_name1" name="status_name" />
                    <h5 class="text-white">
                        {{ __('Are you sure you want to change status') }}?
                    </h5>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                        data-dismiss="modal">
                        {{ __('Close') }}
                    </button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">
                        {{ __('yes') }}
                    </button>
                </div>
            </form>
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
</style>
@endsection