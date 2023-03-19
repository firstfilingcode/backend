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
                            <h3 class="card-title"><i class="fa fa-pied-piper-alt"></i> &nbsp; Refer And Earn</h3>
                            <div class="card-tools">
                                <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                <!--a href="{{url ('admin/roles') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>-->
                                <!--<a href="https://www.school.rukmanisoftware.com/account_dashboard" class="btn btn-primary  btn-sm"><i class="fa fa-arrow-left"></i> Back</a>-->
                            </div>

                        </div>
                          {!! Form::model($setting, ['method' => 'PATCH','files' => true,'route' => ['admin.refer_earn.update', $setting->id]]) !!}
                           @csrf
                            <div class="row m-2">
                                <div class="col-md-12 Label_top">
                                    <label for="Username">Refer And Earn</label>
                                    <textarea  class="form-control ckeditor" name="refer_earn">{{$setting['refer_earn'] ?? ''}}</textarea>
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