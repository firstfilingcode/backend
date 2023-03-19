@extends('admin.layouts.app')
@section('title')
Update Password
@endsection
@section('css')        
    <link href="{{ URL::asset('assets/libs/dropify/dropify.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

  {!! Form::model($user, ['method' => 'PATCH','route' => ['admin.users.change_password'],'class'=>'section general-info','id'=>'general-info','files' => true]) !!}
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
                                            <div class="col-lg-6">
                                                
                                                <div class="form-group">
                                                   <label for="fullName">New Password</label>
        											{!! Form::text('new_password', null, array('type' => 'password','class' => 'form-control mb-2')) !!}                                                                            
        											@if ($errors->has('new_password'))
        											<span class="error text-danger">{{ $errors->first('new_password') }}</span>
        											@endif
                                                </div>
                                            </div>
                                        </div>
        								
        								 <div class="row">
                                               <div class="col-lg-6">                                        
                                                <div class="form-group">
                                                    <label for="fullName">Password Confirmation </label>                                                                            
        											{!! Form::text('password_confirmation', null, array('type' => 'password','class' => 'form-control mb-2')) !!}
        											@if ($errors->has('new_password'))
        												<span class="error text-danger">{{ $errors->first('new_password') }}</span>
        											@endif
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
@endsection