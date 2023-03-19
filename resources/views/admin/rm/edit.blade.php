@extends('admin.layouts.app')
@section('title')
Update User
@endsection
@php
$sidebar = DB::table('sidebars')->get();
$sidebar_sub_menu = DB::table('sidebar_sub_menus')->get();

@endphp

@section('content')
<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Edit Rm</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/rm') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>

                        </div>
                        {!! Form::model($user, ['method' => 'PATCH','route' => ['admin.rm.update', $user->id]]) !!}
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="addproduct-accordion" class="custom-accordion">

                                    <div id="addproduct-billinginfo-collapse" class="collapse show"
                                        data-parent="#addproduct-accordion">
                                        <div class="p-4 border-top">
                                            <div class="row">
                                                
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Role <span class="required"
                                                                style="color:red;">*</span></label>
                                                        <select class="form-control" name="role_id" id="role_id">
                                                            <option value="">select</option>
                                                            @if(!empty(getRole()))
                                                            @foreach(getRole() as $role)
                                                            <option value="{{ $role->id ?? ''  }}" {{ (
                                                                $role['id']==old('role_id',$user->role_id)) ? 'selected' : '' }}>{{
                                                                $role->name ?? '' }}</option>
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
                                                        <label for="name">Name <span class="required"
                                                                style="color:red;">*</span></label>
                                                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" id="name" name="name" value="{{old('name') ?? $user['name']}}">
                                                        
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="manufacturerbrand">Email <span class="required"
                                                                style="color:red;">* User Name</span></label>
                                                         <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" name="email" value="{{old('email',$user['email']) ?? ''}}">
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="mobile">Mobile <span class="required"
                                                                style="color:red;">*</span></label>
                                                        <input type="text" class="form-control @error('mobile') is-invalid @enderror" placeholder="Mobile" id="mobile" name="mobile" onkeypress="return isNumber(event)" value="{{old('mobile',$user['mobile']) ?? ''}}">
                                                        @error('mobile')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>

                                               
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="dob">DOB <span class="required"
                                                                style="color:red;">*</span></label>
                                                     <input type="date" class="form-control @error('dob') is-invalid @enderror" placeholder="DOB" id="dob" name="dob" value="{{old('dob',$user['dob']) ?? ''}}">
                                                       @error('dob')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    
                                                                      <div class="form-group"> 
                                                					<label for="name">Password <span class="required"
                                                                    style="color:red;">*</span></label>
                                                					
                                                					<div class="input-group">
                                                                    <input type="password" class="form-control input-psswd @error('password') is-invalid @enderror"name="password" placeholder="Password" psswd-shown="false"  value="{{old('password',$user['show_password']) ?? ''}}" style="background-color: #fff;">
                                                                    <div class="input-group-append">
                                                                      <button class="button-psswd" type="button" style="border-bottom: 1.8px solid #908e8e; border-radius: 0;"><i class="fa fa-eye"></i></button>  
                                                                     </div>
                                                                  </div>
                                                				</div>      
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="required">Upload Image</label>
                                                        <input type="file" class="form-control" name="photo">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 aadhar_no" style="display:none">
                                                    <label>Aadhar Number</label>
                                                    <input type="text" class="form-control" id="aadhar_no"
                                                        name="aadhar_no" placeholder="Aadhar No."
                                                        value="{{old('aadhar_no',$user['aadhar_no']) ?? ''}}"
                                                        onkeypress="return isNumber(event)">

                                                </div>
                                                <div class="col-md-3 aaadhar_image" style="display:none">
                                                    <label>Aadhar Card Image</label>
                                                    <input type="file" class="form-control" id="aadhar_image"
                                                        name="aadhar_image" value="old('aadhar_image',$user['aadhar_no'])">
                                                </div>
                                                <div class="col-md-3 cpo_certificate" style="display:none">
                                                    <label>CPO Certificate</label>
                                                    <input type="file" class="form-control" id="cpo_certificate"
                                                        name="cpo_certificate" value="{{old('cpo_certificate',$user['aadhar_no'])}}">
                                                </div>
                                                <div class="col-md-3 membership_certificate" style="display:none">
                                                    <label>Membership Certificate</label>
                                                    <input type="file" class="form-control" id="membership_certificate"
                                                        name="membership_certificate"
                                                        value="{{old('membership_certificate',$user['aadhar_no'])}}">
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="address">Address <span class="required"
                                                                style="color:red;">*</span></label>
                                                        <textarea id="address" name="address" placeholder="Address"
                                                            class="form-control">{{old('address',$user['address']) ?? ''}}</textarea>
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                 @php
                               
                            $Sidebar = array();
                            if(!empty($permission)){
                                if($permission->sidebar_id > 0){ 
                                $val = $permission->sidebar_id;
                                $Sidebar = explode(',', $val);
                         }
                         }
                         
                         $SidebarSub = array();
                            if(!empty($permission)){
                                if($permission->sub_menu_id > 0){ 
                                $SidebarSub = explode(',', $permission->sub_menu_id);
                         }
                         }
                        @endphp
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Sidebar Permission <span class="required" style="color:red;">*</span></label>
                                                                        @if(!empty($sidebar)) 
                                                                            @foreach($sidebar as $sideba)
                                                                            <div class="custom-control custom-checkbox">
                                                                            <input name="sidebar_id[]" class="custom-control-input custom-control-input-primary custom-control-input-outline checkbox chkPassport" type="checkbox" id="{{ $sideba->id ?? '' }}" @if(in_array($sideba->id,$Sidebar)) checked="" @endif value="{{ $sideba->id ?? '' }}">
                                                                            <label for="{{ $sideba->id ?? '' }}" class="custom-control-label pointer">{{ $sideba->name ?? '' }}</label>
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
                                                                            @foreach($sidebar_sub_menu as $sidebar_sub)
                                                                            <div class="custom-control custom-checkbox subShow_{{ $sidebar_sub->sidebar_id ?? '' }}"  @if(in_array($sidebar_sub->sidebar_id,$Sidebar)) checked="" @else style="display:none" @endif >
                                                                            <input name="sub_menu_id[]" class="custom-control-input custom-control-input-primary custom-control-input-outline checkbox" type="checkbox" id="id_{{ $sidebar_sub->id ?? '' }}" @if(in_array($sidebar_sub->id,$SidebarSub)) checked=""  @endif value="{{ $sidebar_sub->id ?? '' }}">
                                                                            <label for="id_{{ $sidebar_sub->id ?? '' }}" class="custom-control-label pointer">{{ $sidebar_sub->name ?? '' }}</label>
                                                                            </div>                                              
                                                                            @endforeach
                                                                        @endif                                            
                                                                    </div>
                                                                </div>
                                                                
                                                               <!-- <div class="col-md-3">
                                                                    <label>&nbsp;</label>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-primary d-inline">
                                                                            <input type="checkbox" id="select_all" name="" value="4" class="checkbox chkPassport">
                                                                            <label for="select_all">Select All</label>
                                                                        </div>
                                                                    </div>                            
                                                                </div>-->
                                               		                       
                                                            </div>         

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col text-center">
                                <button type="submit" class="btn btn-success btn-lg pl-3 pr-3 mt-3 mb-3 "><i
                                        class="uil uil-file-alt mr-1"></i> Save</button>
                            </div>
                        </div>


                    </div>


                </div>


            </div>


            <!-- end row -->
            {!! Form::close() !!}
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
    
    $("#role_id").click(function(){
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
</script>
@endsection