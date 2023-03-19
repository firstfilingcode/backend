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
                                <a href="{{url ('admin/service_sub_type') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                <!--<a href="https://www.school.rukmanisoftware.com/account_dashboard" class="btn btn-primary  btn-sm"><i class="fa fa-arrow-left"></i> Back</a>-->
                            </div>

                        </div>
                        <form id="quickForm" action="{{route('admin.service_sub_type.store')}}"   method="POST" enctype="multipart/form-data">
                           @csrf
                            <div class="row m-2">
                                <div class="col-md-3">
                                     <label>Service Type<span style="color:red;">*</span></label>
                                    <select name="service_type_id" id="service_type_id" class="form-control @error('service_type_id') is-invalid @enderror mt-1" >
                                        @if(!empty(getService_type()))
                                        <option value="" >Select Service Type</option>
                            		    @foreach (getService_type() as $type)
                            		      	<option value="{{$type->id}}" {{ ( $type->id == old('service_type_id')) ? 'selected' : '' }}>{{$type->name}}</option>
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
                                     <label>Service Type Dropdown</label>
                                    <select name="service_type_dropdown_id" id="service_type_dropdown_id" class="form-control @error('service_type_dropdown_id') is-invalid @enderror mt-1" >
                                        @if(!empty(getservice_type_dropdown()))
                                        <option value="" >Select Service Type Dropdown</option>
                            		    @foreach (getservice_type_dropdown() as $type1)
                            		      	<option value="{{$type->id}}" {{ ( $type1->id == old('service_type_id')) ? 'selected' : '' }}>{{$type1->name}}</option>
                            		   @endforeach
                            		   @endif
                                        </select> 
                                        @error('service_type_dropdown_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror  
                                </div>
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
    </section>
</div>

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

</script>



@endsection