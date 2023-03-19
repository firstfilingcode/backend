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
                            <h3 class="card-title"><i class="fa fa-whatsapp"></i> &nbsp; Create Message</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/massage') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                <!--<a href="https://www.school.rukmanisoftware.com/account_dashboard" class="btn btn-primary  btn-sm"><i class="fa fa-arrow-left"></i> Back</a>-->
                            </div>

                        </div>
                        
                        <section class="content">
            <div class="container-fluid">
                <div class="row m-2">
                    <div class=" col-md-12 title"><h5 class="text-danger">Select Candidates:-</h5></div>
                    <div class="col-md-3">
                		<div class="form-group">
                			<label style="color:red;">Select*</label>
                		{!! Form::select('roles[]', $roles,[], array('class' => 'form-control ')) !!}
                		
                	    </div>
                	</div>
                    <div class="col-md-1">
                	    <button class="btn btn-success mt-4">Search</button>
                	</div>
                </div>
      
        </section>
            <section>
         <form id="quickForm" action="{{ url('send_message') }}" method="post">   
            @csrf
    
                <div class="row m-2">
                    <div class="col-md-12" id="student_list_show" style="height: 110px; overflow-y: scroll;">

                    </div>
                </div>
        </section>
            <hr>              
               <div class="row m-2">
                <div class=" col-md-12 title"><h5 class="text-danger">Message Details:-</h5></div>
                
        		<div class="col-md-4">
        	    	<div class="form-group">
        				<label   style="color:red;">Subject</label>
        				<input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Subject" value="" required>
        		            @error('subject')
        					    <span class="invalid-feedback" role="alert">
        					        <strong>{{ $message }}</strong>
        					    </span>
        				    @enderror
        		    </div>
        		</div>
        		
        		<div class="col-md-2"></div>

        		<div class="col-md-6">
        	    	<div class="form-group">
        	    	    <label   style="color:red;">Select</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="sms" name="sms">
                                            <label for="sms">SMS</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group clearfix">
                                        <div class="icheck-danger d-inline">
                                            <input type="checkbox" id="checkemail" name="checkemail">
                                            <label for="checkemail">E-Mail</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group clearfix">
                                        <div class="icheck-success d-inline">
                                            <input type="checkbox" id="whatsapp" name="whatsapp">
                                            <label for="whatsapp">Whatsapp</label>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
        		    </div>
        		</div>
        		
        		<div class="col-md-12">
        	    	<div class="form-group">
        				<label style="color:red;">Message</label>
        				<textarea id="" name="message" class="form-control @error('message') is-invalid @enderror" required></textarea>
        				    @error('message')
        					    <span class="invalid-feedback" role="alert">
        						    <strong>{{ $message }}</strong>
        					    </span>
        				    @enderror
                        <div id="count">Total Characters:-<span id="current_count">0</span></div>        				    
        		    </div>
        	    </div>
        
        	</div>
        	 <div class="row m-2">
                <div class="col-md-12 text-center pb-2">
                    <button type="submit" id="submit" class="btn btn-success">Send Message</button>
                </div>
            </div>
            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection