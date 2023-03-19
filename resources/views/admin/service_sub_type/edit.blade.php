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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Edit Services Sub Type</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/service_sub_type') }}" class="btn bbtn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                <a href="{{ URL::previous() }}" class="btn bbtn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                
                            </div>

                        </div>
                        
                              {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.service_sub_type.update', $data->id]]) !!}
                           @csrf
                            <div class="row m-2">
                                <div class="col-md-3">
                                     <label>Service Type<span style="color:red;">*</span></label>
                                    <select name="service_type_id" id="service_type_id" class="form-control @error('service_type_id') is-invalid @enderror mt-1" >
                                        @if(!empty(getService_type()))
                                        <option value="" >Select Service Type</option>
                            		    @foreach (getService_type() as $type)
                            		      	<option value="{{$type->id}}" {{ ( $type->id == $data['service_type_id']) ? 'selected' : '' }}>{{$type->name}}</option>
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
                                        <option value="" >Select Service Type</option>
                            		    @foreach (getservice_type_dropdown() as $type1)
                            		      	<option value="{{$type1->id}}" {{ ( $type1->id == $data['service_type_dropdown_id']) ? 'selected' : '' }}>{{$type1->name}}</option>
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
                                        <input type="text" class="form-control @error('name') is-invalid @enderror @error('name') is-invalid @enderror mt-1" id="name" name="name" placeholder="Name" value="{{old('name',$data->name) ?? '' }}">
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