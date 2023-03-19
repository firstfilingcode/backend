@extends('admin.layouts.app')
@section('title')
@lang('translation.Dashboard') @endsection
@section('content')

<div class="content-wrapper" style="min-height: 222px;">
  <section class="content pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-md-12">
          <div class="card card-outline card-orange">
            <div class="card-header bg-primary">
              <h3 class="card-title"><i class="fa fa-codiepie"></i> &nbsp; About </h3>
              <div class="card-tools">
        <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
              </div>

            </div>

            {!! Form::model($about, ['method' => 'PATCH','files' => true,'route' => ['admin.about.update', $about->id]])
            !!}
            @csrf
            <div class="row m-2">
              <div class="row m-2">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Username">Name<span style="color:red;">*</span></label>
                    <input type="text" class="form-control " id="name" name="name" placeholder="Name"
                      value="{{old('name',$about['name']) ?? ''}}">
                  </div>
                </div>

                <div class="form-group col-md-4">
                  <label for="inputPhoto">Upload photo<span class="text-danger">*</span></label>

                  <input id="photo" class="form-control mt-1" type="file" name="photo">
                </div>

                <div class="form-group col-md-4">
                  @if($about->photo)
                  <img src="{{ env('IMAGE_SHOW_PATH').'about/'.$about['photo'] }}" class="img-fluid"
                    style="max-width:80px" alt="{{$about->photo}}">
                  @else
                  <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px"
                    alt="avatar.png">
                  @endif
                </div>

                <div class="col-md-8">
                </div>
                <div class="col-md-12 Label_top">
                  <label for="Username">Short Description</label>
                  <textarea class="form-control" name="short_description"
                    id="short_description">{{$about['short_description'] ?? ''}}</textarea>
                </div>
                <div class="col-md-12 Label_top">
                  <label for="Username">Long Description</label>
                  <textarea class="form-control ckeditor" name="long_description"
                    id="long_description">{{$about['long_description'] ?? ''}}</textarea>
                </div>

              </div>
            </div>
            <div class="col-md-12 text-center mt-4 mb-4 ">
              <button type="submit" class="btn btn-success btn-lg pl-3 pr-3">Save</button>
            </div>
          </div>
        </div>
        {!! Form::close() !!}

      </div>
    </div>
  </section>
</div>
<style>
  .Label_top {
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