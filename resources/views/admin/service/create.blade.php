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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Create Service</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/service') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>

                        </div>
                        
                           
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Service Type<span style="color:red;">*</span></label>
                                         <form action="{{ url('admin/service_type_status') }}" method="POST"> 
                            @csrf   
                                        <select name="service_type" id="service_type_id" class="form-control @error('service_type_id') is-invalid @enderror mt-1" onchange="this.form.submit()">
                                                @if(!empty(getService_type()))
                                                <option value="" >Select Service Type</option>
                                    		    @foreach (getService_type() as $type)
                                    		      	<option value="{{$type->id}}" {{ ( $type->id == $service_type_id) ? 'selected' : '' }}>{{$type->name}}</option>
                                    		   @endforeach
                                    		   @endif
                                        </select> 
                                        @error('service_type_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </form>
                                    </div>
                                </div>
                                <form id="quickForm" action="{{route('admin.service.store')}}"   method="POST" enctype="multipart/form-data">
                           @csrf
                            <div class="row m-2">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror @error('name') is-invalid @enderror mt-1" id="name" name="name" placeholder="Name" value="{{old('name')}}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>CA Share<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('ca_share') is-invalid @enderror @error('ca_share') is-invalid @enderror mt-1" id="ca_share" onkeypress="return isNumber(event)" name="ca_share" placeholder="CA Share" value="{{old('ca_share')}}">
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
                                        <select name="page_name" id="page_name" class="form-control @error('page_name') is-invalid @enderror mt-1 teg" >
                                                @if(!empty($routes))
                                    		    @foreach ($routes as $route)
                                    		      	<option value="{{$route->route}}" {{ ( $route->route == old('page_name')) ? 'selected' : '' }}>{{$route->page_name}}</option>
                                    		  
                                    		   @endforeach
                                    		   @endif
                                        </select> 
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group select2 ">
                                        <label class="">Required Documents</label>
                                        <div class="input-group-append">
                                            <select type="text" class=" w-100 select2-custom teg "  multiple="multiple" id="document_types_id" name="document_types_id[]">
                                             
                                                @if(!empty($docs)) 
                                                    @foreach($docs as $doc)
                                                        <option value="{{ $doc->id ?? ''  }}" {{ ( $doc->id == old('document_types_id')) ? 'selected' : '' }}>{{ $doc->name ?? ''  }}</option>
                                                    @endforeach
                                                 @endif
                            				  
                                            </select>
                                            
                                             
                                            </div>
                                    </div>
                                </div>
                               @php
                               if (isset($service_type_id) && !empty($service_type_id)){
                               $type = getService_type_status($service_type_id);
                               }
                               
                               
                                @endphp
                               <input type="hidden" name="service_type_id" value="{{$service_type_id ?? ''}}">
                                <div class="col-md-6">
                                    
                                        <label class="">Status</label>
                                        <div class="">
                                          
                         
                                        <select id="status_id" placeholder="Select Status" multiple name="status_id[]">
                                                @if(!empty(getStatus())) 
                                                    @foreach(getStatus() as $status)
                                                        <option value="{{ $status->id ?? ''  }}" {{  in_array($status->id,$type) ? 'selected' : '' }}>{{ $status->name ?? ''  }}</option>
                                                    @endforeach
                                                 @endif
                                            </select>

                                    </div>
                                </div>
                                 
                            <div class="col-md-3"></div>
                                
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
                                          <td style="width:10%;">
                                             <input value="1"  name="web_status[]" type="checkbox" id="switch1" switch="none" checked />      
                                        </td>
                                        <td style="width:20%;">
                                            <select name="category[]" id="category" class="form-control @error('category') is-invalid @enderror"  >
                                                <option value=" ">Select</option>
                                                <option value="Silver" selected>Silver</option>
                                                <option value="Gold">Gold</option>
                                                <option value="Platinum">Platinum</option>
                                            
                                            </select>         
                                        </td>
                                        
                                        <td style="width:20%;">
                                          <input type="text" class="form-control amount" placeholder="Price" id="price" name="price[]"  onkeypress="return isNumber(event)" required>
                                        </td>
                                        <td style="width: 60%">
                                            <textarea class="form-control ckeditor" name="short_des[]" id="short_des">{{$data ['short_des'] ?? ''}}</textarea>
                                          
                                        </td>
                                     <!--   <td>
                                          <div class="action_container">
                                           
                                                <button type="button" class="addmoreprodtxtbx btn btn-success" id="clonebtn"  ><i class="fa fa-plus-square"></i></button>
                                                <button type="button" id="removerow" class="removeprodtxtbx btn btn-danger"><i class="fa fa-trash"></i></button>
                                            
                                          </div>
                                        </td>-->
                                      </tr>
                                      <hr>
                                      <tr id="box2" >
                                          <td style="width:10%;">
                                             <input value="1"  name="web_status[]" type="checkbox" id="switch1" switch="none" checked />      
                                        </td>
                                        <td style="width:20%;">
                                            <select name="category[]" id="category" class="form-control @error('category') is-invalid @enderror"  >
                                                <option value=" ">Select</option>
                                                <option value="Silver" >Silver</option>
                                                <option value="Gold" selected>Gold</option>
                                                <option value="Platinum">Platinum</option>
                                            
                                            </select>         
                                        </td>
                                        
                                        <td style="width:20%;">
                                          <input type="text" class="form-control amount" placeholder="Price" id="price" name="price[]"  onkeypress="return isNumber(event)" required>
                                        </td>
                                        <td style="width: 60%">
                                            <textarea class="form-control ckeditor" name="short_des[]" id="short_des">{{$data ['short_des'] ?? ''}}</textarea>
                                          
                                        </td>
                                     <!--   <td>
                                          <div class="action_container">
                                           
                                                <button type="button" class="addmoreprodtxtbx btn btn-success" id="clonebtn"  ><i class="fa fa-plus-square"></i></button>
                                                <button type="button" id="removerow" class="removeprodtxtbx btn btn-danger"><i class="fa fa-trash"></i></button>
                                            
                                          </div>
                                        </td>-->
                                      </tr>
                                      
                                      <tr id="box2" >
                                          <td style="width:10%;">
                                             <input value="1"  name="web_status[]" type="checkbox" id="switch1" switch="none" checked />      
                                        </td>
                                        <td style="width:20%;">
                                            <select name="category[]" id="category" class="form-control @error('category') is-invalid @enderror"  >
                                                <option value=" ">Select</option>
                                                <option value="Silver">Silver</option>
                                                <option value="Gold">Gold</option>
                                                <option value="Platinum" selected>Platinum</option>
                                            </select>         
                                        </td>
                                        <td style="width:20%;">
                                          <input type="text" class="form-control amount" placeholder="Price" id="price" name="price[]"  onkeypress="return isNumber(event)" required>
                                        </td>
                                        <td style="width: 60%">
                                            <textarea class="form-control ckeditor" name="short_des[]" id="short_des">{{$data ['short_des'] ?? ''}}</textarea>
                                        </td>
                                     <!--   <td>
                                          <div class="action_container">
                                                <button type="button" class="addmoreprodtxtbx btn btn-success" id="clonebtn"  ><i class="fa fa-plus-square"></i></button>
                                                <button type="button" id="removerow" class="removeprodtxtbx btn btn-danger"><i class="fa fa-trash"></i></button>
                                            
                                          </div>
                                        </td>-->
                                      </tr>
                                    </tbody>
                                     
                                </table>
                                </div>
                                
                                                  
                               
                                
                            <div class="row m-2">
                                <div class="col-md-2 mt-2">
                                    <label for="switch1" data-on-label="Active" data-off-label="Inactive">Status</label>
                                    <div class="check-box mt-2">
                                     <input value="1"  name="status" type="checkbox" id="switch1" switch="none" checked/>
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
                                    <button type="submit" class="btn btn-success btn-lg pl-3 pr-3">Save</button>
                                </div>
                            </div>
                        </form>
                         </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<link rel="stylesheet" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>


<script>
    
$(document).ready(function() {
 $('#trColor tr').click(function() {
   $(this).css('backgroundColor', '#6639b5c4');
  $( this ).siblings().css( "background-color", "white" );
});
    
    count=0;
      $( ".removeprodtxtbx" ).eq( 0 ).css( "display", "none" );
    $(document).on("click", "#clonebtn", function() {
       count++;
        //we select the box clone it and insert it after the box
        $('#box2').addClass('rowTr')
        $('#box2').clone().appendTo('#table_body')
       $('.rowTr').last().addClass('rowTr1')
       //  $('#box2').find('#removerow').addClass("buttondel")
          
   
        // $('.buttondel').css('visibility', 'visible')
      
         $( ".removeprodtxtbx" ).eq( count ).css( "display", "block" );
         $( ".addmoreprodtxtbx" ).eq( count ).css( "display", "none" );
         $( ".pay_amt" ).eq( count ).val("");
          
    });
    
    $(document).on("click", "#removerow", function() {
        $(this).parents("#box2").remove();
        $('#removerow').focus();
        count--;
    });
    
      $(document).on("click", "#closeModal", function() {
$( "tr" ).remove( ".rowTr1" );
 $( ".pay_amt" ).val("");
 $( "#pay_amt" ).val("");
count=0;
    });
    
});


    $('#service_type_id').on('change', function(e){
            
        	var service_type_id = $(this).val();
            $.ajax({
                 headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        	  url: '/admin/service_type_status/'+service_type_id,
        	  success: function(data){
        	      $('#status_id').html(data);
        		//	$("#status_id").html(data);
        	  }
        	});
        	
        });
       
</script>

<style>
  .Label_top {
    margin-top: 25px;
  }
</style>
<link rel="stylesheet" href="{{ asset('public/assets/dropify.css') }}">
<script src="{{URL::asset('public/assets/ckeditor/ckeditor.js')}}"></script>
<script src="{{URL::asset('public/assets/dropify.js')}}"></script>
<script src="{{URL::asset('public/assets/dropify1.js')}}"></script>

<script>
  CKEDITOR.editorConfig = function (config) {
    config.extraPlugins = 'confighelper';
  };
  CKEDITOR.replace('editor1');



$(document).ready(function(){

 var multipleCancelButton = new Choices('#status_id', {
 removeItemButton: true,
 maxItemCount:30,
 searchResultLimit:50,
 renderChoiceLimit:50
 });


 });
</script>



@endsection