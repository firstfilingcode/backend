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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Edit Services</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/service') }}" class="btn bbtn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                <a href="{{ URL::previous() }}" class="btn bbtn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>

                        </div>
                        @php
                            $route_data = DB::table('routes')->where('route',$data->page_name)->get()->first();
                        @endphp
                           <form class="border px-4 pt-2 pb-3" method="POST" action="{{url('admin/service_routes')}}/{{$route_data->id ?? ''}}" enctype="multipart/form-data">
                    @csrf
                 <div class="card-body">
                              
           
               
                    <div class="row">
                                 
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Route Name<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('route') is-invalid @enderror " readonly id="route" name="route" placeholder="Route Name" value="{{old('route') ?? $route_data->route }}">
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
                                        <input type="text" class="form-control @error('page_name') is-invalid @enderror" id="page_name" name="page_name" placeholder="Name" value="{{old('page_name') ?? $route_data->page_name }}">
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
                            		      	<option value="{{$type->id}}" {{ ( $type->id == $route_data->service_type_id) ? 'selected' : '' }}>{{$type->name}}</option>
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
                            		      	<option value="{{$type->id}}" {{ ( $type->id == $route_data->service_sub_type_id) ? 'selected' : '' }}>{{$type->name}}</option>
                            		   @endforeach
                            		   @endif
                                        </select> 
                                        @error('service_sub_type_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror  
                                </div>
                                
                            
                 
                     <div class="col-md-1 text-center mt-3">
                        <button type="submit" class="btn btn-success">Update </button>
                     </div>
                 
                  
                        
              
            </div>
            
            
            
                       </div>
                    </form>
                         {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.service.update', $data->id]]) !!}
                           @csrf
                            <div class="row m-2">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Service Type<span style="color:red;">*</span></label>
                                        <select name="service_type_id" id="service_type_id" class="form-control @error('service_type_id') is-invalid @enderror mt-1 " >
                                            <option value="" >Select Service Type</option>
                                                @if(!empty(getService_type()))
                                    		    @foreach (getService_type() as $type)
                                    		    	
                                    		      	<option value="{{$type->id}}" {{ ( $type->id == $data->service_type_id) ? 'selected' : '' }}>{{$type->name}}</option>
                                    		   @endforeach
                                    		   @endif
                                        </select> 
                                        @error('service_type_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                @php
                                $name = DB::table('routes')->where('route',$data->page_name)->get()->first();
                               
                                @endphp
                               <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror @error('name') is-invalid @enderror mt-1" id="name" name="name" placeholder="Name" value="{{$name->page_name ?? '' }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>-->
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>CA Share<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('ca_share') is-invalid @enderror @error('ca_share') is-invalid @enderror mt-1" id="ca_share" name="ca_share" placeholder="CA Share" value="{{old('ca_share') ?? $data['ca_share']}}">
                                        @error('ca_share')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Page Name<span style="color:red;">*</span></label>
                                        <select name="page_name" id="page_name" class="form-control teg @error('page_name') is-invalid @enderror mt-1" >
                                                @if(!empty($routes))
                                    		    @foreach ($routes as $route)
                                    		      	<option value="{{$route->route}}" {{ ( $route->route == old('page_name',$data->page_name)) ? 'selected' : '' }}>{{$route->page_name}}</option>
                                    		  
                                    		   @endforeach
                                    		   @endif
                                        </select> 
                                    </div>
                                </div>
                                @php
                                $doc_id = DB::table('service_documents')->where('service_id', $data['id'])->get()->first();
                            $document_types_id = array();
                                if($doc_id->document_types_id > 0){ 
                                $val = $doc_id->document_types_id;
                                $document_types_id = explode(',', $val);
                         }
                         
                        @endphp
                               <div class="col-md-3">
                                    <div class="form-group select2 ">
                                        <label class="">Required Documents</label>
                                        <div class="input-group-append">
                                            <select type="text" class=" w-100 select2-custom teg "  multiple="multiple" id="document_types_id" name="document_types_id[]">
                                             
                                                @if(!empty($docs)) 
                                                    @foreach($docs as $doc)
                                                        <option value="{{ $doc->id ?? ''  }}" @if(in_array($doc->id,$document_types_id)) selected="" @endif>{{ $doc->name ?? ''  }}</option>
                                                    @endforeach
                                                 @endif
                            				  
                                            </select>
                                            
                                             
                                            </div>
                                    </div>
                                </div>
                                 
                                @php
                               
                                 $status_id = array();
                                if($data['status_id'] > 0){ 
                                $val = $data['status_id'];
                                $status_id = explode(',', $val);
                                 }
                               $getStatus = DB::table('status')->whereNotIn('id',$status_id)->get();
                               
                        @endphp
                                    <div class="col-md-6">
                                    
                                        <label class="">Status <button type="button" class="" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button></label>
                                        <div class="">
                                          
                         
                                        <select id="status_id" placeholder="Select Status" multiple name="status_id[]">
                                            
                                            @if(!empty($status_id))
    
                                                    @foreach($status_id as $key => $ids)
                                                    
                                           
                                              @php
                                             
                                                     $fill = DB::table('status')->find($ids);
                                        
                                              @endphp
                                                  <option value="{{ $fill->id ?? ''  }}" selected="">{{ $fill->name ?? ''  }}</option>

                                         @endforeach
                                                                    
                                                                    @endif
                            
                            
                            
                                                @if(!empty($getStatus))
                                                    @foreach($getStatus as $status)
                                                        <option value="{{ $status->id ?? ''  }}" >{{ $status->name ?? ''  }}</option>
                                                    @endforeach
                                                 @endif
                                            </select>

                                    </div>
                                </div>
                              
                                <div class="col-md-12">
                                 <table class="_table" id="tableId"style="width:100%">
                                    <thead>
                                        
                                      <tr>
                                          <th class="text-danger">Web Status</th>
                                        <th class="text-danger">Category*</th>
                                        <th class="text-danger">Price*</th>
                                        <th class="text-danger">Short Description*</th>
                 
                                      </tr>
                                    </thead>
                                    <tbody id="table_body">
                                      <tr id="box2" >
                                        <input type="hidden"  name="service_detail_id[]"  value="{{$service_detail[0]['id'] ?? ''}}" >
                                      <td style="width:10%;">
                                             <input value="1"  name="web_status[]" type="checkbox" id="switch1" switch="none" {{ ( $service_detail[0]['web_status'] == 1) ? 'checked' : '' }}/>      
                                        </td>
                                        <td style="width:20%;">
                                            <select name="category[]" id="category" class="form-control @error('category') is-invalid @enderror"  >
                                                <option value=" ">Select</option>
                                                <option value="Silver" {{ ( $service_detail[0]['category'] == 'Silver') ? 'selected' : '' }}>Silver</option>
                                                <option value="Gold" {{ ( $service_detail[0]['category'] == 'Gold') ? 'selected' : '' }}>Gold</option>
                                                <option value="Platinum" {{ ( $service_detail[0]['category'] == 'Platinum') ? 'selected' : '' }}>Platinum</option>
                                            
                                            </select>         
                                        </td>
                                        
                                        <td style="width:20%;">
                                          <input type="text" class="form-control amount" placeholder="Price" id="price" name="price[]"  value="{{$service_detail[0]['price'] ?? ''}}" onkeypress="return isNumber(event)" required>
                                        </td>
                                        <td style="width: 60%">
                                            <textarea class="form-control ckeditor" name="short_des[]" id="short_des">{{$service_detail[0]['short_des'] ?? ''}}</textarea>
                                          
                                        </td>
                                   
                                      </tr>
                                      <tr id="box2" >
                                       <input type="hidden"  name="service_detail_id[]"  value="{{$service_detail[1]['id'] ?? ''}}" >
                                        <td style="width:10%;">
                                             <input value="1"  name="web_status[]" type="checkbox" id="switch1" switch="none" {{ ( $service_detail[1]['web_status'] == 1) ? 'checked' : '' }}/>      
                                        </td>
                                        <td style="width:20%;">
                                            <select name="category[]" id="category" class="form-control @error('category') is-invalid @enderror"  >
                                                <option value=" ">Select</option>
                                                <option value="Silver"{{ ( $service_detail[1]['category'] == 'Silver') ? 'selected' : '' }}>Silver</option>
                                                <option value="Gold"{{ ( $service_detail[1]['category'] == 'Gold') ? 'selected' : '' }}>Gold</option>
                                                <option value="Platinum" {{ ( $service_detail[1]['category'] == 'Platinum') ? 'selected' : '' }}>Platinum</option>
                                            
                                            </select>         
                                        </td>
                                        
                                        <td style="width:20%;">
                                          <input type="text" class="form-control amount" placeholder="Price" id="price" name="price[]" value="{{$service_detail[1]['price'] ?? ''}}" onkeypress="return isNumber(event)" required>
                                        </td>
                                        <td style="width: 60%">
                                            <textarea class="form-control ckeditor" name="short_des[]" id="short_des">{{$service_detail[1]['short_des'] ?? ''}}</textarea>
                                          
                                        </td>
                                     
                                      </tr>
                                      <tr id="box2" >
                                            <input type="hidden"  name="service_detail_id[]"  value="{{$service_detail[2]['id'] ?? ''}}" >
                                           <td style="width:10%;">
                                             <input value="1"  name="web_status[]" type="checkbox" id="switch1" switch="none" {{ ( $service_detail[2]['web_status'] == 1) ? 'checked' : '' }}/>      
                                        </td>
                                        <td style="width:20%;">
                                            <select name="category[]" id="category" class="form-control @error('category') is-invalid @enderror"  >
                                                <option value=" ">Select</option>
                                                <option value="Silver"{{ ( $service_detail[2]['category'] == 'Silver') ? 'selected' : '' }}>Silver</option>
                                                <option value="Gold"{{ ( $service_detail[2]['category'] == 'Gold') ? 'selected' : '' }}>Gold</option>
                                                <option value="Platinum" {{ ( $service_detail[2]['category'] == 'Platinum') ? 'selected' : '' }}>Platinum</option>
                                            </select>         
                                        </td>
                                        <td style="width:20%;">
                                          <input type="text" class="form-control amount" placeholder="Price" id="price" name="price[]" value="{{$service_detail[2]['price'] ?? ''}}"  onkeypress="return isNumber(event)" required>
                                        </td>
                                        <td style="width: 60%">
                                            <textarea class="form-control ckeditor" name="short_des[]" id="short_des">{{$service_detail[2]['short_des'] ?? ''}}</textarea>
                                        </td>
                                    
                                      </tr>
                                    </tbody>
                                     
                                </table>
                                </div>
                                </div>
                
                               
                                
                            
                                
                            <div class="row m-2">
                                <div class="col-md-4 mt-2">
                                    <label for="switch1" data-on-label="Active" data-off-label="Inactive">Status</label>
                                    <div class="check-box mt-2">
                                     <input value="1"  name="status" type="checkbox" id="switch1" switch="none" {{ ( $data['status'] == 1) ? 'checked' : '' }}/>
                                    </div>
                                    @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
         </div>
    </section>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table class="table">
  <thead>
    <tr>
     
      <th scope="col">Status Name</th>
     
    </tr>
  </thead>
  <tbody>
      
      @if(!empty($status_id))
    
            @foreach($status_id as $key => $ids)
            
    <tr>
      @php
     
             $fill = DB::table('status')->find($ids);

      @endphp
      <td>{{$fill->name ?? ''}}</td>
     
    </tr>
 @endforeach
                            
                            @endif
  </tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<style>
  .Label_top {
    margin-top: 25px;
  }
</style>
<link rel="stylesheet" href="{{ asset('public/assets/dropify.css') }}">
<script src="{{URL::asset('public/assets/ckeditor/ckeditor.js')}}"></script>
<script src="{{URL::asset('public/assets/dropify.js')}}"></script>
<script src="{{URL::asset('public/assets/dropify1.js')}}"></script>
<link rel="stylesheet" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>

<script>
  CKEDITOR.editorConfig = function (config) {
    config.extraPlugins = 'confighelper';
  };
  CKEDITOR.replace('editor1');

$('#service_type_id').on('change', function(e){
                        
    	var service_type_id = $(this).val();
        $.ajax({
             headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
    	  url: '/admin/service_type_status/'+service_type_id,
    	  success: function(data){
    	      $('#status_id').html(data).trigger('change');
    		//	$("#status_id").html(data);
    	  }
    	});
    	
    });
    
    $(document).ready(function(){

 var multipleCancelButton = new Choices('#status_id', {
 removeItemButton: true,
 maxItemCount:30,
 searchResultLimit:50,
 renderChoiceLimit:50,
  shouldSort: false,
 });


 });
</script>


@endsection