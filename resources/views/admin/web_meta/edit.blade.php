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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Edit Web Meta</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/web_meta') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                
                            </div>

                        </div>
                          {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.web_meta.update', $data->id]]) !!}
                            <div class="row m-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Service For<span style="color:red;">*</span></label>
                                        <select name="page_name" id="page_name" class="form-control teg @error('page_name') is-invalid @enderror mt-1" >
                                                @if(!empty($page_name))
                                    		    @foreach ($page_name as $page)
                                    		      	<option value="{{$page->route}}" {{ ( $page->route == old('page_name',$data->page_name)) ? 'selected' : '' }}>{{$page->page_name}}</option>
                                    		  
                                    		   @endforeach
                                    		   @endif
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tittle<span style="color:red;">*</span></label>
                                        <textarea  class="form-control @error('tittle') is-invalid @enderror" rows="4" cols="50" id="tittle" name="tittle" placeholder="Tittle" value="{{old('tittle') ?? $data['tittle'] }}"required></textarea>
                                        @error('tittle')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="form-group col-md-4">
                                  <label for="inputPhoto">Tittle Image</label>
                                 
                                  <input id="thumbnail" class="form-control mt-1" type="file" name="photo">
                                  </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Meta keywords<span style="color:red;">*</span></label>
                                        <textarea  class="form-control @error('meta_kyewords') is-invalid @enderror" rows="4" cols="50" id="meta_kyewords" name="meta_kyewords" placeholder="Meta keywords" value="{{old('meta_kyewords') ?? $data['meta_kyewords'] }}"required></textarea>
                                        @error('meta_kyewords')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Meta Description<span style="color:red;">*</span></label>
                                        <textarea  class="form-control @error('meta_description') is-invalid @enderror" rows="4" cols="50" id="meta_description" name="meta_description" placeholder="Meta Description" value="{{old('meta_description') ?? $data['meta_description'] }}" required></textarea>
                                        @error('meta_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                  
            
                		 </div>
                            <div class="row m-2">
                                <div class="col-md-4 mt-2">
                                    <label for="switch1" data-on-label="Active" data-off-label="Inactive">Status</label>
                                    <div class="check-box mt-2">
                                     <input value="1"  name="status" type="checkbox" id="switch1" switch="none" {{ ( $data['status'] == 1) ? 'checked' : '' }} />
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
                                    <button type="submit" class="btn btn-success pl-3 pr-3">Update</button>
                                </div>
                            </div>
	                    {!! Form::close() !!}
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
	CKEDITOR.editorConfig = function (config) {
    config.extraPlugins = 'confighelper';
  };
  CKEDITOR.replace('editor1');

	</script>
@endsection