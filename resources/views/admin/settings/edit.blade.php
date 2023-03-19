@extends('admin.layouts.app')
@section('title') @lang('translation.Dashboard') @endsection
@section('content')
@section('title')
Setting
@endsection
        
   <div class="content-wrapper" style="min-height: 222px;">
   
   <section class="content pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-outline card-orange">

                <div class="card-header bg-primary">
                    <h3 class="card-title"><i class="fa fa-cogs"></i> &nbsp; Setting </h3>
                    
                    <div class="card-tools">
                            <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                    </div>
                    
                </div> 

        <div class="card-body">
         {!! Form::model($setting, ['method' => 'PATCH','files' => true,'route' => ['admin.settings.update', $setting->id]]) !!}
            <div class="row">
                
			    <div class="col-md-3">
				    <div class="form-group"> 
					    <label for="Username">Name<span style="color:red;">*</span></label>
				    	<input type="text" class="form-control " id="name" name="name" placeholder="Name" value="{{$setting['name'] ?? ''}}">
									    </div>
			    </div>                
                
			    <div class="col-md-3">
				    <div class="form-group"> 
					    <label for="Username">Number<span style="color:red;">*</span></label>
				    	<input type="numbre" class="form-control " id="mobile" name="phone" placeholder="Mobile No." value="{{$setting['phone'] ?? ''}}" maxlength="10" onkeypress="javascript:return isNumber(event)">
									    </div>
			    </div>                
                
			    <div class="col-md-3">
				    <div class="form-group"> 
					    <label for="Username">E-Mail<span style="color:red;">*</span></label>
				    	<input type="text" class="form-control " id="gmail" name="email" placeholder="Gmail" value="{{$setting['email'] ?? ''}}">
									    </div>
			    </div>  
			
                 <div class="col-md-3">
				    <div class="form-group"> 
					    <label for="Username">Tin No.<span style="color:red;">*</span></label>
				    	<input type="text" class="form-control " id="tin_no" name="tin_no" placeholder="Tin No" value="{{$setting['tin_no'] ?? ''}}">
										    </div>
			    </div>

			    
                
			   
			   
			   <div class="col-md-3">
				    <div class="form-group"> 
					    <label for="Username" >Pin Code<span style="color:red;">*</span></label>
				    	{!! Form::text('mobile', null, array('class' => 'form-control','placeholder' => 'Pin Code','maxlength'=>6, 'onkeypress'=>'return isNumber(event)')) !!}
									    </div>
			    </div>   
			   
			   
               
			   
			   <!--  <div class="col-md-1 mt-4">
                    <img src="http://school.rukmanisoftware.com/schoolimage//setting/left_logo/163961959361ba9c0926a8fdownload.png" width="40px" height="40px">
                </div>-->
                <div class="col-md-3">
				    <div class="form-group"> 
					    <label for="Username">Facebook-Link<span style="color:red;">*</span></label>
				    	<input type="text" class="form-control " id="youtube_link" name="youtube_link" placeholder="Facebook-Link" value="{{$setting['youtube_link'] ?? ''}}">
					</div>
			    </div>
               <div class="col-md-3">
				    <div class="form-group"> 
					    <label for="Username">Youtub-Link<span style="color:red;">*</span></label>
				    	<input type="text" class="form-control " id="youtube_link" name="youtube_link" placeholder="Youtub-Link" value="{{$setting['youtube_link'] ?? ''}}">
					</div>
			    </div>
               <div class="col-md-3">
				    <div class="form-group"> 
					    <label for="Username">Twitter-Link<span style="color:red;">*</span></label>
				    	<input type="text" class="form-control " id="twitter_link" name="twitter_link" placeholder="twitter-Link" value="{{$setting['twitter_link'] ?? ''}}">
					</div>
			    </div>
			    <div class="col-md-3">
				    <div class="form-group"> 
					    <label for="Username">Instagram-Link<span style="color:red;">*</span></label>
				    	<input type="text" class="form-control " id="instagram" name="instagram_link" placeholder="Instagram-Link" value="{{$setting['instagram_link'] ?? ''}}">
					</div>
			    </div>
			  
               <div class="col-md-12 Label_top">
                 <label for="Username">Address</label>
                 <textarea class="form-control" name="address">{{$setting['address'] ?? ''}}</textarea>
                		</div>
                 <div class="col-md-3">
				    <div class="form-group"> 
					    <label for="Username" class="required">Logo</label>
				    	<?php $image = URL::asset('public/uploads/logo/'.$setting->logo);?>
						{!! Form::file('logo',array('class' => 'dropify','data-default-file'=>$image)) !!} 
					 </div>
			    </div>                		
                 <div class="col-md-3">
				    <div class="form-group"> 
					    <label for="Username" class="required">Footer Logo</label>
				    	<?php $image = URL::asset('public/uploads/logo/'.$setting->footer_logo);?>
							{!! Form::file('footer_logo',array('class' => 'dropify','data-default-file'=>$image)) !!} 
					</div>
			     </div>
         <!--       		
                		 <div class="col-md-12 Label_top">
                 <label for="Username">Contat-us</label>
                 <textarea class="form-control ckeditor" name="contact_us">{{$setting['contact_us'] ?? ''}}</textarea>
                		</div>
                		-->
                	
                		
             <div class="col-md-12 text-center Label_top">
    			<button type="submit" class="btn btn-success pl-3 pr-3 ">Update</button>
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
    .Label_top{
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
	
