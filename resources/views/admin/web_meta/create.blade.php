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
                            <h3 class="card-title"><i class="fa fa-balance-scale"></i> &nbsp; Web Meta</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/web_meta') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                    <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                <!--<a href="https://www.school.rukmanisoftware.com/account_dashboard" class="btn btn-primary  btn-sm"><i class="fa fa-arrow-left"></i> Back</a>-->
                            </div>

                        </div>
                        <form id="quickForm" action="{{route('admin.web_meta.store')}}"   method="POST" enctype="multipart/form-data">
                           @csrf
                            <div class="row m-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Service For<span style="color:red;">*</span></label>
                                          <select name="page_name" id="page_name" class="mt-2 form-control teg @error('page_name') is-invalid @enderror"  >
                                                @if(!empty($routes))
                                    		    @foreach ($routes as $route)
                                    		      	<option value="{{$route->route}}" {{ ( $route->route == old('page_name')) ? 'selected' : '' }}>{{$route->page_name}}</option>
                                    		  
                                    		   @endforeach
                                    		   @endif
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tittle<span style="color:red;">*</span></label>
                                        <textarea class="form-control @error('tittle') is-invalid @enderror" rows="4" cols="50" id="tittle" name="tittle" placeholder="Tittle" value="{{old('tittle') }}"></textarea></textarea>
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
                                        <textarea  class="form-control @error('meta_kyewords') is-invalid @enderror" rows="4" cols="50" id="meta_kyewords" name="meta_kyewords" placeholder="Meta keywords" value="{{old('meta_kyewords')}}"></textarea>
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
                                        <textarea  class="form-control @error('meta_description') is-invalid @enderror" rows="4" cols="50" id="meta_description" name="meta_description" placeholder="Meta Description" value="{{old('meta_description') }}" ></textarea>
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
                                     <input value="1"  name="status" type="checkbox" id="switch1" switch="none" checked/>
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
                                    <button type="submit" class="btn btn-success btn-lg pl-3 pr-3">Save</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection