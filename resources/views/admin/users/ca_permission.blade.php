@extends('admin.layouts.app')
@section('title')
Update Password
@endsection
@section('css')        
    <link href="{{ URL::asset('assets/libs/dropify/dropify.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
{!! Form::model($user, ['method' => 'POST','route' => ['admin.ca_permission'],'class'=>'section general-info','id'=>'general-info','files' => true]) !!}
    <div class="content-wrapper" style="min-height: 222px;">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div id="addproduct-accordion" class="custom-accordion">
                        <div class="card">
                            <div id="addproduct-billinginfo-collapse" class="collapse show" data-parent="#addproduct-accordion">
                                <div class="p-4 border-top">
        								                        
                                         <div class="row">
                                            <div class="col-lg-4">
                                                
                                                <div class="form-group">
        											    <div class="form-group">
                                                            <label for="ca_share_pass">Ca Share Password <span class="required" style="color:red;">*</span></label>
                                                                <div class="input-group mb-3">
                                                                    <input type="password" class="form-control pass" placeholder="Ca Share Password" id="ca_share_pass"value="{{old('ca_share_pass',$user['ca_share_pass'] ) ?? ''}}" name="ca_share_pass">
                                                                         <div class="input-group-append" id="open1">
                                                                            <div class="input-group-text">
                                                                                 <i id="hide" class="fa fa-eye-slash"></i>
                                                                                 <i id="show" class="pass1"></i>
                                                                             </div>
                                                                        </div> 
                                                                    </div>  
                                                            
                            									@if ($errors->has('ca_share_pass'))
                            								<span class="error text-danger">{{ $errors->first('ca_share_pass') }}</span>
                            							 @endif
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            
                                            <div class="row">
                                            <div class="col-md-4 mt-2">
                                                <label for="switch1" data-on-label="Active" data-off-label="Inactive">Dashboard Click Permission</label>
                                                <div class="check-box mt-2">
                                                 <input value="1"  name="click_permission" type="checkbox" id="switch1" switch="none" {{ ( $user['click_permission'] == 1) ? 'checked' : '' }}/>
                                                </div>
                                                @error('click_permission')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                          </div>
                                        </div>
        								
        																	
                                        </div>
        								<div class="row mb-4">
                                            <div class="col text-center">
                                                
                                    			 <button type="submit" class="btn btn-success"><i class="uil uil-file-alt mr-1"></i> Save</button>            
                                            </div> <!-- end col -->
                                        </div> <!-- end row-->
        							
        
                                   
                                </div>
                            </div>
                        </div>
        			</div>
                </div>
            </div>
            
            <!-- end row -->
        
            
            </div>
    </section>
</div>
	{!! Form::close() !!}
@endsection
@section('script')
	<script src="{{ URL::asset('assets/libs/dropify/dropify.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/dropify.js')}}"></script>
	<script src="{{URL::asset('assets/libs/ckeditor/ckeditor.js')}}"></script>
	<script>
	CKEDITOR.editorConfig = function (config) {
    config.extraPlugins = 'confighelper';
  };
  CKEDITOR.replace('editor1');

	</script>
	
	<script>
$(document).ready(function(){
 $("#open1").click(function(){

    if($("i").hasClass("fa fa-eye-slash")){
        $(".pass").attr('type','text');
        $("#hide").addClass('pass1');
        $("#hide").removeClass('fa fa-eye-slash');
        $("#show").removeClass('pass1');
        $("#show").addClass('fa fa-eye');
    }else{
        $(".pass").attr('type','password');
        $("#show").addClass('pass1');
        $("#show").removeClass('fa fa-eye');
        $("#hide").removeClass('pass1');
        $("#hide").addClass('fa fa-eye-slash');
    }
    
 });
 
});



</script>
@endsection