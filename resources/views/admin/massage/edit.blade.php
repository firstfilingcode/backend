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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Edit Blog</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/massage') }}" class="btn bbtn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                    <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                
                            </div>

                        </div>
                          {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.blog.update', $data->id]]) !!}
                            <div class="row m-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{old('name') ?? $data['name'] }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Author<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" placeholder="Author" value="{{old('author') ?? $data['author'] }}">
                                        @error('author')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                
                                 <div class="form-group col-md-4">
                                  <label for="inputPhoto">Upload photo<span class="text-danger">*</span></label>
                                 
                                  <input id="thumbnail" class="form-control mt-1" type="file" name="photo">
                                  </div>
                                  
                                  
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Remark<span style="color:red;">*</span></label>
                                        <textarea class="form-control @error('remark') is-invalid @enderror" id="remark" name="remark">{{ $data['remark'] }}</textarea>
                                        @error('remark')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror    
                                    </div>
                                </div>
                                
                                <div class="col-md-12 Label_top">
                                    <label for="Username">Description</label>
                                    <textarea class="form-control ckeditor" name="ck_editor">{{$data['ck_editor'] ?? ''}}</textarea>
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