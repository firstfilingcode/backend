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
                            <h3 class="card-title"><i class="fa fa-asterisk"></i> &nbsp; Edit Role</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/roles') }}" class="btn btn-warning text-white  btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                 <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                
                            </div>

                        </div>
                          {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.roles.update', $data->id]]) !!}
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
                                 </div>
                        
                            <div class="row">
                                                 @php
                               
                            $Sidebar = array();
                            if(!empty($data)){
                                if($data->sidebar_id > 0){ 
                                $val = $data->sidebar_id;
                                $Sidebar = explode(',', $val);
                         }
                         }
                         $sub_menu_id = array();
                            if(!empty($data)){
                                if($data->sub_menu_id > 0){ 
                        
                                $sub_menu_id = explode(',', $data->sub_menu_id);
                         }
                         }
                        @endphp
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Sidebar Permission <span class="required" style="color:red;">*</span></label>
                                                                        @if(!empty($sidebar)) 
                                                                            @foreach($sidebar as $sideba)
                                                                            <div class="custom-control custom-checkbox">
                                                                            <input name="sidebar_id[]" class="custom-control-input custom-control-input-primary custom-control-input-outline checkbox chkPassport" type="checkbox" id="{{ $sideba->id ?? '' }}" @if(in_array($sideba->id,$Sidebar)) checked="" @endif value="{{ $sideba->id ?? '' }}">
                                                                            <label for="{{ $sideba->id ?? '' }}" class="custom-control-label pointer">{{ $sideba->name ?? '' }}</label>
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
                                                                    <div class="form-group" id="webSetting" >
                                                                        <label>Sidebar Sub Module </label>
                                                                        @if(!empty($sidebar_sub_menu)) 
                                                                            @foreach($sidebar_sub_menu as $sidebar_sub)
                                                                            <div class="custom-control custom-checkbox subShow_{{ $sidebar_sub->sidebar_id ?? '' }}"  @if(in_array($sidebar_sub->sidebar_id,$Sidebar)) checked="" @else style="display:none" @endif >
                                                                            <input name="sub_menu_id[]" class="custom-control-input custom-control-input-primary custom-control-input-outline checkbox" type="checkbox" id="id_{{ $sidebar_sub->id ?? '' }}" @if(in_array($sidebar_sub->id,$sub_menu_id)) checked=""  @endif value="{{ $sidebar_sub->id ?? '' }}">
                                                                            <label for="id_{{ $sidebar_sub->id ?? '' }}" class="custom-control-label pointer">{{ $sidebar_sub->name ?? '' }}</label>
                                                                            </div>                                              
                                                                            @endforeach
                                                                        @endif                                            
                                                                    </div>
                                                                </div>
                                                                
                                                               <!-- <div class="col-md-3">
                                                                    <label>&nbsp;</label>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-primary d-inline">
                                                                            <input type="checkbox" id="select_all" name="" value="4" class="checkbox chkPassport">
                                                                            <label for="select_all">Select All</label>
                                                                        </div>
                                                                    </div>                            
                                                                </div>-->
                                               		                       
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
                                <div class="col-md-12 text-center mt-4 mb-4">
                                    <button type="submit" class="btn btn-success btn-lg pl-3 pr-3">Save</button>
                                </div>
                            </div>
                             {!! Form::close() !!}
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
    $("#select_all").change(function () {  
        $(".checkbox").prop('checked', $(this).prop("checked")); 
    });
</script>  
@endsection