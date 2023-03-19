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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Create Email Template</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/templete_view') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                    <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                <!--<a href="https://www.school.rukmanisoftware.com/account_dashboard" class="btn btn-primary  btn-sm"><i class="fa fa-arrow-left"></i> Back</a>-->
                            </div>

                        </div>
                        <form id="quickForm" action="{{route('admin.templete_view.store')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row m-2">
                                 <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Template type <span class="required" style="color:red;">*</span></label> 
                                    <select class="form-control " name="category" id="category" >
                                         <option value="" >select</option>
                                         
                                    <option value="rm_assign" {{ ( "rm_assign" == old('category') ?? '') ? 'selected' : '' }}>Rm Assign</option>
                                    <option value="rm_assign_users_email" {{ ( "rm_assign_users_email" == old('category') ?? '') ? 'selected' : '' }}>Rm Assign Users Email</option>
                                    <option value="ca_assign" {{ ( "ca_assign" == old('category') ?? '') ? 'selected' : '' }}>Ca Assign</option>
                                    <option value="ca_assign_users_email" {{ ( "ca_assign_users_email" == old('category') ?? '') ? 'selected' : '' }}>Ca Assign Users Email</option>
                                    <option value="ca_assign_rm_email" {{ ( "ca_assign_rm_email" == old('category') ?? '') ? 'selected' : '' }}>Ca Assign Rm Email</option>
                                    <option value="rm_chat" {{ ( "rm_chat" == old('category') ?? '') ? 'selected' : '' }}>Rm chat</option>
                                    <option value="ca_chat" {{ ( "ca_chat" == old('category') ?? '') ? 'selected' : '' }}>Ca chat</option>
                                    <option value="users_chat" {{ ( "users_chat" == old('category') ?? '') ? 'selected' : '' }}>Users chat</option>
                                    
                                    
                                    
                                          
                                      
                                        	@error('category')
                        						<span class="invalid-feedback" role="alert">
                        							<strong>{{ $message }}</strong>
                        						</span>
                        					@enderror
                                      </select>
                                </div>
                            </div>
                                <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Title <span class="required" style="color:red;">*</span></label> 
                                    <input class="form-control " name="title" id="title"  value="{{old('title') ?? ''}}">
                                          
                                      
                                        	@error('title')
                        						<span class="invalid-feedback" role="alert">
                        							<strong>{{ $message }}</strong>
                        						</span>
                        					@enderror
                                      
                                </div>
                            </div>
                                
                              
                            </div>
                              <div class="col-md-12">
                                 <table class="_table" id="tableId"style="width: 85%;margin-left: 8%;margin-top: 5%;">
                                    <thead>
                         
                                    </thead>
                                    <tbody id="table_body" >
                                      <tr id="box2" >
                            
                                        <td >
                                            <textarea class="form-control ckeditor" name="email_description" id="email_description"></textarea>
                                          
                                        </td>
                                   
                                      </tr>
                                    
                                    </tbody>
                                     
                                </table>
                                </div>
                            <div class="row m-2">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success btn-lg"> Save </button>
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