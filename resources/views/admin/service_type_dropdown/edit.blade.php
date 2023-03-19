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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Edit Services Type Dropdown</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/service_type_dropdown') }}" class="btn bbtn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                <a href="{{ URL::previous() }}" class="btn bbtn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                
                            </div>

                        </div>
                        
                              {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.service_type_dropdown.update', $data->id]]) !!}
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
                                
                                
                               
                        
                               <div class="col-md-3">
                                    <div class="form-group select2">
                                        <label class="">Service Type</label>
                                        <div class="input-group-append">
                                            <select type="text" class=" w-100 select2-custom teg "  id="service_type_id" name="service_type_id">
                                             
                                                @if(!empty($ServicesType)) 
                                                    @foreach($ServicesType as $status)
                                                        <option value="{{ $status->id ?? ''  }}" @if($status->id == $data->service_type_id) selected="" @endif >{{ $status->name ?? ''  }}</option>
                                                    @endforeach
                                                 @endif
                            				  
                                            </select>
                                            
                                            
                                            </div>
                                    </div>
                                </div>
                              
                                </div>
                                
                                
                                
                                
                               
                
                           
                            <div class="row m-2">
                                <div class="col-md-4 mt-2">
                                    <label for="switch1" data-on-label="Active" data-off-label="Inactive">Status</label>
                                    <div class="check-box mt-2">
                                     <input value="0"  name="status" type="checkbox" id="switch1" switch="none" {{ ( $data['status'] == 0) ? 'checked' : '' }}/>
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