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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Edit Costumar</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/ca') }}" class="btn bbtn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                        <a href="{{ URL::previous() }}" class="btn bbtn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                
                            </div>

                        </div>
                          {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.costumar.update', $data->id]]) !!}
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
                                        <label>Mobile Number<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="Mobile Number" value="{{old('mobile') ?? $data['mobile'] }}">
                                        @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <label>E-mail<span style="color:red;">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="E-mail" value="{{old('email') ?? $data['email']}}">
                                    @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Username<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('userName') is-invalid @enderror  " id="Username" name="userName" placeholder="Username" value="{{old('userName') ?? $data['userName']}}">
                                        @error('userName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror    
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Password<span style="color:red;">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" value="{{old('password') ?? $data['show_password']}}">
                                    @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>D.O.B</label>
                                        <input type="date" class="form-control " id="dob" name="dob" value="{{old('dob') ?? $data['dob']}}">
                                        
                                    </div>
                                </div>
                               
                                
                              <!--  <div class="col-md-4">
                                    <label style="color:red;">Confirm Password*</label>
                                    <input type="password" class="form-control @error('name') is-invalid @enderror" id="cpassword" name="cpassword"
                                        placeholder="Confirm Password" value="{{old('')}}">
                                </div>-->
                               

                                <div class="col-md-4">
                                    <label>Uplode Image</label>
                                    <input type="file" class="form-control @error('profile') is-invalid @enderror" id="profile" name="profile" value="{{old('profile') ?? $data['profile']}}">
                                    @error('profile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                 <div class="col-md-4">
                                    <label>Adhar Number</label>
                                    <input type="text" class="form-control" id="aadhar_no" name="aadhar_no" value="{{old('aadhar_no') ?? $data['aadhar_no']}}">
                                    
                                </div>
                                
                                <div class="col-md-4">
                                    <label>Aadhar Image</label>
                                    <input type="file" class="form-control" id="profile" name="profile" value="{{old('profile')}}">
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Address<span style="color:red;">*</span></label>
                                        <textarea  class="form-control text_arear @error('address') is-invalid @enderror" id="address" name="address"  placeholder="address">{{old('address') ?? $data['address']}}</textarea>
                                        @error('address')
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
                                    <button type="submit" class="btn btn-success btn-lg pl-3 pr-3">Save</button>
                                </div>
                            </div>
	                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection