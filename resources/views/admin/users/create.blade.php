@extends('admin.layouts.app')
@section('title') Add User @endsection
@php
$sidebar = DB::table('sidebars')->get();
$sidebar_sub_menu = DB::table('sidebar_sub_menus')->get();

@endphp

@section('content')

<style>
    .pass1{
        display:none;
    }
</style>
<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Create Users</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/users') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>

                        </div>
                              {!! Form::open(array('route' => 'admin.users.store','method'=>'POST')) !!}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="addproduct-accordion" class="custom-accordion">
                                            
                                                <div id="addproduct-billinginfo-collapse" class="collapse show" data-parent="#addproduct-accordion">
                                                    <div class="p-4 border-top">
                                                            <div class="row">
                                                                 <!--<div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Branch Name <span class="required" style="color:red;">*</span></label> 
                                                                        <select name="branch_name" id="branch_name" class="form-control">
                                                                        <option value="select">select</option></select>
                                                                    </div>
                                                                </div>-->
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Role <span class="required" style="color:red;">*</span></label> 
                                                                        <select class="form-control role_id" name="role_id" id="role_id" >
                                                                             <option value="" >select</option>
                                                                              @if(!empty(getRole())) 
                                                                                  @foreach(getRole() as $role)
                                                                                     <option value="{{ $role->id ?? ''  }}" {{ ( $role['id'] == old('role_id')) ? 'selected' : '' }}>{{ $role->name ?? ''  }}</option>
                                                                                  @endforeach
                                                                              @endif
                                                                          
                                                                          
                                                                            	@error('role_id')
                                                            						<span class="invalid-feedback" role="alert">
                                                            							<strong>{{ $message }}</strong>
                                                            						</span>
                                                            					@enderror
                                                                          </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="name">Name <span class="required" style="color:red;">*</span></label>
                                                                        {!! Form::text('name', null, array('class' => 'form-control','placeholder' => 'Name')) !!}
                            											@if ($errors->has('name'))
                                    									<span class="error text-danger">{{ $errors->first('name') }}</span>
                                            							@endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">                                        
                                                                    <div class="form-group">
                                                                        <label for="manufacturerbrand">Email <span class="required" style="color:red;">* User Name</span></label>
                                                                        {!! Form::text('email', null, array('class' => 'form-control','placeholder' => 'Email')) !!}
                            											@if ($errors->has('email'))
                                    									<span class="error text-danger">{{ $errors->first('email') }}</span>
                                    									@endif
                                                                    </div>
                                                                </div>  
                                                                
                                                                 <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="mobile">Mobile <span class="required" style="color:red;">*</span></label>
                                                                        {!! Form::text('mobile', null, array('class' => 'form-control','placeholder' => 'Mobile','maxlength'=>10, 'onkeypress'=>'return isNumber(event)')) !!}
                            											@if ($errors->has('mobile'))
                                    									<span class="error text-danger" >{{ $errors->first('mobile') }}</span>
                                            							@endif
                                                                    </div>
                                                                </div>
                                                                
                                                              
                                                                 <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="dob">DOB <span class="required" style="color:red;">*</span></label>
                                                                        {!! Form::date('dob', null, array('class' => 'form-control','placeholder' => 'DOB')) !!}
                            											@if ($errors->has('dob'))
                                    									<span class="error text-danger">{{ $errors->first('dob') }}</span>
                                            							@endif
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-3">
                                                                    <div class="form-group"> 
                                                					<label>Password</label>
                                                					
                                                					<div class="input-group">
                                                                    <input type="password" class="form-control input-psswd input1 @error('password') is-invalid @enderror" placeholder="Password" psswd-shown="false"  name="password" value="{{old('password')}}" style="background-color: #fff;">
                                                                    <div class="input-group-append">
                                                                      <button class="button-psswd" type="button" style="border-bottom: 1.8px solid #908e8e; border-radius: 0;"><i class="fa fa-eye"></i></button>  
                                                                     </div>
                                                                  </div>
                                                                  	@if ($errors->has('password'))
                            									       <span class="error text-danger">{{ $errors->first('password') }}</span>
                            									       @endif
                                                				</div>
                                                                    
                                                                    
                                                                   <!-- <div class="form-group">
                                                                        <label for="name">Password <span class="required" style="color:red;">*</span></label>
                                                                        <div class="input-group mb-3">
                                                                              <input type="password" class="form-control pass" placeholder="Password" id="password" name="password">
                                                                              <div class="input-group-append" id="open1">
                                                                                <div class="input-group-text">
                                                                                  <i id="hide" class="fa fa-eye-slash"></i>
                                                                                  <i id="show" class="pass1"></i>
                                                                                </div>
                                                                              </div> 
                                                                            </div>  
                                                                        
                            										
                                                                    </div>-->
                                                                </div>
                                                                <div class="col-md-3">
                                                        				    <div class="form-group"> 
                                                        					 <label class="required">Upload Image</label>
                                                                             <input type="file" class="form-control"   name="photo">	
                                                        					 </div>
                                                        		</div>  
                                                                <div class="col-md-3 aadhar_no"style="display:none">
                                                                    <label>Aadhar Number</label>
                                                                    <input type="text" class="form-control" id="aadhar_no" name="aadhar_no" placeholder="Aadhar No." value="{{old('aadhar_no')}}" onkeypress="return isNumber(event)">
                                                                    
                                                                </div>
                                                                <div class="col-md-3 aaadhar_image"style="display:none">
                                                                    <label>Aadhar Card Image</label>
                                                                    <input type="file" class="form-control" id="aadhar_image" name="aadhar_image" value="old('aadhar_image')">
                                                                </div> 
                                                                <div class="col-md-3 cpo_certificate" style="display:none">
                                                                    <label>CPO Certificate</label>
                                                                    <input type="file" class="form-control" id="cpo_certificate" name="cpo_certificate" value="{{old('cpo_certificate')}}">
                                                                </div>
                                                                <div class="col-md-3 membership_certificate" style="display:none">
                                                                    <label>Membership Certificate</label>
                                                                    <input type="file" class="form-control" id="membership_certificate" name="membership_certificate" value="{{old('membership_certificate')}}">
                                                                </div>
                                                                
                                                                 <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="address">Address <span class="required" style="color:red;">*</span></label>
                                                                        <textarea id="address" name="address" placeholder="Address" class="form-control"></textarea>
                                                                     
                            											@if ($errors->has('address'))
                                    									<span class="error text-danger">{{ $errors->first('address') }}</span>
                                            							@endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="status">Status</label><br>
                                                                        <input class="mt-2"value="0"  name="status" type="checkbox" id="switch1" switch="none"  style="width:45px"checked/>
                                                                         <label for="switch1" data-on-label="Active" data-off-label="Inactive"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Sidebar Permission <span class="required" style="color:red;">*</span></label>
                                                                        @if(!empty($sidebar)) 
                                                                            @foreach($sidebar as $sidebar)
                                                                            <div class="custom-control custom-checkbox">
                                                                            <input name="sidebar_id[]" class="custom-control-input custom-control-input-primary custom-control-input-outline checkbox chkPassport" type="checkbox" id="sidebar{{$sidebar->id ?? '' }}" value="{{ $sidebar->id ?? '' }}">
                                                                            <label for="sidebar{{$sidebar->id ?? '' }}" class="custom-control-label pointer">{{ $sidebar->name ?? '' }}</label>
                                                                            </div>                                                
                                                                            @endforeach
                                                                        @endif
                                        
                                                                        @error('sidebar_id')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror                       
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="col-md-3">
                                                                    <div class="form-group" id="webSetting" >
                                                                        <label>Sidebar Sub Module </label>
                                                                        @if(!empty($sidebar_sub_menu)) 
                                                                            @foreach($sidebar_sub_menu as $sidebar_sub_menu)
                                                                            <div class="custom-control custom-checkbox ">
                                                                            <input name="sub_menu_id[]" class="custom-control-input custom-control-input-primary custom-control-input-outline checkbox2" type="checkbox" id="id_{{ $sidebar_sub_menu->id ?? '' }}" value="{{ $sidebar_sub_menu->id ?? '' }}">
                                                                            <label for="id_{{ $sidebar_sub_menu->id ?? '' }}" class="custom-control-label pointer">{{ $sidebar_sub_menu->name ?? '' }}</label>
                                                                            </div>                                              
                                                                            @endforeach
                                                                        @endif                                            
                                                                    </div>
                                                                </div>
                                                                
                                                              
                                               		                       
                                                            </div>                                
                                                            
                                                    </div>
                                                </div>
                                            </div>
                            			</div>
                                    </div>
                                
                                <!-- end row -->
                                <div class="row mb-4">
                                    <div class="col text-center">
                            			 <button type="submit" class="btn btn-success btn-lg pl-3 pr-3"><i class="uil uil-file-alt mr-1"></i> Save</button>            
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            	{!! Form::close() !!}
	    </div>
                </div>
            </div>
	     </div>
    </section>
</div>


<script>
    $(document).ready(function() {
    
    $('.button-psswd').on('click', function() {
        
        if ($('.input-psswd').attr('psswd-shown') == 'false') {
            
            $('.input-psswd').removeAttr('type');
            $('.input-psswd').attr('type', 'text');
            
            $('.input-psswd').removeAttr('psswd-shown');
            $('.input-psswd').attr('psswd-shown', 'true');
            
            $('.button-psswd').html('<i class="fa fa-eye-slash"></i>');
            
        }else {
            
            $('.input-psswd').removeAttr('type');
            $('.input-psswd').attr('type', 'password');
            
            $('.input-psswd').removeAttr('psswd-shown');
            $('.input-psswd').attr('psswd-shown', 'false');
            
            $('.button-psswd').html('<i class="fa fa-eye"></i>');
            
        }
        
    });
    
});
</script>
<script>

        $(".chkPassport").click(function () {
            var sidebar_id = $(this).val();
            
            if(sidebar_id > 0  && $(this).is(":checked")){
                $("#webSetting").show();
                $(".subShow_"+sidebar_id).show();
            }else{
               // $("#webSetting").hide();
                $(".subShow_"+sidebar_id).hide();
            }
            /*if ($(this).is(":checked")) {
                $("#webSetting").show();
            } else {
                $("#webSetting").hide();
        }*/
    });
    
    $(".role_id").click(function(){
        var roles = $(this).val();
      if(roles > 0){
        if(roles == '2'){
            $(".aadhar_no").show();
            $(".aaadhar_image").show();
            $(".cpo_certificate").hide();
            $(".membership_certificate").hide();
            $(".parent_id").hide();
            }else if(roles == '3'){
                $(".cpo_certificate").show();
                $(".membership_certificate").show();
                $(".parent_id").show();
                $(".aadhar_no").hide();
                $(".aaadhar_image").hide();
            }else{
                $(".aadhar_no").hide();
                $(".aaadhar_image").hide();
                $(".cpo_certificate").hide();
                $(".membership_certificate").hide();
                $(".parent_id").hide();
            }
        
    }
    });
    
        
$( "#role_id" ).change(function() {
    
    var role_id = $(this).val()
 user_Sub_side_per(role_id);
    $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
    $.ajax({
        type: "POST",
        url: "/admin/user_side_per",
        data: {role_id:role_id},
        dataType: "html",
        success: function (response) {
              $(".checkbox").prop('checked', false);
         var side_bar = response;
          var words = side_bar.split(",");


        for(var i=0; i<=words.length; i++)
         {
            $("#sidebar"+words[i]).prop('checked', true);
         }
         
        },

    });  
});

function user_Sub_side_per(user_Sub_side_per) {
    
    
    $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
    $.ajax({
        type: "POST",
        url: "/admin/user_side_per",
        data: {user_Sub_side_per:user_Sub_side_per},
        dataType: "html",
        success: function (response) {
              $(".checkbox2").prop('checked', false);
         var side_bar = response;
          var sub_words = side_bar.split(",");


        for(var i=0; i<=sub_words.length; i++)
         {
            $("#id_"+sub_words[i]).prop('checked', true);
         }
         
        },

    });  
};
</script>
<style>

    input[type="checkbox"] {
  position: relative;
  appearance: none;
  width: 9px;
  height: 20px;
  background: #ccc;
  border-radius: 50px;
  box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
  cursor: pointer;
  transition: 0.4s;
}
</style>
@endsection
