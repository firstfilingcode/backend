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
                            <h3 class="card-title"><i class="fa fa-balance-scale"></i> &nbsp; Coupon</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/calendar') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>

                        </div>
                           {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.calendar.update', $data->id]]) !!}
                           @csrf
                            <div class="row m-2">
                             
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror @error('name') is-invalid @enderror mt-1" id="name" name="name" placeholder="Offer Name" value="{{old('name') ?? $data['name'] }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>From Date<span style="color:red;">*</span></label>
                                        <input type="color" class="form-control @error('color_code') is-invalid @enderror @error('color_code') is-invalid @enderror mt-1" id="color_code" name="color_code" placeholder="From Date" value="{{old('color_code') ?? $data['color_code'] }}">
                                        @error('color_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Date<span style="color:red;">*</span></label>
                                        <input type="date" class="form-control @error('date') is-invalid @enderror @error('date') is-invalid @enderror mt-1" id="date" name="date" placeholder="From Date" value="{{old('date') ?? $data['date'] }}">
                                        @error('date')
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
                                   <!--  <input value="1"  name="status" type="checkbox" id="switch1" switch="none" checked/>-->
                                    <input value="0"  name="status" type="checkbox" id="switch1" switch="none" {{ ( $data['status'] == 0) ? 'checked' : '' }} />
                                    </div>
                                    @error('name')
                                            <span class="invalid-feedback" role="alert">color_code
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
        </div>
    </section>
</div>
@endsection