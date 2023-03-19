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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Edit Status</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/order_status') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                <!--<a href="https://www.school.rukmanisoftware.com/account_dashboard" class="btn btn-primary  btn-sm"><i class="fa fa-arrow-left"></i> Back</a>-->
                            </div>

                        </div>
                  {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.order_status.update', $data->id]]) !!}
                  @csrf
                 <div class="card-body">
        
           
                <form class="border px-4 pt-2 pb-3" method="POST" action="{{route('admin.order_status.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror @error('name') is-invalid @enderror"  id="name" name="name" placeholder="Status" value="{{old('name') ?? $data['name'] }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                      
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Order By<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('order_by') is-invalid @enderror" onkeypress="return isNumber(event);" id="order_by" name="order_by" placeholder="Order By" value="{{old('order_by') ?? $data['order_by'] }}">
                                        @error('order_by')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                  
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status Message</label>
                                        <textarea id="status_massage" name="status_massage" class="form-control ckeditor" rows="14" cols="100" >{{old('status_massage') ?? $data['status_massage']}}</textarea>

                                    </div>
                                </div>
                              
                            
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                             
                            </div>
                            <div class="row m-2">
                                <div class="col-md-4 mt-2">
                                    <label for="switch1" data-on-label="Active" data-off-label="Inactive">Status</label>
                                    <div class="check-box mt-2">
                                     <input value="1"  name="status" type="checkbox" id="switch1" switch="none" {{ ( $data['status'] == 1) ? '' : 'checked' }} />
                                    </div>
                                    @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                              
                            </div>   
                           
                                
                            
                 
                     <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Update </button>
                     </div>
                 
                  {!! Form::close() !!}
                        
                </form>
            </div>
            
            
            
        </div>


               </div>
            </div>
         </div>
      </div>
   </section>
</div>

<link rel="stylesheet" href="{{ asset('public/assets/dropify.css') }}">
<script src="{{URL::asset('public/assets/ckeditor/ckeditor.js')}}"></script>
<script src="{{URL::asset('public/assets/dropify.js')}}"></script>
<script src="{{URL::asset('public/assets/dropify1.js')}}"></script>
<script>
    function isNumber(e){
    e = e || window.event;
    var charCode = e.which ? e.which : e.keyCode;
    return /\d/.test(String.fromCharCode(charCode));
}


  CKEDITOR.editorConfig = function (config) {
    config.extraPlugins = 'confighelper';
  };
  CKEDITOR.replace('editor1');




</script>

@endsection


