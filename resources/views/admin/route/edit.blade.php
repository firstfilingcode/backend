@extends('admin.layouts.app')
@section('title') @lang('translation.Dashboard') @endsection
@section('content')

<div class="content-wrapper" style="min-height: 222px;">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Edit Page Route</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/routes') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>

                        </div>
                  {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.routes.update', $data->id]]) !!}
                  @csrf
                 <div class="card-body">
        
           
               
                    <div class="row">
                                 
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Route Name<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('route') is-invalid @enderror " readonly id="route" name="route" placeholder="Route Name" value="{{old('route') ?? $data['route'] }}">
                                        @error('route')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('page_name') is-invalid @enderror" id="page_name" name="page_name" placeholder="Name" value="{{old('page_name') ?? $data['page_name'] }}">
                                        @error('page_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                     <label>Service Type</label>
                                    <select name="service_type_id" id="service_type_id" class="form-control @error('service_type_id') is-invalid @enderror mt-1" >
                                        @if(!empty(getService_type()))
                                        <option value="" >Select Service Type</option>
                            		    @foreach (getService_type() as $type)
                            		      	<option value="{{$type->id}}" {{ ( $type->id == $data['service_type_id']) ? 'selected' : '' }}>{{$type->name}}</option>
                            		   @endforeach
                            		   @endif
                                        </select> 
                                        @error('service_type_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror  
                                </div>
                                 <div class="col-md-3">
                                     <label>Service Sub Type</label>
                                    <select name="service_sub_type_id" id="service_sub_type_id" class="form-control @error('service_sub_type_id') is-invalid @enderror mt-1 teg" >
                                        @if(!empty(getService_sub_type()))
                                        <option value="" >Select Service Sub Type</option>
                            		    @foreach (getService_sub_type() as $type)
                            		      	<option value="{{$type->id}}" {{ ( $type->id == $data['service_sub_type_id']) ? 'selected' : '' }}>{{$type->name}}</option>
                            		   @endforeach
                            		   @endif
                                        </select> 
                                        @error('service_sub_type_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror  
                                </div>
                                    <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Order By</label>
                                        <input type="text" class="form-control @error('order_By') is-invalid @enderror" id="order_By" name="order_By" placeholder="Order By" value="{{old('order_By') ?? $data['order_By'] }}">
                                        @error('order_By')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            
                 
                     <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Update </button>
                     </div>
                 
                  
                        
              
            </div>
            
            
            
        </div>
{!! Form::close() !!}

               </div>
            </div>
         </div>
      </div>
   </section>
</div>

<script>
                $('#service_type_id').on('change', function(e){
                        
                    	var service_type_id = $(this).val();
                        $.ajax({
                             headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                    	  url: '/admin/Search_service_Sub_type/'+service_type_id,
                    	  success: function(data){
                    			$("#service_sub_type_id").html(data);
                    	  }
                    	});
                    	
                    });
            </script>

@endsection


