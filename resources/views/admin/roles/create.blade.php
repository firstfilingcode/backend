@extends('admin.layouts.app')
@section('title') @lang('translation.Dashboard') @endsection
@section('content')
@php
$sidebar = DB::table('sidebars')->get();
$sidebar_sub_menu = DB::table('sidebar_sub_menus')->get();

@endphp

<div class="content-wrapper" style="min-height: 222px;">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <h3 class="card-title"><i class="fa fa-asterisk"></i> &nbsp; Create Roles</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/roles') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                       <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                <!--<a href="https://www.school.rukmanisoftware.com/account_dashboard" class="btn btn-primary  btn-sm"><i class="fa fa-arrow-left"></i> Back</a>-->
                            </div>

                        </div>
                        <form id="quickForm" action="{{route('admin.roles.store')}}"   method="POST" enctype="multipart/form-data">
                           @csrf
                            <div class="row m-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{old('name')}}">
                                       
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                                </div>
                                	<div class="row m-2">
            
	                 
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Sidebar Permission <span class="required" style="color:red;">*</span></label>
                                                                        @if(!empty($sidebar)) 
                                                                            @foreach($sidebar as $sidebar)
                                                                            <div class="custom-control custom-checkbox">
                                                                            <input name="sidebar_id[]" class="custom-control-input custom-control-input-primary custom-control-input-outline checkbox chkPassport" type="checkbox" id="{{ $sidebar->id ?? '' }}" value="{{ $sidebar->id ?? '' }}">
                                                                            <label for="{{ $sidebar->id ?? '' }}" class="custom-control-label pointer">{{ $sidebar->name ?? '' }}</label>
                                                                            </div>                                                
                                                                            @endforeach
                                                                        @endif
                                        
                                                                        @error('sidebar_id')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror                       
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="col-md-3">
                                                                    <div class="form-group" id="webSetting" style="display:none">
                                                                        <label>Sidebar Sub Module </label>
                                                                        @if(!empty($sidebar_sub_menu)) 
                                                                            @foreach($sidebar_sub_menu as $sidebar_sub)
                                                                            <div class="custom-control custom-checkbox subShow_{{ $sidebar_sub->sidebar_id ?? '' }}" style="display:none">
                                                                            <input name="sub_menu_id[]" class="custom-control-input custom-control-input-primary custom-control-input-outline checkbox" type="checkbox" id="id_{{ $sidebar_sub->id ?? '' }}" value="{{ $sidebar_sub->id ?? '' }}">
                                                                            <label for="id_{{ $sidebar_sub->id ?? '' }}" class="custom-control-label pointer">{{ $sidebar_sub->name ?? '' }}</label>
                                                                            </div>                                              
                                                                            @endforeach
                                                                        @endif                                            
                                                                    </div>
                                                                </div>
                                                                
                                                              
                   
                    </div>
                            <div class="row m-2">
                                <div class="col-md-4 mt-2">
                                    <label for="switch1" data-on-label="Active" data-off-label="Inactive">Status</label>
                                    <div class="check-box mt-2">
                                     <input value="1"  name="status" type="checkbox" id="switch1" switch="none" checked/>
                                    </div>
                                    @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                </div>
                                <div class="col-md-12 text-center mt-4 mb-4 ">
                                    <button type="submit" class="btn btn-success btn-lg pl-3 pr-3">Save</button>
                                </div>
                                </div>
                                </div>
                                
                                
            </div>
        </div>
    </section>
</div>

<style>
    .custom-control-input {
    position: absolute;
    left: 0;
    z-index: -1;
    width: 1rem;
    height: 1.25rem;
    opacity: 0;
}
</style>
<script>

        $(".chkPassport").click(function () {
            var sidebar_id = $(this).val();
            
            if(sidebar_id > 0  && $(this).is(":checked")){
                $("#webSetting").show();
                $(".subShow_"+sidebar_id).show();
            }else{
               // $("#webSetting").hide();
                $(".subShow_"+sidebar_id).hide();
            }
            /*if ($(this).is(":checked")) {
                $("#webSetting").show();
            } else {
                $("#webSetting").hide();
        }*/
    });
  
</script>
@endsection