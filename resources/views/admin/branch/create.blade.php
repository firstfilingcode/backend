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
                            <h3 class="card-title"><i class="fa fa-balance-scale"></i> &nbsp; Branch</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/branch') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                <!--<a href="https://www.school.rukmanisoftware.com/account_dashboard" class="btn btn-primary  btn-sm"><i class="fa fa-arrow-left"></i> Back</a>-->
                            </div>

                        </div>
                        <form id="quickForm" action="{{route('admin.branch.store')}}"   method="POST" enctype="multipart/form-data">
                           @csrf
                            <div class="row m-2">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Branch Name<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror  mt-1" id="name" name="name" placeholder="Branch Name" value="{{old('name')}}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Owner Name<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('owner_name') is-invalid @enderror mt-1" id="owner_name" name="owner_name" placeholder="Owner Name" value="{{old('owner_name')}}">
                                        @error('owner_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Branch Code<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('branch_code') is-invalid @enderror  mt-1" id="branch_code" name="branch_code" placeholder="Branch Code" value="{{old('branch_code')}}">
                                        @error('branch_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>GST Number<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control @error('gst_no') is-invalid @enderror mt-1" id="gst_no" name="gst_no" placeholder="Gst Number" value="{{old('gst_no')}}">
                                        @error('gst_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Mobile Number<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('mobile_no') is-invalid @enderror mt-1" id="mobile_no" name="mobile_no" placeholder="MObile Number" value="{{old('mobile_no')}}" maxlength="10" onkeypress="javascript:return isNumber(event)">
                                        @error('mobile_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email<span style="color:red;">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror mt-1" id="email" name="email" placeholder="Email" value="{{old('email')}}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select name="country_id" id="country_id" class="form-control  mt-1">
                                          <option value="">Select</option>
                                          <option value="1">India</option>
                                          <option value="1">Australia</option>
                                        </select>
                                       
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select name="state_id" id="state_id" class="form-control  mt-1" value="{{old('state_id')}}">
                                          <option value="select">Select</option>
                                          <option value="1">Rajasthan</option>
                                          <option value="1">delhi</option>
                                          
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>City</label>
                                        <select name="city_id" id="city_id" class="form-control mt-1" value="{{old('city_id')}}">
                                          <option value="select">Select</option>
                                          <option value="1">Jaipur</option>
                                          <option value="1">Siker</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                  
                                   <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Pin code</label>
                                        <input type="text" class="form-control mt-1" id="pin_code" name="pin_code" placeholder="Pin Code" value="{{old('pin_code')}}">
                                
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control  mt-1" id="address" name="address" placeholder="Address" value="{{old('address')}}"></textarea>
                                        
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