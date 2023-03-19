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
                                <a href="{{url ('admin/coupon') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                            class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>

                        </div>
                       {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.coupon.update', $data->id]]) !!}
                           @csrf
                            <div class="row m-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="services">Services</label>
                                        <select class="form-control mt-1 teg" name="service_id" id="service_id">
                                            <option value="">Select Services</option>
                                            @if(!empty($service))
                                    		    @foreach ($service as $services)
                                    		      	<option value="{{$services->id}}">{{$services->name}}</option>
                                    		  
                                    		   @endforeach
                                    		   @endif
                                           
                                        </select>
                                    </div>
                                </div>
                                
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
                                        <input type="date" class="form-control @error('from_date') is-invalid @enderror mt-1" id="from_date" name="from_date" placeholder="From Date" value="{{old('from_date') ?? $data['from_date'] }}">
                                        @error('from_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>To Date<span style="color:red;">*</span></label>
                                        <input type="date" class="form-control r @error('to_date') is-invalid @enderror mt-1" id="to_date" name="to_date" placeholder="To Date" value="{{old('to_date') ?? $data['to_date'] }}">
                                        @error('to_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                               
                                   <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Coupon Code<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('coupon_code') is-invalid @enderror mt-1" id="coupon_code" name="coupon_code" placeholder="Coupon Code" value="{{old('coupon_code') ?? $data['coupon_code'] }}">
                                        @error('coupon_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                
                                
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Discount Percent (%)</label>
                                        <input type="text" class="form-control @error('discount_percent') is-invalid @enderror mt-1" id="discount_percent" name="discount_percent" placeholder="Discount Percent" value="{{old('discount_percent') ?? $data['discount_percent'] }}">
                                        @error('discount_percent')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>UP to Discount </label>
                                        <input type="text" class="form-control  mt-1" id="up_to_discount" name="up_to_discount" placeholder="UP to Discount" value="{{old('up_to_discount') ?? $data['up_to_discount']}}">
                                       
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
        </div>
    </section>
</div>
@endsection