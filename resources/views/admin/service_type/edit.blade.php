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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Edit Services Type</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/service_type') }}" class="btn bbtn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                <a href="{{ URL::previous() }}" class="btn bbtn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                
                            </div>

                        </div>
                        
                              {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.service_type.update', $data->id]]) !!}
                           @csrf
                            <div class="row m-2">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror @error('name') is-invalid @enderror mt-1" id="name" name="name" placeholder="Name" value="{{old('name',$data->name) ?? '' }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                
                                @php
                                
                                 $status_id = array();
                                if($data['status_id'] > 0){ 
                                $val = $data['status_id'];
                                $status_id = explode(',', $val);
                         }
                         
                          $required_field = array();
                                if(!empty($data['required_field'])){ 
                               
                                $required_field = explode(',', $data['required_field']);
                         
                         }
                        @endphp
                               <div class="col-md-3">
                                    <div class="form-group select2 ">
                                        <label class="">Status</label>
                                        <div class="input-group-append">
                                            <select type="text" class=" w-100 select2-custom teg "  multiple="multiple" id="status_id" name="status_id[]">
                                             
                                                @if(!empty($status)) 
                                                    @foreach($status as $status)
                                                        <option value="{{ $status->id ?? ''  }}" @if(in_array($status->id,$status_id)) selected="" @endif>{{ $status->name ?? ''  }}</option>
                                                    @endforeach
                                                 @endif
                            				  
                                            </select>
                                            
                                            
                                            </div>
                                    </div>
                                </div>
                              
                                </div>
                                
                                
                                
                                
                                <div class="col-md-2">
                                     <h5>Web permission</h5>
                                    
                                
                                <input type="checkbox" id="cin" name="required_field[]" value="cin" class="change"    @if(in_array("cin",$required_field)) checked=""  @endif />

                                <label for="cin"><b> Cin Number</b></label><br>
                                 <input type="checkbox" id="company" name="required_field[]" value="company_name" class="change"  @if(in_array("company_name",$required_field)) checked=""  @endif>
                                <label for="company"><b> Company Name </b></label><br>
                                 <input type="checkbox" id="cin_date" name="required_field[]" value="cin_date" class="change" @if(in_array("cin_date",$required_field)) checked=""  @endif>
                                <label for="cin_date"><b>Cin Date </b></label><br>
                                 <input type="checkbox" id="first_name" name="required_field[]" value="first_name" class="change" @if(in_array("first_name",$required_field)) checked=""  @endif>
                                <label for="first_name"><b> First Name </b></label><br>
                                 <input type="checkbox" id="last_name" name="required_field[]" value="last_name" class="change" @if(in_array("last_name",$required_field)) checked=""  @endif>
                                <label for="last_name"><b> Last Name </b></label><br>
                                 <input type="checkbox" id="father_name"  name="required_field[]" value="fathers_name" class="change" @if(in_array("fathers_name",$required_field)) checked=""  @endif>
                                <label for="father_name"><b> Father Name </b></label><br>
                                 <input type="checkbox" id="gander"  name="required_field[]" value="gender" class="change" @if(in_array("gender",$required_field)) checked=""  @endif>
                                <label for="gander"><b> Gander </b></label><br>
                                 <input type="checkbox" id="date_of_birth" name="required_field[]" value="dob" class="change" @if(in_array("dob",$required_field)) checked=""  @endif>
                                <label for="date_of_birth"><b> Date of Birth </b></label><br>
                                 <input type="checkbox" id="pan_number"  name="required_field[]" value="pan_no" class="change" @if(in_array("pan_no",$required_field)) checked=""  @endif>
                                <label for="pan_number"><b>Pan Number</b></label><br>
                                 <input type="checkbox" id="aadhar_number"  name="required_field[]" value="aadhar_no" class="change" @if(in_array("aadhar_no",$required_field)) checked=""  @endif>
                                <label for="aadhar_number"><b>Aadhar Number</b></label><br>
                                 <input type="checkbox" id="area"  name="required_field[]" value="area" class="change" @if(in_array("area",$required_field)) checked=""  @endif>
                                <label for="area"><b>Area</b></label><br>
                                 <input type="checkbox" id="pin_code"  name="required_field[]" value="pincode" class="change" @if(in_array("pincode",$required_field)) checked=""  @endif>
                                <label for="pin_code"><b>Pin Code</b></label><br>
                                 <input type="checkbox" id="state"  name="required_field[]" value="state" class="change" @if(in_array("state",$required_field)) checked=""  @endif>
                                <label for="state"><b>State</b></label><br>
                                 <input type="checkbox" id="city"  name="required_field[]" value="city" class="change" @if(in_array("city",$required_field)) checked=""  @endif>
                                <label for="city"><b>City</b></label><br>
                                 <input type="checkbox" id="email"  name="required_field[]" value="email" class="change" @if(in_array("email",$required_field)) checked=""  @endif>
                                <label for="email"><b>Email</b></label><br>
                                 <input type="checkbox" id="code"  name="required_field[]" value="code" class="change" @if(in_array("code",$required_field)) checked=""  @endif>
                                <label for="code"><b>Code</b></label><br>
                                 <input type="checkbox" id="mobile_number"  name="required_field[]" value="mobile" class="change" @if(in_array("mobile",$required_field)) checked=""  @endif>
                                <label for="mobile_number"><b>Mobile Number</b></label><br>
                                 <input type="checkbox" id="Ifsc" name="required_field[]" value="ifsc" class="change" @if(in_array("ifsc",$required_field)) checked=""  @endif>
                                <label for="Ifsc"><b>Ifsc</b></label><br>
                                 <input type="checkbox" id="bank_name" name="required_field[]" value="bank_name" class="change" @if(in_array("bank_name",$required_field)) checked=""  @endif>
                                <label for="bank_name"><b>Bank Name</b></label><br>
                                 <input type="checkbox" id="bank_account_no"  name="required_field[]" value="bank_account_no" class="change" @if(in_array("bank_account_no",$required_field)) checked=""  @endif>
                                <label for="bank_account_no"><b>Bank Account No</b></label><br>
                                
                                    
                                    
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

<style>
  .Label_top {
    margin-top: 25px;
  }
  
  .change{
      appearance: auto !important;
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